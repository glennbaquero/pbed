<?php

namespace App\Extenders\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Scout\Searchable;
use Hash;
use Auth;
use Carbon\Carbon;

use App\Helpers\StringHelper;

use App\Traits\ArchiveableTrait;
use App\Traits\HelperTrait;
use App\Traits\DateTrait;
use App\Traits\ImageTrait;
use App\Traits\PaginationTrait;
use App\Traits\ArrayFormatterTrait;

class BaseUser extends Authenticatable
{
    use Notifiable, Searchable, ArchiveableTrait, HelperTrait, DateTrait, ImageTrait, LogsActivity, PaginationTrait, ArrayFormatterTrait;

    protected static $logAttributes = ['name', 'position', 'email', 'status'];
    protected static $logOnlyDirty = false;
    protected static $ignoreChangedAttributes = ['updated_at', 'remember_token', 'email_verified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDescriptionForEvent(string $eventName): string {
        return "Account has been {$eventName}";
    }

    /**
     * @Mutators
     */
    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = StringHelper::titleCase($value);
    }

    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = StringHelper::titleCase($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'position' => $this->position,
            'email' => $this->email,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = []) 
    {   
        if (!count($columns)) {
            $columns = ['name', 'position', 'email', 'status'];
        }
        $vars = $request->only($columns);

        if (!$item) {
            $vars['password'] = uniqid();
            $vars['email_verified_at'] = Carbon::now();
            $item = static::create($vars);
            $broker = $item->broker();
            $broker->sendResetLink($request->only('email'));
        } else {
            $item->update($vars);
        }

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'admin-avatars');
        }

        if ($item->isRoleEditable() && method_exists($item, 'roles')) {
            $roleIds = $request->filled('role_ids') ? $request->input('role_ids') : [];

            if (!count(array_intersect($roleIds, $item->roles()->pluck('id')->toArray()))) {
                activity()
                    ->causedBy($request->user())
                    ->performedOn($item)
                    ->log("{$item->renderLogName()} roles has been updated.");
            }

            $result = $item->syncRoles($roleIds);
        }

        return $item;
    }


    /**
     * Change User Password
     * @param  string $current_password Current Password
     * @param  string $new_password     New Password
     * @param  object $causer           User that caused the action
     * @return boolean                   determine if change password is successful
     */
    public function changePassword($current_password, $new_password, $causer = null) {
        $action = Hash::check($current_password, $this->password);

        if (!$action) {
            throw ValidationException::withMessages([
                'password' => 'The password you have entered does not match current password.',
            ]);
        }

        $isSameAsPrevious = Hash::check($new_password, $this->password);

        if ($isSameAsPrevious) {
            throw ValidationException::withMessages([
                'password' => 'Your new password cannot be the same as the old one.',
            ]);
        }

        if ($action && !$isSameAsPrevious) {
            $this->password = Hash::make($new_password);
            $this->save();

            if ($causer) {
                activity()
                    ->causedBy($causer)
                    ->performedOn($this)
                    ->log("Account password has been changed");
            }

        }

        return $action;
    }

    /**
     * @Notifications
     */

    public function readAllNotifications() {
        $items = $this->unreadNotifications;

        if ($items->count()) {
            $items->markAsRead();
        } else {
            throw ValidationException::withMessages([
                'notification' => 'All notifications are already marked as read.',
            ]);
        }

        return true;
    }

    public function readNotification($id) {
        if ($notification = $this->unreadNotifications()->find($id)) {
            $notification->markAsRead();
        } else {
            throw ValidationException::withMessages([
                'notification' => 'Notification is already marked as read.',
            ]);
        }

        return true;
    }

    public function unreadNotification($id) {
        if ($notification = $this->readNotifications()->find($id)) {
            $notification->markAsUnread();
        } else {
            throw ValidationException::withMessages([
                'notification' => 'Notification is already marked as unread.',
            ]);
        }

        return true;
    }

    /**
     * @Roles and Permissions
     */

    public function isRoleEditable() {
        return true;
    }

    /**
     * @Authentications
     */

    public function broker() {
        return Password::broker();
    }

    /**
     * @Archivables
     */

    public function archiveErrorMessage() {
        $result = $this->renderLogName();

        if ($this->isArchiveable()) {
            $result .= ' has already been archived.';
        } else {
            $result .= ' cannot be archived.';
        }

        return $result;
    }

    public function restoreErrorMessage() {
        $result = $this->renderLogName();

        if ($this->isRestorable()) {
            $result .= ' has already been restored.';
        } else {
            $result .= ' cannot be restored.';
        }

        return $result;
    }

    /**
     * @Render
     */

    /**
     * Render name for specific item
     * 
     * @return string/route
     */
    public function renderName() 
    {
        return $this->name;
    }


    /**
     * Render name for specific item
     * 
     * @return string/route
     */
    public function renderFullName() 
    {
        return $this->first_name.' '.$this->last_name;
    }

    protected function getDefaultImage() {
        return url('/') . '/images/avatar.png';
    }
}
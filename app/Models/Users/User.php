<?php

namespace App\Models\Users;

use App\Extenders\Models\BaseUser as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\Web\Auth\ResetPassword;
use App\Notifications\Web\Auth\VerifyEmail;
use Password;

use App\Models\CIS\UserClassifications\UserClassification;

use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{

    /*
    |--------------------------------------------------------------------------
    | @Consts
    |--------------------------------------------------------------------------
    */

    const FILLABLE = ['name', 'position', 'email', 'status', 'user_classification_id'];


    /*
    |--------------------------------------------------------------------------
    | @Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @Mutators
     */
    public function setBirthdayAttribute($value) {
        if (strtotime($value)) {
            $date = Carbon::parse($value);
            $this->attributes['age'] = $date->age;
        }

        $this->attributes['birthday'] = $value;
    }

    
    /*
    |--------------------------------------------------------------------------
    | @Relationships
    |--------------------------------------------------------------------------
    */

    public function device_tokens() 
    {
        return $this->morphMany(DeviceToken::class, 'user');
    }

    public function providers() 
    {
        return $this->morphMany(SocialiteProvider::class, 'user');
    }

    public function classification() 
    {
        return $this->belongsTo(UserClassification::class, 'user_classification_id');
    }

    public function classifications()
    {
        return $this->belongsToMany(UserClassification::class, 'classifications', 'user_classification_id', 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | @Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Overrides default reset password notification
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }

    /* Overrides default verification notification */
    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }


    /* Overrides default forgot password */
    public function broker() {
        return Password::broker('users');
    }

    /**
     * JWT Configurations
     */
    public function getJWTCustomClaims(): array {
        return [
            'guard' => 'web',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'status' => $this->status,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | @Renders
    |--------------------------------------------------------------------------
    */

    /**
     * @Renders
     */
    
    public function isIncomplete() {
        return in_array(null, [
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->username,
            $this->gender,
            $this->mobile_number,
            $this->birthday,
        ]);
    }

    public function renderAccountStatus()
    {
        if($this->status === 1) {
            return 'Active';
        }
        return 'Deactivated';
    }
    
    public function getClassificationNames()
    {
        $name = '';
        foreach ($this->classifications as $key => $classification) {
            $name .= $classification->name;
        }

        return 'Deactivated';
    }

    /**
     * Render name for specific item
     * 
     * @return string/route
     */
    public function renderName() 
    {
        return $this->name;
    }

    /* User Verification Status */
    public function renderStatus($showLabel = true) {
        $result = $showLabel ? 'Unverified' : 'bg-danger';

        if ($this->email_verified_at) {
            $result = $showLabel ? 'Verified' : 'bg-success';
        }

        return $result;
    }

    public function renderShowUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return route($prefix . '.profiles.show');
        }
        
        return route($prefix . '.users.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return;
        }

        return route($prefix . '.users.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return;
        }

        return route($prefix . '.users.restore', $this->id);
    }

    public function renderFormattedClassificationsForTable() {
        $label = '';
        foreach ($this->classifications as $key => $classification) {
            $label .= $classification->name;
            if(($key + 1) < $this->classifications->count()) {
                $label .= ', ';
            }
        }

        return $label;
    }
}
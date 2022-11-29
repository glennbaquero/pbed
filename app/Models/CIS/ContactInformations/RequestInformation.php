<?php

namespace App\Models\CIS\ContactInformations;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\ContactInformations\ContactInformationField;
use App\Models\Users\User;

use App\Notifications\Admin\RequestInformation\RequestInformationNotification;

use Auth;
use Carbon\Carbon;

class RequestInformation extends Model
{
	/*
	|--------------------------------------------------------------------------
	| @Consts
	|--------------------------------------------------------------------------
	*/

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
	    $searchable = [
	        'id' => $this->id,
	        'fields' => $this->fields,
	        'category' => $this->category ? $this->category->name : '',
	    ];
	    
	    return $searchable;
	}
	/*
	|--------------------------------------------------------------------------
	| @Attributes
	|--------------------------------------------------------------------------
	*/



	/*
	|--------------------------------------------------------------------------
	| @Relationships
	|--------------------------------------------------------------------------
	*/

	public function contact_information()
	{
		return $this->belongsTo(ContactInformation::class);
	}

	public function fields()
	{
		return $this->belongsTo(ContactInformationField::class);
	}

	public function user() {
        return $this->belongsTo(User::class);
    }

	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * Store/Update resource to storage
	 * 
	 * @param  array $request
	 * @param  object $item
	 */
	 public static function store($request, $item = null)
	{
	    $vars = $request->only(['reason', 'contact_information_id', 'status', 'type']);

	    if (!$item) {
	    	$vars['user_id'] = auth()->user()->id;
	        $item = static::create($vars);
	    } else {
	        $item->update($vars);
	    }

	    return $item;
	}

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

	/**
     * Render show url for specific item
     * 
     * @return string/route
     */
	public function renderShowUrl($prefix = 'admin') 
    {
        $route = $this->id;
        $name = 'request-information.show';

        return route($prefix . ".{$name}", $route);
    }

    /**
     * Render show url for specific item
     * 
     * @return string/route
     */
    public function renderShowUserUrl($prefix = 'web') 
    {
        $route = $this->id;
        $name = 'contact-informations.show';

        return route($prefix . ".{$name}", $route);
    }

    /**
     * Render show url for specific item
     * 
     * @return string/route
     */
	public function renderShowContactUrl($contact_id) 
    {
        $name = 'admin.contact-informations.show';

        return route("{$name}", $contact_id);
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

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.request-information.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.request-information.restore', $this->id);
    }

    public function renderApproveUrl($prefix = 'admin') {
        return route($prefix . '.request-information.approve', $this->id);
    }

    public function renderDisapproveUrl($prefix = 'admin') {
        return route($prefix . '.request-information.disapprove', $this->id);
    }

    /*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/

    public function updateStatus($status, $id) 
    {
        $admin = Auth::guard('admin')->user();
        $subject = '';

        $message = 'Your request for the contact record has been';

        if($this->type === 'REQUEST TO EDIT') {
            $message = 'Your request for the edit has been';
        }

        if($status) {

            $subject = 'Contact Request Approved';

            $this->update([
                'status' => 'APPROVED'
            ]);

            $this->user->notify(new RequestInformationNotification($subject, 'Approved', $this->renderShowUserUrl(), $message));

        } else {

            $subject = 'Contact Request Declined';

            $this->update([
                'status' => 'DENIED'
            ]);

           $this->user->notify(new RequestInformationNotification($subject, 'Declined', $this->renderShowUserUrl(), $message));            
        }

    }

    /**
     * Check if item can be Archived
     * 
     */
    public function canArchive()
    {
        if($this->status === 'PENDING') {
            return true;
        }    
    }


	/*
	|--------------------------------------------------------------------------
	| @Getters
	|--------------------------------------------------------------------------
	*/

}

<?php

namespace App\Models\CIS\ContactCategories;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ContactInformations\ContactInformationField;

class ContactCategoryField extends Model
{
	protected $appends = ['is_definite_fields'];
	
	/*
	|--------------------------------------------------------------------------
	| @Consts
	|--------------------------------------------------------------------------
	*/



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


	public function category()
	{
		return $this->belongsTo(ContactCategory::class);
	}

	public function contact_information_fields() 
	{
		return $this->hasMany(ContactInformationField::class);
	}

	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/



	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

	/**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.contact-categories-field.archive', $this->id);
    }

    /*
	|--------------------------------------------------------------------------
	| @Appends
	|--------------------------------------------------------------------------
	*/
	public function getIsDefiniteFieldsAttribute() {
	    return false;
	}


	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

<?php

namespace App\Models\CIS\ContactInformations;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\DefiniteFields\DefiniteField;
use App\Models\CIS\ContactCategories\ContactCategoryField;

class ContactInformationField extends Model
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
	        'value' => $this->value,
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

	public function definite_field()
	{
		return $this->belongsTo(DefiniteField::class)->withTrashed();
	}

	public function contact_category_field()
	{
		return $this->belongsTo(ContactCategoryField::class);
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



	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

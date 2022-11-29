<?php

namespace App\Models\CIS\ContactCategories;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactCategories\ContactCategoryField;
use App\Models\CIS\ContactInformations\ContactInformation;

class ContactCategory extends Model
{

	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->renderDate(),
        ];
    }


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


	public function fields()
	{
		return $this->hasMany(ContactCategoryField::class);
	}

	public function contact_informations()
	{
		return $this->hasMany(ContactInformation::class, 'category_id');
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
	    $vars = $request->except(['canView', 'fieldName', 'isNew', 'oldFieldId']);

	    if (!$item) {
	        $item = static::create($vars);

	        foreach ($request->fieldName as $key => $value) {

			    $field = $item->fields()->create([
			    	'name' => $value,
			    	'name_field' => strtolower(str_replace(' ', '_', $value)),
			    ]);

			    if($request->has('canView') && array_key_exists($key,$request->input('canView'))) {
			    	$field->update([
			    		'hidden' => array_key_exists($key,$request->input('canView'))
			    	]);
			    }
		    }

	    } else {

	        $item->update($vars);

	        foreach ($request->fieldName as $key => $value) {
	        	

	        	if(array_key_exists($key,$request->input('oldFieldId'))) {
	        		/**
	        		 * Updating the existing field in contact category fields search by id
	        		 */
	        		$field = $item->fields()->where('id', $request->input('oldFieldId')[$key])->first();

	        		$field->update([ 
	        			'name' => $value,
	        			'name_field' => strtolower(str_replace(' ', '_', $value)),
	        		]);
	        		
	        	} else {
	        		/**
	        		 * creating contact category field if user add a new field
	        		 */
	        		
	        		$field = $item->fields()->create([
	        			'name' => $value,
	        			'name_field' => strtolower(str_replace(' ', '_', $value)),
	        		]);
	        	}

			    // if($request->has('canView') && array_key_exists($key,$request->input('canView'))) {
			    	$field->update([
			    		'hidden' => array_key_exists($key,$request->input('canView'))
			    	]);
			    // }

			    /**
			     * Updating the contact information fields 
			     */
			    
			    foreach($item->contact_informations as $info) {
			    	// getting all the contact category field from contact information field
			    	
			    	$fields = $info->fields()->where('contact_category_field_id', $field->id);

			    	if($fields->count()) {
			    		// update the data if contact category field is existing
			    		$fields->update([
			    			'name' => $field->name, 
			    			'name_field' => $field->name_field,
			    			'is_hidden' => $field['hidden']
			    		]);

			    	} else {
			    		// create data if contact category field is not existing
			    		$info->fields()->create([
			    			'category_id' => $item->id,
			    			'name' => $field->name, 
			    			'name_field' => $field->name_field,
			    			'is_hidden' => $field['hidden'] ? true : false,
			    			'contact_category_field_id' => $field->id,
			    			'is_definite_fields' => false,
			    		]);
			    	}
			    }
		    }

	        // $item->fields()->forceDelete();
	    }

	    
        

	    return $item;
	}

	/*
	|--------------------------------------------------------------------------
	| @Getters
	|--------------------------------------------------------------------------
	*/
	public function getAllFieldItems() 
	{
		$array = [];

		foreach ($this->fields as $field) {
			array_push($array, [
				'fieldName' => $field['name'],
				'hidden' => $field['hidden'] ? true : false,
				'id' => $field['id'],
				'removeUrl' => $field->renderArchiveUrl(),
				'deleted_at' => $field->deleted_at,
			]);
		}

		return $array;
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
        $name = 'contact-categories.show';

        return route($prefix . ".{$name}", $route);
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
        return route($prefix . '.contact-categories.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.contact-categories.restore', $this->id);
    }



	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

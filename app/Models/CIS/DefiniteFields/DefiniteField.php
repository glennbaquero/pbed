<?php

namespace App\Models\CIS\DefiniteFields;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactInformations\ContactInformationField;

class DefiniteField extends Model
{
	// protected $guarded = [];
	protected $appends = ['is_definite_fields', 'archiveUrl'];
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

	public function contact_information_fields() 
	{
		return $this->hasMany(ContactInformationField::class);
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
	    // $vars = $request->except(['canView', 'fieldName']);

	    // if (!$item) {
	    //     $item = static::create($vars);
	    // } else {

	    //     $item->update($vars);

	    //     $item->fields()->forceDelete();
	    // }

	    // static::truncate();

        foreach ($request->fieldName as $key => $value) {
        	if($request->filled('oldFieldId') && array_key_exists($key, $request->input('oldFieldId'))) {
        		$item = DefiniteField::find($request->input('oldFieldId')[$key]);
        		$item->update([
        			'name' => $value,
        			'name_field' => strtolower(str_replace(' ', '', $value)),
        			'hidden' => isset($request->input('canView')[$key])
        		]);
        	} else {
        		$item = static::create([
        			'name' => $value,
        			'name_field' => strtolower(str_replace(' ', '', $value))
        		]);
        	}

		    if($request->has('canView') && array_key_exists($key,$request->input('canView'))) {
		    	$item->update([
		    		'hidden' => $request->input('canView')[$key] == 'on' ? 1 : 0
		    	]);
		    }

		    if($item->contact_information_fields->count()) {
		    	// Update contact information field if user update the name or hidden 
		    	$item->contact_information_fields()->update([
        			'name' => $item->name,
        			'name_field' => $item->name_field,
        			'is_hidden' => $item['hidden'],
		    	]);
		    } else {
		    	// create if no contact information field 
		    	
		    	$fields = ContactInformationField::groupBy('contact_information_id')->pluck('contact_information_id');
		    	
		    	foreach($fields as $field) {
		    		$info_field = ContactInformationField::where('contact_information_id', $field)->first();

		    		$item->contact_information_fields()->create([
		    			'contact_information_id' => $field,
		    			'category_id' => $info_field->category_id,
		    			'name' => $item->name,
		    			'name_field' => $item->name_field,
		    			'is_hidden' => $item['hidden'] ? true : false,
		    			'is_definite_fields' => true,
		    		]);
		    	}
		    }
	    }

	    return $item;
	}

	/*
	|--------------------------------------------------------------------------
	| @Appends
	|--------------------------------------------------------------------------
	*/
	public function getIsDefiniteFieldsAttribute() {
	    return true;
	}

	public function getArchiveUrlAttribute() {
	    return $this->renderArchiveUrl();
	}

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
	    return route($prefix . '.definite-fields.archive', $this->id);
	}


	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

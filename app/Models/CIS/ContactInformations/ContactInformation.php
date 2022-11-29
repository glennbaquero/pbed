<?php

namespace App\Models\CIS\ContactInformations;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ContactInformations\ContactInformationField;
use App\Models\CIS\ContactInformations\RequestInformation;
use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ConfidentialityCategories\ConfidentialityCategory;

use App\Models\CIS\DefiniteFields\DefiniteField;

class ContactInformation extends Model
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

	public function category()
	{
		return $this->belongsTo(ContactCategory::class, 'category_id');
	}

	public function fields()
	{
		return $this->hasMany(ContactInformationField::class);
	}

	public function requests()
	{
		return $this->hasMany(RequestInformation::class);
	}

	public function accesses()
	{
		return $this->belongsToMany(ConfidentialityCategory::class, 'information_accesses', 'contact_information_id', 'confidentiality_category_id');
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
	    $vars = $request->only(['category_id', 'notes']);

	    if (!$item) {
	        $item = static::create($vars);
	        $item->accesses()->sync($request->confidentiality_ids);
	        foreach (json_decode($request->fields) as $key => $value) {
	        	$item->fields()->create([
	        		'category_id' => $request->category_id,
	        		'name' => ucfirst($request->input($value->name_field.'Name')),
	        		'name_field' => $value->name_field,
	        		'value' => $request->input($value->name_field.'Value'),
	        		'is_hidden' => $value->hidden ?? $value->is_hidden,
	        		'required' => $value->required,
	        		'is_definite_fields' => $value->is_definite_fields,
	        		'definite_field_id' => $value->is_definite_fields ? $value->id  : null,
	        		'contact_category_field_id' => $value->is_definite_fields ? null : $value->id ,
	        	]);
	        }
	    } else {
	        $item->update($vars);
	        // $item->fields()->forceDelete();
	        $item->accesses()->sync($request->confidentiality_ids);
	        foreach (json_decode($request->fields) as $key => $value) {
	        	$item->fields->where('id', $value->id)->first()->update([
	        		'name' => ucfirst($request->input($value->name_field.'Name')),
	        		'name_field' => $value->name_field,
	        		'value' => $request->input($value->name_field.'Value'),
	        	]);
	        }
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
        $name = 'contact-informations.show';

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
        return route($prefix . '.contact-informations.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.contact-informations.restore', $this->id);
    }

    /*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| @Getters
	|--------------------------------------------------------------------------
	*/

	public function getColumns($is_hidden = false) {
		$fields = $this->fields;
		if($is_hidden) {
			$fields = $this->fields;
		}
		$columns = [];
		foreach ($fields as $key => $field) {
			if(!$is_hidden) {
				if($field->is_definite_fields) {
					array_push($columns, [
						'name' => $field->name,
					]);
				}
			} else {
				array_push($columns, [
					'name' => $field->name,
				]);
			}
		}

		return $columns;
	}

	public function getUserColumns($is_hidden = false) {
		$fields = $this->fields->where('is_definite_fields', true);
		// if($is_hidden) {
		// 	$fields = $this->fields;
		// }
		$columns = [];
		foreach ($fields as $key => $field) {
			// if($field->definite_field->deleted_at != null) {
				array_push($columns, [
					'name' => $field->name
				]);
			// }
		}

		return $columns;
	}

	public function getUserRows() {
		$fields = $this->fields->where('is_definite_fields', true);
		$user = auth()->guard('web')->user();
        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

		$rows = [];
		foreach ($fields as $key => $field) {
			// if($field->definite_field->deleted_at != null) {
				array_push($rows, [
					'value' =>  $this->validateConfidentiality($field->name, $field->value, $field->is_hidden, $user, $field->is_definite_fields, $field, $user_level_ids)
				]);
			// }
		}

		return $rows;
	}

	public function getExportedRows($user = false) {

		foreach ($this->fields as $key => $field) {
			$result[$field->name] = $this->validateConfidentiality($field->name, $field->value, $field->is_hidden, $user, $field->is_definite_fields, $field);
		}
		return $result;
	}

	public function getFieldValuesWithRestriction($auth, $user = true) {
        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

		foreach ($this->fields as $key => $field) {
			// dd($this->accesses->pluck('id')->toArray() == $user_access_level_id->toArray());
			$result[$field->name] = $this->validateConfidentiality($field->name, $field->value, $field->is_hidden, $user, $field->is_definite_fields, $field, $user_level_ids);
		}
		return $result;
	}

	public function validateConfidentiality($name, $value, $hidden, $user, $is_definite_fields, $field, $user_level_ids = []) {
		$result = $value;
		$has_access = $this->accesses()->whereIn('id', $user_level_ids)->get();
		$hidden = $field->is_hidden ? true : false;
		if($has_access->isEmpty()) {
			if($hidden) {
				if ($user) {
					$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
					$toLowerCaseName = strtolower($name);
					$checkIfNameContainsEmail = stripos($toLowerCaseName, 'email');
					$checkIfNameContainsContactNumber = stripos($toLowerCaseName, 'contact number');
					
					if($toLowerCaseName == 'email' || $checkIfNameContainsEmail) {
						// $result = preg_replace("/(?!^).(?=[^@]+@)/", "*", $value);
						$result = '**************';
					} elseif ($checkIfNameContainsContactNumber) {
						if(stripos($value, '+63')) {
							$replacePHPhoneCode = str_replace('+63', '0', $value);
							$value = $replacePHPhoneCode;
						}

						$firstTwoDigits = substr($value, 0, 2);
						$lastTwoDigits = substr($value, -2, 2);
						// $result = $firstTwoDigits.'******'.$lastTwoDigits;
						$result = $firstTwoDigits.'********';
					} else {
						// $firstTwoCharacters = substr($value, 0, 2);
						// $result = $firstTwoCharacters.'*******';
						$result = '********';
					}
				}
			}
		}

		return $result;
	}
}

<?php

namespace App\Models\CIS\UserClassifications;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CIS\ConfidentialityCategories\ConfidentialityCategory;
use App\Models\Users\User;

class UserClassification extends Model
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

	public function accesses()
	{
		return $this->belongsToMany(ConfidentialityCategory::class, 'classification_accesses', 'user_classification_id', 'confidentiality_category_id');
	}

    public function users()
    {
        return $this->belongsToMany(User::class, 'classifications', 'user_id', 'user_classification_id');
    }


	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/

     /**
     * Format Object's Properties
     * @param  object
     * @return object
     */
	public static function formatItem($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null)
    {
        $vars = $request->except(['category_ids']);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        $item->accesses()->sync($request->category_ids);

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
        $name = 'user-classifications.show';

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
        return route($prefix . '.user-classifications.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.user-classifications.restore', $this->id);
    }


    public function renderFormattedAccessForTable() {
        $access_label = '';
        foreach ($this->accesses as $key => $access) {
            $access_label .= $access->name;
            if(($key + 1) < $this->accesses->count()) {
                $access_label .= ', ';
            }
        }

        return $access_label;
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

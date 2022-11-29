<?php

namespace App\Models\CMS\YouthWorks;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\ImageTrait;

class YouthWorksTeam extends Model
{
	use ImageTrait;

	protected $table = 'youth_works_teams';
	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->reference_no,
            'type' => $this->type,
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
            'position' => $item->position,
            'type' => $item->type,
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
     public static function store($request, $item = null, $columns = ['name', 'position', 'type'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('image_path'))
        {
        	$item->storeImage($request->file('image_path'), 'image_path', 'youthworks/youth-work-teams-images');
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
        $name = 'youth-works-teams.show';

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
        return route($prefix . '.youth-works-teams.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.youth-works-teams.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

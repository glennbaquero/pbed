<?php

namespace App\Models\CMS\Organizations;

use App\Extenders\Models\BaseModel as Model;

class OurPeople extends Model
{

	protected $table = 'our_people';
	
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['position', 'name'])
    {
        $vars = $request->only($columns);

        if (!$item) {
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
        $name = 'our-people.show';

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
        return route($prefix . '.our-people.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.our-people.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

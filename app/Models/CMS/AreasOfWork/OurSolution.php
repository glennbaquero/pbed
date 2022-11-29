<?php

namespace App\Models\CMS\AreasOfWork;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\ImageTrait;

class OurSolution extends Model
{
	use ImageTrait;

	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['name', 'description'])
    {
        $vars = $request->only($columns);
        $vars['for_teaching_learning'] = $request->filled('for_teaching_learning');

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }


        if($request->hasFile('image_path'))
        {
        	$item->storeImage($request->file('image_path'), 'image_path', 'our-solutions-images');
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
        $name = 'solutions.show';

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
        return route($prefix . '.solutions.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.solutions.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

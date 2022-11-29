<?php

namespace App\Models\CMS\Organizations;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\ImageTrait;

class OurLeadership extends Model
{
    use ImageTrait;

    protected $appends = ['full_image'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'main_position' => $this->main_position,
            'position' => $this->position,
            'company' => $this->company,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['prefix', 'name', 'main_position', 'position', 'company'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('image_path'))
        {
        	$item->storeImage($request->file('image_path'), 'image_path', 'our-leaderships-images');
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
        $name = 'our-leaderships.show';

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
        return route($prefix . '.our-leaderships.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.our-leaderships.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/

/**
     * Append image full path
     *
     * @return string $image
     */
    public function getFullImageAttribute()
    {
        return $this->image_path ? $this->renderImagePath() : asset('images/person.png');
    }
}

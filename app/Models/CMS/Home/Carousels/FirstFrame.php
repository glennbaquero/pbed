<?php

namespace App\Models\CMS\Home\Carousels;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\ImageTrait;

class FirstFrame extends Model
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
            'header' => $this->header,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['header', 'description', 'image_path', 'for_youthwork'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('image_path'))
        {
        	$item->storeImage($request->file('image_path'), 'image_path', 'homepage-first_frame', false);
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
	public function renderShowUrl($prefix = 'admin', $name='home-first-frame.show') 
    {
        $route = $this->id;

        return route($prefix . ".{$name}", $route);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.home-first-frame.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.home-first-frame.restore', $this->id);
    }
}

<?php

namespace App\Models\CMS\News;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\ImageTrait;

use Carbon\Carbon;

class News extends Model
{
	use ImageTrait;
    
    protected $appends = ['formatted_created_at', 'full_image_path', 'show_url'];

	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'reference_no' => $this->reference_no,
            'description' => $this->description,
            'type' => $this->type,
            'position' => $this->position,
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
            'description' => $item->description,
            'reference_no' => $item->reference_no,
            'type' => $item->type,
            'position' => $item->position,
            'downloadable_file' => $item->downloadable_file,
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
     public static function store($request, $item = null, $columns = ['name', 'author', 'content', 'date_posted'])
    {
        $vars = $request->only($columns);

        $vars['featured'] = $request->filled('featured');

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('image_path'))
        {
        	$item->storeImage($request->file('image_path'), 'image_path', 'news-images');
        }

        return $item;
    }

    /*
    |--------------------------------------------------------------------------
    | @Appends
    |--------------------------------------------------------------------------
    */

    public function getFormattedCreatedAtAttribute() {
        return $this->date_posted ? Carbon::parse($this->date_posted)->format('F d, Y') : null;
    }

    public function getFullImagePathAttribute() {
        return url($this->renderImagePath());
    }

    public function getShowUrlAttribute() {
        return $this->renderPublicSiteShowUrl();
    }

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

    /**
     * Render show url for public site
     * 
     * @return string/route
     */
    public function renderPublicSiteShowUrl()
    {
        return route('web.news.show', [ $this->id, $this->author, $this->name ]);      
    }

    /**
     * Render show url for specific item
     * 
     * @return string/route
     */
	public function renderShowUrl($prefix = 'admin') 
    {
        $route = $this->id;
        $name = 'news.show';

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
        return route($prefix . '.news.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.news.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

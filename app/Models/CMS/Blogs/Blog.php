<?php

namespace App\Models\CMS\Blogs;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\ImageTrait;

use Carbon\Carbon;

class Blog extends Model
{

	use ImageTrait;
	
    protected $appends = ['formatted_created_at', 'full_image_path', 'show_url'];

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
	 * Store/Update resource to storage
	 * 
	 * @param  array $request
	 * @param  object $item
	 */
	public static function store($request, $item = null)
	{

		$vars = $request->except(['image_path']);

		$vars['featured'] = $request->filled('featured');
		$vars['for_youthworks'] = $request->filled('for_youthworks');
		
		if($request->filled('featured')) {
		    Blog::where('featured', true)->update(['featured' => false]);
		}

		if (!$item) {

			$item = self::create($vars);

		} else {

			$item->update($vars);
		
		}

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'blogs');
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
		return route('web.blogs.show', [ $this->id, $this->author, $this->name ]);		
	}

	/**
	 * Render show url for specific item
	 * 
	 * @return string/route
	 */
	public function renderShowUrl()
	{
		return route('admin.blogs.show', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.blogs.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.blogs.restore', $this->id);		
	}

	/**
	 * Render featured status
	 * 
	 */
	public function renderFeaturedStatus()
	{
		if($this->isFeatured()) {
			return 'Yes';
		}
		return 'No';
	}

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/

	/**
	 * Check if specific resource is featured
	 * 
	 * @return boolean
	 */
	public function isFeatured() 
	{
		if($this->featured) {
			return true;
		}
	}

}

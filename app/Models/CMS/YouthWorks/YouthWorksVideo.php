<?php

namespace App\Models\CMS\YouthWorks;

use App\Extenders\Models\BaseModel as Model;

class YouthWorksVideo extends Model
{

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

		$vars = $request->except(['']);

		if (!$item) {

			$item = self::create($vars);

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
	public function renderShowUrl()
	{
		return route('admin.youth-works-videos.show', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.youth-works-videos.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.youth-works-videos.restore', $this->id);		
	}

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/	

}

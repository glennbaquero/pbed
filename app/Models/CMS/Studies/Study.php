<?php

namespace App\Models\CMS\Studies;

use App\Extenders\Models\BaseModel as Model;

use App\Helpers\StringHelper;

use Storage;

class Study extends Model
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

		$vars = $request->except(['downloadable_file']);

		if (!$item) {

			$item = self::create($vars);

		} else {

			$item->update($vars);
		}

        if ($request->hasFile('downloadable_file')) {
			$path = $request->file('downloadable_file')->store('studies', 'public');
			$item->downloadable_file = $path;
			$item->save();            
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
		return route('admin.studies.show', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.studies.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.studies.restore', $this->id);		
	}

	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderDownloadUrl()
	{
		return route('admin.studies.download', $this->id);		
	}


	/**
	 * Render display name of specific resource from storage
	 * 
	 * @return string
	 */
	public function renderFileDisplayName()
	{
		$fileName = StringHelper::slugify($this->name);
		$ext = explode('.', $this->downloadable_file)[1];
		
		$fileName = $fileName . '.' . $ext;

		return $fileName;
	}

	/**
	 * Render file path of specific resource from storage
	 * 
	 */
	public function renderFilePath()
	{
        return 'storage/'. $this->downloadable_file;		
	}

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

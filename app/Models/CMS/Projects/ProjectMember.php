<?php

namespace App\Models\CMS\Projects;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\ImageTrait;

use App\Models\CMS\Projects\Project;

class ProjectMember extends Model
{

	use ImageTrait;

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


	public function project()
	{
		return $this->belongsTo(Project::class);
	}


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
	public static function store($request, $project = null, $item = null )
	{

		$vars = $request->except([]);

		if (!$item) {

			// $vars['project_id'] = $project->id;
			$item = self::create($vars);

		} else {

			$item->update($vars);
		}

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'projects');
        }

		return $item;

	} 

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

	/**
	 * Render fetch item url for specific item
	 * 
	 * @return string/route
	 */
	public function renderFetchItemUrl() 
	{
		return route('admin.project-members.fetch.item', $this->id);		
	}


	/**
	 * Render update url for specific item
	 * 
	 * @return string/route 
	 */
	public function renderUpdateUrl()
	{
		return route('admin.project-members.update', $this->id);
	}

	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.project-members.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.project-members.restore', $this->id);		
	}

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

<?php

namespace App\Models\CMS\Projects;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\ImageTrait;
use App\Traits\ManyImagesTrait;

use App\Models\CMS\Projects\Milestone;
use App\Models\CMS\Projects\ProjectMember;
use App\Models\Picture;

class Project extends Model
{

	use ImageTrait, ManyImagesTrait;

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


	public function milestones()
	{
		return $this->hasMany(Milestone::class);
	}

	public function members()
	{
		return $this->hasMany(ProjectMember::class);
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
	public static function store($request, $item = null)
	{

		$vars = $request->only(['name', 'description', 'link', 'header_title_label']);
		$vars['for_teacher_learning'] = $request->filled('for_teacher_learning');
		$vars['for_workforce_development'] = $request->filled('for_workforce_development');
		$vars['is_other_page'] = $request->filled('is_other_page');

		if (!$item) {

			$item = self::create($vars);

		} else {

			$item->update($vars);
		}

        if ($request->hasFile('icon')) {
            $item->storeImage($request->file('icon'), 'icon', 'projects');
        }

        if ($request->hasFile('slider_images')) {
            $item->addImages($request->file('slider_images'));
        }

		return $item;

	} 

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

	/**
	 * Render name of the record
	 * 
	 * @return string/route
	 */
	public function renderName() {
        return $this->name;
    }

	/**
	 * Render show url for specific item
	 * 
	 * @return string/route
	 */
	public function renderShowUrl()
	{
		return route('admin.projects.show', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.projects.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.projects.restore', $this->id);		
	}

    public function renderRemoveImageUrl($prefix = 'admin') 
    {
        return route($prefix . '.projects.remove-image', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

<?php

namespace App\Models\CMS\Works;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CMS\Works\WorkChallenge;
use App\Models\CMS\Works\WorkSolution;

class Work extends Model
{
	protected $table = 'works';

    protected static $logAttributes = ['name', 'header'];
    protected static $ignoreChangedAttributes = ['updated_at'];


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

	public function challenges()
	{
		return $this->hasMany(WorkChallenge::class);
	}

	public function solutions()
	{
		return $this->hasManyWork(WorkSolution::class);
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

		$vars = $request->except([]);

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
		return route('admin.works.show', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.works.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.works.restore', $this->id);		
	}


	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

<?php

namespace App\Models\CMS\Works;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CMS\Works\Work;
use App\Models\CMS\Works\ChallengeItem;

class WorkChallenge extends Model
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


	public function work()
	{
		return $this->belongsTo(Work::class)->withTrashed();
	}

	public function items()
	{
		return $this->hasMany(ChallengeItem::class, 'work_challenge_id');
	}


	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/

	public function toSearchableArray()
    {
        return [
			'id' => $this->id,
        ];
    }

	/**
	 * Store/Update resource to stroage
	 * 
	 * @param  array $request
	 * @param  int $workID
	 * @param  object $item
	 */
	public static function store($request, $work = null, $item = null)
	{	
		$challengeVars = $request->only(['name', 'description']);
		$oldIds = [];
		$newIds = [];

		if (!$item) {
		
			$challengeVars['work_id'] = $work->id;
			$item = self::create($challengeVars);

		} else {
		
			$item->update($challengeVars);
			$oldIds = $item->items->pluck('id')->toArray();
		
		}


		foreach ($request->items as $key => $challengeItem) {
			if(!isset($challengeItem['id'])) {
			
				$item->items()->create($challengeItem);
			
			} else {
			
				array_push($newIds, $challengeItem['id']);
				
				$challenge = ChallengeItem::find($challengeItem['id']);
				$challenge->update($challengeItem);
			
			}
		}		

		if(count($oldIds)) {
			$idsToDelete = array_diff($oldIds, $newIds);

			/** Delete items */
			ChallengeItem::whereIn('id', $idsToDelete)->delete();
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
		return route('admin.work-challenges.fetch.item', $this->id);		
	}


	/**
	 * Render update url for specific item
	 * 
	 * @return string/route 
	 */
	public function renderUpdateUrl()
	{
		return route('admin.work-challenges.update', $this->id);
	}

	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.work-challenges.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.work-challenges.restore', $this->id);		
	}

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

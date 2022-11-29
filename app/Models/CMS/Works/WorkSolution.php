<?php

namespace App\Models\CMS\Works;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\ImageTrait;
use App\Helpers\FileHelper;

use App\Models\CMS\Works\Work;
use App\Models\CMS\Works\SolutionItem;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use Storage;

class WorkSolution extends Model
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

	public function work()
	{
		return $this->belongsTo(Work::class)->withTrashed();
	}

	public function items()
	{
		return $this->hasMany(SolutionItem::class);
	}

	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * Store/Update resource to stroage
	 * 
	 * @param  array $request
	 * @param  int $workID
	 * @param  object $item
	 */
	public static function store($request, $work, $item = null)
	{
		$solutionVars = $request->only(['name', 'description']);

		$oldIds = [];
		$newIds = [];

		if(!$item) {

			$solutionVars['work_id'] = $work->id;
			$item = self::create($solutionVars);

		} else {

			$item->update($solutionVars);
			$oldIds = $item->items->pluck('id')->toArray();
		}

		if(isset($request->items)) {

			foreach ($request->items as $key => $solutionItem) {
				$solution = null;
				$data = json_decode($solutionItem);
				$vars = [
					'name' => $data->name,
					'description' => $data->description
				];

				if(!isset($data->id)) {

					$solution = $item->items()->create($vars);

				} else {
					array_push($newIds, $data->id);

					$solution = SolutionItem::find($data->id);
					$solution->update($vars);

				}
				if($data->icon) {
			        
			        $base64 = substr($data->icon, strpos($data->icon, ',') +1);
			        $image = Image::make($base64);
			        $extension = 'jpeg';

			        $image = $image->resize(300, 300);
			        $image = $image->encode($extension);

			        switch (config('web.filesystem')) {
			            case 's3':
			                    $root = null;
			                break;
			            
			            default:
			                    $root = 'public/';
			                break;
			        }
			        $fileName = uniqid() . Str::random(40) . '.' . $extension;
			        $file_path = 'icons/' . $fileName;

			        $absolute_path = $root . $file_path;
			        Storage::put($absolute_path, $image);

		            $solution->icon = Storage::url('icons/' . $fileName);
		            $solution->save();
				}
				
			}
		}

		if(count($oldIds)) {
			$idsToDelete = array_diff($oldIds, $newIds);

			/** Delete items */
			SolutionItem::whereIn('id', $idsToDelete)->delete();
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
		return route('admin.work-solutions.fetch.item', $this->id);		
	}


	/**
	 * Render update url for specific item
	 * 
	 * @return string/route 
	 */
	public function renderUpdateUrl()
	{
		return route('admin.work-solutions.update', $this->id);
	}

	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderArchiveUrl()
	{
		return route('admin.work-solutions.archive', $this->id);		
	}


	/**
	 * Render archive url for specific item
	 * 
	 * @return string/route
	 */
	public function renderRestoreUrl()
	{
		return route('admin.work-solutions.restore', $this->id);		
	}


	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}

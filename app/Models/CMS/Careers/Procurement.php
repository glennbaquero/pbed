<?php

namespace App\Models\CMS\Careers;

use App\Extenders\Models\BaseModel as Model;

use App\Traits\FileTrait;

use Carbon\Carbon;
use Storage;

class Procurement extends Model
{
    use FileTrait;

    const CallForProposals = 0;
    const RequestForProposals = 1;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cfp_no' => $this->cfp_no,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['cfp_no', 'title', 'description', 'file_path', 'type', 'deadline'])
    {
        $vars = $request->only($columns);
        $vars['downloadable'] = $request->filled('downloadable');

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->has('file_path'))
        {
    	    $path = $request->file('file_path')->store('procurements', 'public');
    	    $item->file_path = $path;
    	    $item->save();
        }

        return $item;
    }

    public static function fetchItem($type = null) {
        $items = Procurement::all();
        
        if($type != null) {
            $items = Procurement::where('type', $type)->get();
        }

        $response = [];

        foreach($items as $item) {
            array_push($response, [
                'file_path' => $item->renderFilePath(),
                'full_file_path' => url($item->renderFilePath()),
                'type' => $item->type,
                'id' => $item->id,
                'cfp_no' => $item->cfp_no,
                'title' => $item->title,
                'deadline' => Carbon::parse($item->deadline)->format('F d, Y'),
                'description' => strip_tags($item->description),
                'downloadable' => $item->downloadable ? true : false,
                'short_description' => str_limit(strip_tags($item->description), 50)
            ]);
        }     

        return $response;
    }
   
    /*
    |--------------------------------------------------------------------------
    | @Getters
    |--------------------------------------------------------------------------
    */
   
    public static function getProposals() {
        return [
            ['id' => static::CallForProposals, 'name' => 'Call For Proposals'],
            ['id' => static::RequestForProposals, 'name' => 'Request For Proposals'],
        ];
    }

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

    public function renderProposalLabel() {
        return $this->renderConstants(static::getProposals(), $this->type, 'label');
    }

    public function renderPropalClass() {
        return $this->renderConstants(static::getProposals(), $this->type, 'class');
    }

    /**
     * Render show url for specific item
     * 
     * @return string/route
     */
	public function renderShowUrl($prefix = 'admin') 
    {
        $route = $this->id;
        $name = 'procurements.show';

        return route($prefix . ".{$name}", $route);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.procurements.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.procurements.restore', $this->id);
    }
}

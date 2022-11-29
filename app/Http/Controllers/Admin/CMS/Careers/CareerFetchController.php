<?php

namespace App\Http\Controllers\Admin\CMS\Careers;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\CMS\Careers\Career;

class CareerFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Career;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        /**
         * Queries
         * 
         */
        
        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {

        $result = [];

        foreach($items as $item) {
            $data = $this->formatItem($item);
            array_push($result, $data);
        }

        return $result;
    }

    /**
     * Build array data
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item)
    { 

        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'reference_no' => $item->reference_no,
            'type' => $item->type,
            'position' => $item->position,
            'job_expiry' => $item->renderDate('job_expiry'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
            ];
    }

    public function fetchView($id = null) {
        $item = null;

        if ($id) {
        	$item = Career::withTrashed()->findOrFail($id);
            $item->image_path = $item->renderImagePath();      
            $item->fileUrl = $item->full_file_path;      
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    	]);
    }
}

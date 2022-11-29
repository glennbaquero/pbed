<?php

namespace App\Http\Controllers\Admin\CMS\Procurements;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CMS\Careers\Procurement;

class ProcurementFetchController extends Controller
{
    
	/**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Procurement;
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
            'cfp_no' => $item->cfp_no,
            'title' => $item->title,
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
		];
    }

    public function fetchItem($id = null) {
        $item = null;
        $types = Procurement::getProposals();
        if ($id) {
        	$item = Procurement::withTrashed()->findOrFail($id);      
            $item->file_path = $item->renderFilePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
            'item' => $item,
    		'types' => $types,
    	]);
    }
}

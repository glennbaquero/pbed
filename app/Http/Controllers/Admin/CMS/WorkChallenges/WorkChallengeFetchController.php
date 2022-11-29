<?php

namespace App\Http\Controllers\Admin\CMS\WorkChallenges;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CMS\Works\WorkChallenge;

class WorkChallengeFetchController extends Controller
{

    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new WorkChallenge;
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
        
        if($this->request->filled('work_id')) {
        	$query = $query->where('work_id', $this->request->input('work_id'));
        }

        return $query->withTrashed();
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
            'created_at' => $item->renderDate(),
            'fetchItemUrl' => $item->renderFetchItemUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchItem($id = null) {
        $item = null;

        if ($id) {
        	$item = WorkChallenge::withTrashed()->findOrFail($id);
            $item->updateUrl = $item->renderUpdateUrl();
        }

    	return response()->json([
    		'item' => $item,
            'graph_items' => $item->items
    	]);
    }

}

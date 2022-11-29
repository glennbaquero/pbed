<?php

namespace App\Http\Controllers\Admin\CMS\Members;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CMS\Organizations\Member;

class MemberFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Member;
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
        
        $this->per_page = 9999999;
        $this->orderBy = 'order';
        
        if($this->request->filled('individual')) {
            $query = $query->where('type', 'Individuals');
        } else {
            $query = $query->where('type', 'Corporations');
        }

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
            'type' => $item->type,
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;
        $item['type'] = 'Individuals';

        if ($id) {
        	$item = Member::withTrashed()->findOrFail($id);      
            $item->image_path = $item->image_path ? $item->renderImagePath() : null;
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    	]);
    }
}

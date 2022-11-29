<?php

namespace App\Http\Controllers\Admin\CMS\YouthWorksFirstFrame;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CMS\Home\Carousels\FirstFrame;

class FirstFrameFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new FirstFrame;
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
        $query = $query->where('for_youthwork', $this->request->is_youthwork);
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
            'header' => $item->header,
            'image_path' => $item->renderImagePath('image_path'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl('admin', 'youthwork-first-frame.show'),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
		];
    }

    public function fetchItem($id = null) {
        $item = null;

        if ($id) {
        	$item = FirstFrame::withTrashed()->findOrFail($id);      
            $item->image_path = $item->renderImagePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    	]);
    }
}

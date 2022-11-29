<?php

namespace App\Http\Controllers\Admin\CMS\Events;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\CMS\News\Event;

class EventFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Event;
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
            'featured' => $item->featured ? 'Featured' : '---',
            'image_path' => $item->renderImagePath('image_path'),
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
        	$item = Event::withTrashed()->findOrFail($id);      
            $item->image_path = $item->renderImagePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    	]);
    }
}

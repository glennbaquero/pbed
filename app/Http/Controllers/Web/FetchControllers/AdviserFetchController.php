<?php

namespace App\Http\Controllers\Web\FetchControllers;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CMS\Organizations\Adviser;


class AdviserFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Adviser;
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
        
        $this->per_page = 8;
        $this->orderBy = 'order';
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
            'name' => $item->prefix.' '.$item->name,
            'position' => $item->position,
            'main_position' => $item->main_position ?? null,
            'company' => $item->company,
            'image_path' => $item->renderImagePath(),
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;

        if ($id) {
            $item = Adviser::withTrashed()->findOrFail($id);      
            $item->image_path = $item->renderImagePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}

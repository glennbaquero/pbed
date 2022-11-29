<?php

namespace App\Http\Controllers\Admin\CIS\RequestInformation;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\ContactInformations\RequestInformation;

class RequestInformationFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new RequestInformation;
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
        $query = $query->where('type', $this->request->type);
        
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
            'requestor' => optional($item->user)->renderName(),
            'requested_contact' => $item->renderShowContactUrl($item->contact_information_id),
            'status' => $item->status,
            'reason' => strip_tags($item->reason),
            'created_at' => $item->renderDate(),
            'deleted_at' => $item->deleted_at,
            'canArchive' => $item->canArchive(),
            'approveUrl' => $item->renderApproveUrl(),
            'disapproveUrl' => $item->renderDisapproveUrl(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

}

<?php

namespace App\Http\Controllers\Admin\CIS\Users;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\Users\User;
use App\Models\CIS\UserClassifications\UserClassification;

class UserFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new User;
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
        if ($this->request->filled('email_verified_at')) {
            if ($this->request->input('email_verified_at') == 1) {
                $query = $query->whereNotNull('email_verified_at');
            } else {
                $query = $query->whereNull('email_verified_at');
            }
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
            'email' => $item->email,
            'position' => $item->position,
            'user_classification_id' => $item->renderFormattedClassificationsForTable(),
            'status' => $item->renderAccountStatus(),
            'verified_at' => $item->renderDate('verified_at'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'deleted_at' => $item->deleted_at,
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    public function fetchView($id = null) {
        $item = [];

        $user_classification = UserClassification::all();

        if ($id) {
            $item = User::withTrashed()->findOrFail($id);
            $item->user_classification_id = $item->classifications->pluck('id')->toArray();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
            $item->renderImage = $item->renderImagePath();
        }

        return response()->json([
            'item' => $item,
            'user_classification' => $user_classification,
        ]);
    }
}

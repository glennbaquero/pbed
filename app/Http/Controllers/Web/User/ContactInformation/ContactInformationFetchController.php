<?php

namespace App\Http\Controllers\Web\User\ContactInformation;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\ContactInformations\RequestInformation;
use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ContactCategories\ContactCategoryField;
use App\Models\CIS\ConfidentialityCategories\ConfidentialityCategory;
use App\Models\CIS\DefiniteFields\DefiniteField;

class ContactInformationFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new ContactInformation;
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
        
        // $user_level_ids = auth()->guard('web')->user()->classifications->pluck('id')->toArray();
        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

        if($this->request->has('category')) {
            $query = $query->where('category_id', $this->request->category);
        }

        // $query = $query->whereHas('accesses', function($query) use($user_level_ids) {
        //     $query->whereIn('id', $user_level_ids);
        // });

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
            'name' => $item->category->name,
            'columns' => $item->getUserColumns(),
            'export_columns' => $item->getUserColumns(true),
            'rows' => $item->getUserRows(),
            'export_rows' => $item->getExportedRows(true),
            'created_at' => $item->renderDate(),
            'showUserUrl' => $item->renderShowUserUrl(),
        ];
    }


    public function fetchItem($id = null) {
        $item = null;
        $request = null;
        $categories = ContactCategory::all();
        $confidentialities = ConfidentialityCategory::all();
        $fields = ContactCategoryField::all();
        $definite_fields = DefiniteField::all();
        $auth = auth()->guard('web')->user();
        // Geeting user level access
        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

        if ($id) {
            $item = ContactInformation::withTrashed()->findOrFail($id);
            $has_no_access = $item->accesses()->whereIn('id', $user_level_ids)->get()->isEmpty();
            $item->confidentiality_ids = $item->accesses()->pluck('id')->toArray();
            $item->fieldValues = $item->getFieldValuesWithRestriction($auth);
            $reason = RequestInformation::where(['contact_information_id' => $id, 'user_id' => auth()->guard('web')->user()->id])->first();
            $request = RequestInformation::where(['contact_information_id' => $id, 'user_id' => auth()->guard('web')->user()->id])->count();
            $hasRequest = RequestInformation::where(['contact_information_id' => $id, 'user_id' => auth()->guard('web')->user()->id])->first() ? true : false;
        }

        return response()->json([
            'item' => $item,
            'request' => $request,
            'reason' => $reason,
            'hasRequest' => $hasRequest,
            'categories' => $categories,
            'confidentialities' => $confidentialities,
            'fields' => $fields,
            'has_no_access' => $has_no_access,
            'definite_fields' => $definite_fields,
        ]);
    }
}

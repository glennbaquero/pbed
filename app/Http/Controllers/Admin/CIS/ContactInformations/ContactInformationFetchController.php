<?php

namespace App\Http\Controllers\Admin\CIS\ContactInformations;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\CIS\ContactInformations\ContactInformation;
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
        
        if($this->request->has('category')) {
            $query = $query->where('category_id', $this->request->category);
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
            'name' => $item->category->name,
            'columns' => $item->getColumns(),
            'selected' => false,
            'export_columns' => $item->getColumns(true),
            'rows' => $item->fields->where('is_definite_fields', true),
            'export_rows' => $item->getExportedRows(false),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
            'deleted_at' => $item->deleted_at,
        ];
    }


    public function fetchItem($id = null) {
        $item = null;
        $categories = ContactCategory::all();
        $confidentialities = ConfidentialityCategory::all();
        $fields = ContactCategoryField::all();
        $definite_fields = DefiniteField::all();
        if ($id) {
            $item = ContactInformation::withTrashed()->findOrFail($id);
            $item->confidentiality_ids = $item->accesses()->pluck('id')->toArray();
            $item->fieldValues = $item->fields;
            $item->archiveUrl = $item->renderArchiveUrl();      
            $item->restoreUrl = $item->renderRestoreUrl();
        }

        return response()->json([
            'item' => $item,
            'categories' => $categories,
            'confidentialities' => $confidentialities,
            'fields' => $fields,
            'definite_fields' => $definite_fields,
        ]);
    }
}

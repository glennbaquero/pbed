<?php

namespace App\Http\Controllers\Admin\CIS\ContactInformations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CIS\ContactInformations\ContactInformationStoreRequest;

use App\Imports\CIS\ContactInformationImport;

use App\Exports\SampleFormatForBatchUpload;
use App\Exports\BatchUploadFormatter;

use App\Imports\CIS\ContactInformationAndCategoryFieldImport;
use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\DefiniteFields\DefiniteField;

use DB;
use Excel;
use File;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ContactCategory::all();
        return view('admin.cis.contact-informations.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cis.contact-informations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactInformationStoreRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = ContactInformation::store($request);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully created ' . $item->name;

        return response()->json([
            'message' => $message,
            'redirect' => $item->renderShowUrl(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ContactInformation::withTrashed()->find($id);

        return view('admin.cis.contact-informations.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactInformationStoreRequest $request, $id)
    {
        $item = ContactInformation::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Update item */
            $item = ContactInformation::store($request, $item);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully updated ' . $item->name;

        return response()->json([
            'message' => $message,
        ]);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = ContactInformation::withTrashed()->findOrFail($id);
  
        /** Start transaction */
        DB::beginTransaction();
                
            /** Archive item */
            $item->archive();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived {$item->name}",
        ]);
    }


    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = ContactInformation::onlyTrashed()->findOrFail($id);
        
        /** Start transaction */
        DB::beginTransaction();
                
            /** Restore item */
            $item->restore();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully restored {$item->name}",
        ]);
    }

    public function import() 
    {
        $categories = ContactCategory::all();
        $sample = url('Sample Format.xls');
        return view('admin.cis.contact-informations.upload', [
            'categories' => $categories,
            'sample' => $sample
        ]);
    }

    public function upload(Request $request) 
    {   
        $request->validate([
            'manifest' => 'required',
            'category' => 'required'
        ]);

        $result = Excel::import(new ContactInformationImport($request), $request->file('manifest'));

        $message = 'You have successfully uploaded a manifest.';

        return response()->json([
            'message' => $message,
        ]);
    } 

    public function batchDeletion(Request $request) 
    {
        DB::beginTransaction();
            $items = ContactInformation::whereIn('id', $request->all())->delete();
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived the selected items",
        ]);
    }

    public function batchRestore(Request $request)
    {
        DB::beginTransaction();
            $items = ContactInformation::whereIn('id', $request->all())->restore();
        DB::commit();

        return response()->json([
            'message' => "You have successfully restore the selected items",
        ]);
    }

    public function updateExcelFile(Request $request)
    {
        $rows = [];
        $category = ContactCategory::find($request->category);
        $definite_fields = DefiniteField::all();

        $message = 'Exporting data, please wait...';

        // Excel::loadView('admin.cis.contact-informations.upload', array('category', 'definite_fields'))->export('xls');
        if (!$request->ajax()) {
            return Excel::download(new SampleFormatForBatchUpload($category, $definite_fields),'Sample Format.xls');
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\CIS\RequestInformation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\ContactInformations\RequestInformation;

use DB;

class RequestInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cis.request-information.index', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = RequestInformation::store($request);

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
        $item = RequestInformation::find($id);

        return view('admin.cis.request-information.show', [
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
    public function update(Request $request, $id)
    {
        $item = RequestInformation::find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Update item */
            $item = RequestInformation::store($request, $item);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully updated ' . $item->name;

        return response()->json([
            'message' => $message,
        ]);
    }

     /**
     * Approved specified resource from storage
     * 
     * @param  int $id
     */
    public function approve($id)
    {
        $item = RequestInformation::withTrashed()->findOrFail($id);       
        $contact_id = $item->contact_information_id; 
        
        /** Start transaction */
        DB::beginTransaction();

            $item->updateStatus(true, $contact_id, $id);

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully approved the request",
        ]);

    }

    /**
     * Disapproved specified resource from storage
     * 
     * @param  int $id
     */
    public function disapprove($id)
    {
        $item = RequestInformation::withTrashed()->findOrFail($id);        
        $contact_id = $item->contact_information_id; 
        
        /** Start transaction */
        DB::beginTransaction();

            $item->updateStatus(false, $contact_id, $id);

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully disapproved the request",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = RequestInformation::findOrFail($id);
  
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
        $item = RequestInformation::onlyTrashed()->findOrFail($id);
        
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
}

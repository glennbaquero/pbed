<?php

namespace App\Http\Controllers\Admin\CIS\DefiniteFields;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CIS\DefiniteFields\DefiniteFieldRequest;

use App\Models\CIS\DefiniteFields\DefiniteField;

use DB;

class DefiniteFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cis.definite-fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DefiniteFieldRequest $request)
    {

        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = DefiniteField::store($request);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully update the fields.';

        return response()->json([
            'message' => $message,
            'redirect' => route('admin.definite-fields.create'),
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SampleItem  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = DefiniteField::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();

            $item->contact_information_fields()->delete();
        
            /** Archive DefiniteField */
            $item->archive();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived {$item->name}",
        ]);
    }
}

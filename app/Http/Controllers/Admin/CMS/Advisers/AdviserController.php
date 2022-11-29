<?php

namespace App\Http\Controllers\Admin\CMS\Advisers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CMS\Advisers\AdviserStoreRequest;

use App\Models\CMS\Organizations\Adviser;

use DB;

class AdviserController extends Controller
{

    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\Advisers\AdviserIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advisers\AdviserCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advisers\AdviserUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advisers\AdviserArchiveMiddleware', 
            ['only' => ['archive', 'restore']]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.cms.advisers.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.advisers.create' , [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdviserStoreRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = Adviser::store($request);

        /** End transaction */
        DB::commit();
        
        $message = "You have successfully added {$item->renderName()}";
        $redirect = $item->renderShowUrl();

        return response()->json([
            'message' => $message,
            'redirect' => $redirect,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Adviser::withTrashed()->findOrFail($id);

        return view('admin.cms.advisers.show', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AdviserStoreRequest $request, $id)
    {
        $item = Adviser::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = Adviser::store($request, $item);

        /** End transaction */
        DB::commit();
       

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SampleItem  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = Adviser::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Archive news */
            $item->archive();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = Adviser::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Unarchive news */
            $item->unarchive();

        /** End transaction */
        DB::commit();
        

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    
    public function reOrder(Request $request) {
        foreach ($request->items as $key => $item) {

            $timeslot = Adviser::find($item['id']);

            if($timeslot) {
                $timeslot->update(['order' => $key ]);
            }

        }

        return response()->json([
            'message' => 'Successfully updated the order',
        ]);
    }
}

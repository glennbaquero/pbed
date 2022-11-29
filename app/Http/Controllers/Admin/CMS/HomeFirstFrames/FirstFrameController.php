<?php

namespace App\Http\Controllers\Admin\CMS\HomeFirstFrames;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CMS\FirstFrames\FirstFrameStoreRequest as Request;

use App\Models\CMS\Home\Carousels\FirstFrame;

use DB;

class FirstFrameController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\FirstFrame\FirstFrameIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FirstFrame\FirstFrameCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FirstFrame\FirstFrameUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FirstFrame\FirstFrameArchiveMiddleware', 
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
        return view('admin.cms.home.first-frame.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.home.first-frame.create' , [
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
        
            /** Store news */
            $item = FirstFrame::store($request);

        /** End transaction */
        DB::commit();
        
        $message = "You have successfully added {$item->header}";
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
        $item = FirstFrame::withTrashed()->findOrFail($id);

        return view('admin.cms.home.first-frame.show', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = FirstFrame::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->header}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = FirstFrame::store($request, $item);

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
        $item = FirstFrame::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Archive news */
            $item->archive();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived {$item->header}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = FirstFrame::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Unarchive news */
            $item->unarchive();

        /** End transaction */
        DB::commit();
        

        return response()->json([
            'message' => "You have successfully restored {$item->header}",
        ]);
    }
}

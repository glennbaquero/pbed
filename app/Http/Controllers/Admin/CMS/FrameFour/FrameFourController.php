<?php

namespace App\Http\Controllers\Admin\CMS\FrameFour;

// use Illuminate\Http\Request;
use App\Http\Requests\Admin\CMS\FrameFour\FrameFourStoreRequest as Request;
use App\Http\Controllers\Controller;

use App\Models\CMS\AreasOfWork\FrameFour;

use DB;

class FrameFourController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\FrameFour\FrameFourIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FrameFour\FrameFourCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FrameFour\FrameFourUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\FrameFour\FrameFourArchiveMiddleware', 
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
        return view('admin.cms.frame-four.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.frame-four.create');
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

            /** Store FrameFours */
            $item = FrameFour::store($request);

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
        $item = FrameFour::withTrashed()->find($id);

        return view('admin.cms.frame-four.show', [
            'item' => $item
        ]);
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
        $item = FrameFour::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Update item */
            $item = FrameFour::store($request, $item);

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
        $item = FrameFour::withTrashed()->findOrFail($id);
  
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
        $item = FrameFour::onlyTrashed()->findOrFail($id);
        
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

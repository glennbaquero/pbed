<?php

namespace App\Http\Controllers\Admin\CMS\ProjectPriorityAreas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CMS\YouthWorks\ProjectPriorityArea;

use DB;

class ProjectPriorityAreaController extends Controller
{

    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\ProjectPriorityAreas\ProjectPriorityAreaIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\ProjectPriorityAreas\ProjectPriorityAreaCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\ProjectPriorityAreas\ProjectPriorityAreaUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\ProjectPriorityAreas\ProjectPriorityAreaArchiveMiddleware', 
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
        return view('admin.cms.project-priority-area.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.project-priority-area.create' , [
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
        $request->validate([
            'name' => 'required'
        ]);
        /** Start transaction */
        DB::beginTransaction();
            /** Store news */
            $item = ProjectPriorityArea::store($request);

        /** End transaction */
        DB::commit();
        
        $message = "You have successfully added {$item->name}";
        $redirect = $item->renderShowUrl('admin', 'project-priority-areas.show');

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
        $item = ProjectPriorityArea::withTrashed()->findOrFail($id);

        return view('admin.cms.project-priority-area.show', [
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
        $request->validate([
            'name' => 'required'
        ]);
        $item = ProjectPriorityArea::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->name}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = ProjectPriorityArea::store($request, $item);

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
        $item = ProjectPriorityArea::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Archive news */
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
        $item = ProjectPriorityArea::withTrashed()->findOrFail($id);

        /** Start transaction */
        DB::beginTransaction();
        
            /** Unarchive news */
            $item->unarchive();

        /** End transaction */
        DB::commit();
        

        return response()->json([
            'message' => "You have successfully restored {$item->name}",
        ]);
    }
}

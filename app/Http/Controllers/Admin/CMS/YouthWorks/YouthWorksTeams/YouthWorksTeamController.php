<?php

namespace App\Http\Controllers\Admin\CMS\YouthWorks\YouthWorksTeams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CMS\YouthWorks\YouthWorksTeamRequest;

use App\Models\CMS\YouthWorks\YouthWorksTeam;

use DB;

class YouthWorksTeamController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\Teams\TeamIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Teams\TeamCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Teams\TeamUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Teams\TeamArchiveMiddleware', 
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
        return view('admin.cms.youth-works.youth-works-teams.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.youth-works.youth-works-teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YouthWorksTeamRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = YouthWorksTeam::store($request);

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
        $item = YouthWorksTeam::withTrashed()->find($id);

        return view('admin.cms.youth-works.youth-works-teams.show', [
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
    public function update(YouthWorksTeamRequest $request, $id)
    {
        $item = YouthWorksTeam::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Update item */
            $item = YouthWorksTeam::store($request, $item);

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
        $item = YouthWorksTeam::withTrashed()->findOrFail($id);
  
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
        $item = YouthWorksTeam::onlyTrashed()->findOrFail($id);
        
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

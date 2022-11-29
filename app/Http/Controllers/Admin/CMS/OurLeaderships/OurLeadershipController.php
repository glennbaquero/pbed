<?php

namespace App\Http\Controllers\Admin\CMS\OurLeaderships;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CMS\Leaderships\OurLeadershipStoreRequest;
use App\Http\Controllers\Controller;

use App\Models\CMS\Organizations\OurLeadership;

use DB;

class OurLeadershipController extends Controller
{

    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\Leaderships\LeadershipIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Leaderships\LeadershipCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Leaderships\LeadershipUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Leaderships\LeadershipArchiveMiddleware', 
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
        return view('admin.cms.our-leaderships.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.our-leaderships.create' , [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OurLeadershipStoreRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = OurLeadership::store($request);

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
        $item = OurLeadership::withTrashed()->findOrFail($id);

        return view('admin.cms.our-leaderships.show', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(OurLeadershipStoreRequest $request, $id)
    {
        $item = OurLeadership::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = OurLeadership::store($request, $item);

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
        $item = OurLeadership::withTrashed()->findOrFail($id);

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
        $item = OurLeadership::withTrashed()->findOrFail($id);

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

            $timeslot = OurLeadership::find($item['id']);

            if($timeslot) {
                $timeslot->update(['order' => $key ]);
            }

        }

        return response()->json([
            'message' => 'Successfully updated the order',
        ]);
    }
}

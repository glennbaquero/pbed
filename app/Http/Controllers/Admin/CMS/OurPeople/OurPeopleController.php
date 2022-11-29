<?php

namespace App\Http\Controllers\Admin\CMS\OurPeople;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CMS\People\PeopleStoreRequest;
use App\Http\Controllers\Controller;

use App\Models\CMS\Organizations\OurPeople;

use DB;

class OurPeopleController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\People\PeopleIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\People\PeopleCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\People\PeopleUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\People\PeopleArchiveMiddleware', 
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
        return view('admin.cms.our-people.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.our-people.create' , [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleStoreRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = OurPeople::store($request);

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
        $item = OurPeople::withTrashed()->findOrFail($id);

        return view('admin.cms.our-people.show', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleStoreRequest $request, $id)
    {
        $item = OurPeople::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = OurPeople::store($request, $item);

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
        $item = OurPeople::withTrashed()->findOrFail($id);

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
        $item = OurPeople::withTrashed()->findOrFail($id);

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

            $timeslot = OurPeople::find($item['id']);

            if($timeslot) {
                $timeslot->update(['order' => $key ]);
            }

        }

        return response()->json([
            'message' => 'Successfully updated the order',
        ]);
    }
}

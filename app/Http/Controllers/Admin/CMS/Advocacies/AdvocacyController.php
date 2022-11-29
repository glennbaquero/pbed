<?php

namespace App\Http\Controllers\Admin\CMS\Advocacies;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CMS\Advocacies\AdvocacyStoreRequest as Request;

use App\Models\CMS\AreasOfWork\Advocacy;

use DB;

class AdvocacyController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CMS\Advocacies\AdvocacyIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advocacies\AdvocacyCreateMiddleware', 
            ['only' => ['create', 'store']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advocacies\AdvocacyUpdateMiddleware', 
            ['only' => ['update', 'show']]
        );
        $this->middleware('App\Http\Middleware\Admin\CMS\Advocacies\AdvocacyArchiveMiddleware', 
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
        return view('admin.cms.advocacies.index', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.advocacies.create' , [
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
            $item = Advocacy::store($request);

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
        $item = Advocacy::withTrashed()->findOrFail($id);

        return view('admin.cms.advocacies.show', [
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
        $item = Advocacy::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->header}";

        /** Start transaction */
        DB::beginTransaction();
        
            /** Store news */
            $item = Advocacy::store($request, $item);

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
        $item = Advocacy::withTrashed()->findOrFail($id);

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
        $item = Advocacy::withTrashed()->findOrFail($id);

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

<?php

namespace App\Http\Controllers\Admin\CMS\YouthWorks\YouthWorksCourses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CMS\YouthWorks\YouthWorksCourseRequest;

use App\Models\CMS\YouthWorks\YouthWorksCourse;

use DB;

class YouthWorksCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.youth-works.youth-works-courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.youth-works.youth-works-courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YouthWorksCourseRequest $request)
    {
        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = YouthWorksCourse::store($request);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully created ' . $item->course;

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
        $item = YouthWorksCourse::withTrashed()->find($id);

        return view('admin.cms.youth-works.youth-works-courses.show', [
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
    public function update(YouthWorksCourseRequest $request, $id)
    {
        $item = YouthWorksCourse::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Update item */
            $item = YouthWorksCourse::store($request, $item);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully updated ' . $item->course;

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
        $item = YouthWorksCourse::withTrashed()->findOrFail($id);
  
        /** Start transaction */
        DB::beginTransaction();
                
            /** Archive item */
            $item->archive();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully archived {$item->course}",
        ]);
    }


    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = YouthWorksCourse::onlyTrashed()->findOrFail($id);
        
        /** Start transaction */
        DB::beginTransaction();
                
            /** Restore item */
            $item->restore();

        /** End transaction */
        DB::commit();

        return response()->json([
            'message' => "You have successfully restored {$item->course}",
        ]);
    }
}

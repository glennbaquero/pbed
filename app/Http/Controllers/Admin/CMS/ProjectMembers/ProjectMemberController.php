<?php

namespace App\Http\Controllers\Admin\CMS\ProjectMembers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CMS\Projects\ProjectMemberRequest;

use App\Models\CMS\Projects\Project;
use App\Models\CMS\Projects\ProjectMember;

use DB;

class ProjectMemberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectMemberRequest $request)
    {
        // $project = Project::find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Store Item */
            $item = ProjectMember::store($request);

        /** End trasaction */
        DB::commit();

        $message = 'You have successfully created ' . $item->name;

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectMemberRequest $request, $id)
    {
        $item = ProjectMember::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Store Item */
            $item = ProjectMember::store($request, null, $item);

        /** End trasaction */
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
        $item = ProjectMember::findOrFail($id);
  
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
        $item = ProjectMember::onlyTrashed()->findOrFail($id);
        
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

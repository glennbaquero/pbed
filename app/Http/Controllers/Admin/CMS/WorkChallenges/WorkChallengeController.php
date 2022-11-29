<?php

namespace App\Http\Controllers\Admin\CMS\WorkChallenges;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CMS\Works\WorkChallengeRequest;

use App\Models\CMS\Works\Work;
use App\Models\CMS\Works\WorkChallenge;

use DB;

class WorkChallengeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkChallengeRequest $request, $id)
    {
        $work = Work::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Store Item */
            $item = WorkChallenge::store($request, $work);

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
    public function update(WorkChallengeRequest $request, $id)
    {

        $item = WorkChallenge::withTrashed()->find($id);

        /** Start transaction */
        DB::beginTransaction();

            /** Store Item */
            $item = WorkChallenge::store($request, null, $item);

        /** End trasaction */
        DB::commit();

        $message = 'You have successfully created ' . $item->name;

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
        $item = WorkChallenge::findOrFail($id);
  
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
        $item = WorkChallenge::onlyTrashed()->findOrFail($id);
        
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

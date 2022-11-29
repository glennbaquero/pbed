<?php

namespace App\Http\Controllers\Web\User\RequestInformation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CIS\ContactInformations\RequestInformation;
use App\Models\CIS\ContactInformations\ContactInformation;

use DB;

class RequestInformationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

        $item = ContactInformation::withTrashed()->findOrFail($request->contact_information_id);
        $has_no_access = $item->accesses()->whereIn('id', $user_level_ids)->get()->isEmpty();

        $request['type'] = $has_no_access ? 'REQUEST INFORMATION' : 'REQUEST TO EDIT';

        /** Start transaction */
        DB::beginTransaction();

            /** Store project */
            $item = RequestInformation::store($request);

        /** End transaction */
        DB::commit();

        $message = 'You have successfully requested the contact record';

        return response()->json([
            'message' => $message,
            // 'redirect' => $item->contact_information->renderShowUserUrl(),
        ]);
    }
}

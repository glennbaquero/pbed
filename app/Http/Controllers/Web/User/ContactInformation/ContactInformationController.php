<?php

namespace App\Http\Controllers\Web\User\ContactInformation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ContactInformations\ContactInformation;

use App\Exports\Exports\CIS\ContactInformationExport;

use DB;
use Excel;
use File;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_level_ids = [];
        $accesses = auth()->guard('web')->user()->classifications;

        foreach($accesses as $access) {
            foreach ($access->accesses as $user_access) {
                array_push($user_level_ids, $user_access->id);
            }
        }

        $categories = ContactCategory::all();

        // $categories = ContactCategory::whereHas('contact_informations', function($query) use($user_level_ids) {
        //     $query->whereHas('accesses', function($access) use ($user_level_ids) {
        //         $access->whereIn('id', $user_level_ids);
        //     });
        // })->get();
        return view('web.user.contact-information.index', [
            'categories' => $categories
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
        $item = ContactInformation::withTrashed()->find($id);

        return view('web.user.contact-information.show', [
            'item' => $item
        ]);
    }

    public function export(Request $request) 
    {
        $controller = new ContactInformationFetchController;
        $category = ContactCategory::find($request->category);

        $request = $request->merge(['nopagination' => 1]);
        $data = [];
        $data = $controller->fetch($request);
        
        $message = 'Exporting data, please wait...';

        if (!$data) {
            throw ValidationException::withMessages([
                'items' => 'No contacts found.',
            ]);
        }

        if (!$request->ajax()) {
            return Excel::download(new ContactInformationExport($data->original['items']), $category->name.'.xls');
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
            ]);
        }
    }
}

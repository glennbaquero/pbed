<?php

namespace App\Http\Controllers\Admin\CIS\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use App\Exports\Exports\CIS\ContactInformationExport;

use App\Models\CIS\ContactCategories\ContactCategory;
use App\Models\CIS\ContactInformations\ContactInformation;

use App\Http\Controllers\Admin\CIS\ContactInformations\ContactInformationFetchController;

use Excel;

class ReportController extends Controller
{
    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\Admin\CIS\Reports\ReportIndexMiddleware', 
            ['only' => ['index']]
        );
        $this->middleware('App\Http\Middleware\Admin\CIS\Reports\ReportExportMiddleware', 
            ['only' => ['export']]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ContactCategory::all();
        return view('admin.cis.reports.index', [
            'categories' => $categories
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
                'items' => 'No sample items found.',
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

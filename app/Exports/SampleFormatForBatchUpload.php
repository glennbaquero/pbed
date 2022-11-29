<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SampleFormatForBatchUpload implements FromView, ShouldAutoSize
{
    protected $category;
    protected $definite_fields;

    public function __construct($category, $definite_fields)
    {
        $this->category = $category;
        $this->definite_fields = $definite_fields;
    }


    public function view(): View
    {
        return view('admin.cis.contact-informations.sample-format', [
            'category' => $this->category,
            'definite_fields' => $this->definite_fields
        ]);
    }

    // public function title(): string
    // {
    //     return 'Per Field Data';
    // }
}

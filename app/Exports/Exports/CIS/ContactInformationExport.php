<?php

namespace App\Exports\Exports\CIS;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactInformationExport implements FromView, ShouldAutoSize
{
	protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function view(): View
    {
        return view('admin.cis.reports.export', [
            'items' => $this->items
        ]);
    }
}

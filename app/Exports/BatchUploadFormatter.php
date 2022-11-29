<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class BatchUploadFormatter implements WithMultipleSheets
{
	use Exportable;

	protected $category;
	protected $definite_fields;

	public function __construct($category, $definite_fields)
	{
	    $this->category = $category;
	    $this->definite_fields = $definite_fields;
	}
    
    public function sheets(): array
    {
        $sheets = [];

        for ($i = 1; $i <= 2; $i++) { 
	        $sheets[] = new SampleFormatForBatchUpload($this->category, $this->definite_fields, $i);
        }
        // foreach ($this->logs as $key => $value) {
        //     $name = $value['first_name'];
        // }

        return $sheets;
    }
}

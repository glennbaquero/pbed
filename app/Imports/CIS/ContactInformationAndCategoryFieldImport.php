<?php

namespace App\Imports\CIS;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Models\ContactInformations\ContactInformation;

class ContactInformationAndCategoryFieldImport implements WithMultipleSheets
{
	protected $category;

	public function __construct($request)
	{
		$this->category = $request->category;
	}

    public function sheets(): array
    {
        return [
            'Sheet2' => new ContactInformationImport($this->category),
            // 'Contact Category Form Field' => new ContactCategoryImport($this->category),
        ];
    }
}

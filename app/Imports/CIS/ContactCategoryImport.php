<?php

namespace App\Imports\CIS;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use App\Models\CIS\ContactCategories\ContactCategoryField;

class ContactCategoryImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
	protected $category;
	
	public function __construct($category)
	{
		$this->category = $category;
	}

    /**
     * The collection method will receive a collection of rows. A row is an array filled with the cell values.
     * @param  Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
    	foreach ($rows as $key => $row) {
    		ContactCategoryField::create([
    			'contact_category_id' => $this->category,
                'name' => $row['name'],
    			'name_field' => str_replace(' ', '', $row['name']),
    			'hidden' => $row['hidden']
    		]);
    	}
    }

    /**
     * The most ideal situation (regarding time and memory consumption) you will find when combining batch inserts and chunk reading.
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * Importing a large file can have a huge impact on the memory usage, as the library will try to load the entire sheet into memory.
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}

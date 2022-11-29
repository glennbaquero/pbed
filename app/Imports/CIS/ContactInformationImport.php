<?php

namespace App\Imports\CIS;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use App\Models\CIS\ContactInformations\ContactInformation;
use App\Models\CIS\ContactInformations\ContactInformationField;
use App\Models\CIS\DefiniteFields\DefiniteField;
use App\Models\CIS\ConfidentialityCategories\ConfidentialityCategory;

class ContactInformationImport implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    protected $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * The collection method will receive a collection of rows. A row is an array filled with the cell values.
     * @param  Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        $confidentiality_category_ids = [];
        foreach ($rows as $rowKey => $row) {
            if($rowKey >= 1) {

                $info = ContactInformation::create([
                    'category_id' => $this->request->category,
                    'notes' => $row['notes']
                ]);

                foreach(explode(",", $row['confidentiality_category']) as $confi_category) {
                    $conf_cat = ConfidentialityCategory::firstOrCreate(['name' => $confi_category]);
                    array_push($confidentiality_category_ids, $conf_cat->id);
                }

                $info->accesses()->sync($confidentiality_category_ids);

                foreach ($row as $key => $value) {
                    
                    if($key != 'notes' || $key != 'Notes' && $key != 'Confidentiality Category' || $key != 'confidentiality category' || $key != 'confidentiality_category') {
                        if($row[$key]) {
                            $first_row = explode('-', $rows[0][$key]);
                            $info_field = ContactInformationField::create([
                                'contact_information_id' => $info->id,
                                'category_id' => $this->request->category,
                                'value' => $row[$key],
                                'name' => ucfirst(str_replace('_',' ',$key)),
                                'name_field' => $key,
                                'contact_category_field_id' => isset($first_row[2]) ? ($first_row[2] == 1 ? null : $first_row[0]) : null,
                                'definite_field_id' => isset($first_row[2]) ? ($first_row[2] == 1 ? $first_row[0] : null) : null,
                                'is_definite_fields' => isset($first_row[2]) ? $first_row[2] : false,
                            ]);

                            if($info_field->name == 'Notes' || $info_field->name == 'notes') {
                                $info_field->forceDelete();
                            }
                        } 
                    }
                }
            }
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

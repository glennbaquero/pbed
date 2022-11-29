<?php

use Illuminate\Database\Seeder;

use App\Models\CIS\ContactCategories\ContactCategoryField;

class ContactCategoryFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/ContactCategoryFields.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new ContactCategoryField(); 
                    $item->contact_category_id = $data[0]; 
                    $item->name = $data[1]; 
                    $item->name_field = str_replace(' ','',$data[1]);
                    $item->hidden = $data[2]; 
                    $item->required = $data[3]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

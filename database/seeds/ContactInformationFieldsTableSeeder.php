<?php

use Illuminate\Database\Seeder;

use App\Models\CIS\ContactInformations\ContactInformationField;

class ContactInformationFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/ContactInformationFields.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new ContactInformationField(); 
                    $item->contact_information_id = $data[0]; 
                    $item->category_id = $data[1]; 
                    $item->name = $data[2]; 
                    $item->name_field = $data[3];
                    $item->value = $data[4]; 
                    $item->is_hidden = $data[5]; 
                    $item->required = $data[6]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Careers\Career;

class CareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Careers.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[2]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Career(); 
                    $item->reference_no = $data[0]; 
                    $item->type = $data[1]; 
                    $item->name = $data[2]; 
                    $item->position = $data[3]; 
                    $item->description = $data[4]; 
                    $item->job_expiry = $data[5]; 
                    $item->downloadable_file = $data[6]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

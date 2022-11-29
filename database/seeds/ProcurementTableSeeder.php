<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Careers\Procurement;

class ProcurementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Procurement.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Procurement(); 
                    $item->type = $data[0]; 
                    $item->cfp_no = $data[1]; 
                    $item->title = $data[2]; 
                    $item->description = $data[3]; 
                    $item->file_path = $data[4]; 
                    $item->downloadable = $data[5]; 
                    $item->deadline = $data[6]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Organizations\Adviser;

class AdvisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Advisers.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Adviser(); 
                    $item->prefix = $data[0]; 
                    $item->name = $data[1]; 
                    $item->main_position = $data[2]; 
                    $item->position = $data[3]; 
                    $item->company = $data[4]; 
                    $item->image_path = $data[5]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

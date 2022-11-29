<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Organizations\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Members.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[2]); // Traces seeded rows in terminal 

                    // Seed model with csv data
                    $item = new Member(); 
                    $item->type = $data[0]; 
                    $item->prefix = $data[1]; 
                    $item->name = $data[2]; 
                    $item->image_path = $data[3]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

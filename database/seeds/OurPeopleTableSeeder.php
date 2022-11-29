<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Organizations\OurPeople;

class OurPeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/OurPeople.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[0]); // Traces seeded rows in terminal 

                    // Seed model with csv data
                    $item = new OurPeople(); 
                    $item->name = $data[0]; 
                    $item->position = $data[1]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

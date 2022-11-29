<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Projects\Milestone;

class MilestonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Milestones.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('Seeding record ' . $row . ' ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Milestone(); 
                    $item->project_id = $data[0]; 
                    $item->name = $data[1]; 
                    $item->description = $data[2]; 
                    $item->image_path = $data[3]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

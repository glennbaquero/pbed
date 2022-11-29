<?php

use Illuminate\Database\Seeder;

class InformationAccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/InformationAccesses.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[0]. ' ' . $data[1]); // Traces seeded rows in terminal
                    
                    // Seed model with csv data
                    DB::table('information_accesses')->insert([
                        'contact_information_id' => $data[0],
                        'confidentiality_category_id' => $data[1]
                    ]);
                }
                $row++;
            }
            fclose($handle);
        }

    }
}

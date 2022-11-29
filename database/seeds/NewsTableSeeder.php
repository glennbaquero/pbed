<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\News\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/News.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[0]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new News(); 
                    $item->name = $data[0]; 
                    $item->author = $data[1]; 
                    $item->content = $data[2]; 
                    $item->image_path = $data[3]; 
                    $item->featured = $data[4]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

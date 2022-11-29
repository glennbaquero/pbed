<?php

use Illuminate\Database\Seeder;

use App\Models\CMS\Blogs\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if(($handle = fopen('database/csv/Blogs.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing row ' . $row . ' ' . $data[0]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Blog(); 
                    $item->name = $data[0]; 
                    $item->author = $data[1]; 
                    $item->content = $data[2]; 
                    $item->featured = $data[3]; 
                    $item->for_youthworks = $data[4]; 
                    $item->image_path = $data[5]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

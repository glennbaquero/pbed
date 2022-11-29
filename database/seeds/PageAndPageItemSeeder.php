<?php

use Illuminate\Database\Seeder;

use App\Models\Pages\Page;
use App\Models\Pages\PageItem;

class PageAndPageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runPageSeeder();
        $this->runPageItemSeeder();
    }

    public function runPageSeeder() 
    {
    	Page::truncate();
    	$row = 0;
        if(($handle = fopen('database/csv/Pages.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing in Page Model ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new Page(); 
                    $item->id = $data[0]; 
                    $item->name = $data[1]; 
                    $item->slug = $data[2]; 
                    $item->created_at = $data[3]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function runPageItemSeeder() 
    {
    	PageItem::truncate();
    	$row = 0;
        if(($handle = fopen('database/csv/PageItems.csv', "r")) !== FALSE){ // Check if CSV file exists
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Parse data inside the file
                if ($row > 0) { // row check

                    $this->command->info('writing Page Item Model ' . $data[1]); // Traces seeded rows in terminal

                    // Seed model with csv data
                    $item = new PageItem(); 
                    $item->page_id = $data[0]; 
                    $item->name = $data[1]; 
                    $item->slug = $data[2]; 
                    $item->content = $data[3]; 
                    $item->type = $data[4]; 
                    $item->created_at = $data[5]; 
                    $item->updated_at = $data[6]; 
                    $item->save();
                }
                $row++;
            }
            fclose($handle);
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SearchableRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tnt:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Refresh all object's searchable array value";

    protected $models = [
        'App\Models\ActivityLogs\ActivityLog',
        'App\Models\Samples\SampleItem',
        'App\Models\Articles\Article',
        'App\Models\Users\Admin',
        'App\Models\Users\User',
        'App\Models\Pages\Page',
        'App\Models\Pages\PageItem',
        'App\Models\Roles\Role',
        'App\Models\Roles\Role',
        'App\Models\CIS\ConfidentialityCategories\ConfidentialityCategory',
        'App\Models\CIS\ContactCategories\ContactCategory',
        'App\Models\CIS\ContactCategories\ContactCategoryField',
        'App\Models\CIS\ContactInformations\ContactInformation',
        'App\Models\CIS\ContactInformations\ContactInformationField',
        'App\Models\CIS\ContactInformations\RequestInformation',
        'App\Models\CIS\UserClassifications\UserClassification',
        'App\Models\CMS\AreasOfWork\Advocacy',
        'App\Models\CMS\AreasOfWork\FrameFour'
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(PHP_EOL . "Refreshing searchable array values" . PHP_EOL);

        /* Loop through each php files */
        foreach ($this->models as $key => $model) {

            $this->info('Refreshing ' . $model);

            $model::get()->searchable();
            
        }

        $this->info(PHP_EOL . "Searchable array values successfully refreshed!" . PHP_EOL);        
    }
}

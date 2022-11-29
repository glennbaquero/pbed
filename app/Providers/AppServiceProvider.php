<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

use App\Models\Pages\Page;

use Auth;
use Carbon\Carbon;

use App\Helpers\AuthHelper;
use App\Helpers\EnvHelper;
use App\Helpers\GlobalChecker;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        if (config('web.force_https')) {
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $data = Page::where('slug', 'footer')->firstOrFail()->getData()['pageItems'];

            $home = $this->getPageData('home');
            $all_pages = Page::where('slug', 'all_pages')->firstOrFail()->getData()['pageItems'];

            $header['home'] = Page::where('slug', 'home')->first()->name;
            $header['blogs'] = Page::where('slug', 'blogs')->first()->name;
            $header['workforce_development'] = Page::where('slug', 'workforce_development')->first()->name;
            $header['teaching_and_learning'] = Page::where('slug', 'teaching_and_learning')->first()->name;
            $header['areas_of_work'] = Page::where('slug', 'areas_of_work')->first()->name;
            $header['organizations'] = Page::where('slug', 'organizations')->first()->name;
            $header['projects'] = Page::where('slug', 'projects')->first()->name;
            $header['youth_works_ph'] = Page::where('slug', 'youth_works_ph')->first()->name;
            $header['news'] = Page::where('slug', 'news')->first()->name;
            $header['careers'] = Page::where('slug', 'careers')->first()->name;
            $header['contact_us'] = Page::where('slug', 'contact_us')->first()->name;
            $header['privacy_policy'] = Page::where('slug', 'privacy_policy')->first()->name;

            View::share('self', new AuthHelper);
            View::share('item', $data);
            View::share('home', $home);
            View::share('all_pages', $all_pages);
            View::share('header', $header);
            
            View::share('checker', new GlobalChecker);
            View::share('env', new EnvHelper);
        });
    }

    /* Get Page Data */
    protected function getPageData($slug) {
       $item = Page::where('slug', $slug)->firstOrFail();
       return $item->getData();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

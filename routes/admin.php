<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::namespace('Auth')->middleware('guest:admin')->group(function() {

    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');

    Route::get('reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('reset-password/change', 'ResetPasswordController@reset')->name('password.change');

    Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

});

Route::middleware('auth:admin')->group(function() {

    Route::namespace('Auth')->group(function() {

        Route::get('logout', 'LoginController@logout')->name('logout');

    });

    Route::get('', 'DashboardController@index')->name('dashboard');

    /**
     * @Count Fetch Controller
     */
    Route::post('count/notifications', 'CountFetchController@fetchNotificationCount')->name('counts.fetch.notifications');
    Route::post('count/sample-items', 'CountFetchController@fetchSampleItemCount')->name('counts.fetch.sample-items.pending');
    
    /**
     * @Analytics
     */
    Route::namespace('Analytics')->group(function() {

        Route::post('analytics/dashboard', 'DashboardAnalyticsController@fetch')->name('analytics.fetch.user');
        Route::post('analytics/dashboard?admin=1', 'DashboardAnalyticsController@fetch')->name('analytics.fetch.admin');

    });

    Route::namespace('Profiles')->group(function() {

        /**
         * @Admin Profiles
         */
        Route::get('profile', 'ProfileController@show')->name('profiles.show');
        Route::post('profile/update', 'ProfileController@update')->name('profiles.update');
        Route::post('profile/change-password', 'ProfileController@changePassword')->name('profiles.change-password');

        Route::post('profile/fetch', 'ProfileController@fetch')->name('profiles.fetch');

    });

    /**
     * @AdminUsers
     */
    Route::namespace('AdminUsers')->group(function() {

        /**
         * @AdminUsers
         */
        Route::get('admin-users', 'AdminUserController@index')->name('admin-users.index');
        Route::get('admin-users/create', 'AdminUserController@create')->name('admin-users.create');
        Route::post('admin-users/store', 'AdminUserController@store')->name('admin-users.store');
        Route::get('admin-users/show/{id}', 'AdminUserController@show')->name('admin-users.show');
        Route::post('admin-users/update/{id}', 'AdminUserController@update')->name('admin-users.update');
        Route::post('admin-users/{id}/archive', 'AdminUserController@archive')->name('admin-users.archive');
        Route::post('admin-users/{id}/restore', 'AdminUserController@restore')->name('admin-users.restore');

        Route::post('admin-users/fetch', 'AdminUserFetchController@fetch')->name('admin-users.fetch');
        Route::post('admin-users/fetch?archived=1', 'AdminUserFetchController@fetch')->name('admin-users.fetch-archive');
        Route::post('admin-users/fetch-item/{id?}', 'AdminUserFetchController@fetchView')->name('admin-users.fetch-item');
        Route::post('admin-users/fetch-pagination/{id}', 'AdminUserFetchController@fetchPagePagination')->name('admin-users.fetch-pagination');

    });

    /**
     * CMS Pages
     */
    Route::namespace('Pages')->group(function() {

        Route::get('pages', 'PageController@index')->name('pages.index');
        Route::get('pages/create', 'PageController@create')->name('pages.create');
        Route::post('pages/store', 'PageController@store')->name('pages.store');
        Route::get('pages/show/{id}', 'PageController@show')->name('pages.show');
        Route::post('pages/update/{id}', 'PageController@update')->name('pages.update');
        Route::post('pages/{id}/archive', 'PageController@archive')->name('pages.archive');
        Route::post('pages/{id}/restore', 'PageController@restore')->name('pages.restore');

        Route::post('pages/fetch', 'PageFetchController@fetch')->name('pages.fetch');
        Route::post('pages/fetch?archived=1', 'PageFetchController@fetch')->name('pages.fetch-archive');
        Route::post('pages/fetch-item/{id?}', 'PageFetchController@fetchView')->name('pages.fetch-item');
        Route::post('pages/fetch-pagination/{id}', 'PageFetchController@fetchPagePagination')->name('pages.fetch-pagination');

        Route::get('page-items', 'PageItemController@index')->name('page-items.index');
        Route::get('page-items/create', 'PageItemController@create')->name('page-items.create');
        Route::post('page-items/store', 'PageItemController@store')->name('page-items.store');
        Route::get('page-items/show/{id}', 'PageItemController@show')->name('page-items.show');
        Route::post('page-items/update/{id}', 'PageItemController@update')->name('page-items.update');
        Route::post('page-items/{id}/archive', 'PageItemController@archive')->name('page-items.archive');
        Route::post('page-items/{id}/restore', 'PageItemController@restore')->name('page-items.restore');

        Route::post('page-items/fetch', 'PageItemFetchController@fetch')->name('page-items.fetch');
        Route::post('page-items/fetch?archived=1', 'PageItemFetchController@fetch')->name('page-items.fetch-archive');
        Route::post('page-items/fetch?page_id={id}', 'PageItemFetchController@fetch')->name('page-items.fetch-page-items');
        Route::post('page-items/fetch-item/{id?}', 'PageItemFetchController@fetchView')->name('page-items.fetch-item');
        Route::post('page-items/fetch-pagination/{id}', 'PageItemFetchController@fetchPagePagination')->name('page-items.fetch-pagination');

    });


    /*
    |--------------------------------------------------------------------------
    | @Routes for ADMIN - CMS
    |--------------------------------------------------------------------------
    */
    Route::namespace('CMS')->group(function() {

        /*
        |--------------------------------------------------------------------------
        | @Routes for Areas of Works
        |--------------------------------------------------------------------------
        */
        Route::namespace('Works')->group(function() {       
            Route::get('works', 'WorkController@index')->name('works.index');
            Route::get('works/create', 'WorkController@create')->name('works.create');
            Route::post('works/store', 'WorkController@store')->name('works.store');
            Route::get('works/{id}/show', 'WorkController@show')->name('works.show');
            Route::post('works/{id}/update', 'WorkController@update')->name('works.update');
            Route::post('works/{id}/archive', 'WorkController@archive')->name('works.archive');
            Route::post('works/{id}/restore', 'WorkController@restore')->name('works.restore');        

            Route::post('works/fetch', 'WorkFetchController@fetch')->name('works.fetch');
            Route::post('works/fetch?archived=1', 'WorkFetchController@fetch')->name('works.fetch.archive');
            Route::post('works/fetch-item/{id?}', 'WorkFetchController@fetchItem')->name('works.fetch.item');
            Route::post('works/fetch-pagination/{id}', 'WorkFetchController@fetchPagePagination')->name('works.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Home First Frame
        |--------------------------------------------------------------------------
        */
        Route::namespace('HomeFirstFrames')->group(function() {       
            Route::get('first-frame', 'FirstFrameController@index')->name('home-first-frame.index');
            Route::get('first-frame/create', 'FirstFrameController@create')->name('home-first-frame.create');
            Route::post('first-frame/store', 'FirstFrameController@store')->name('home-first-frame.store');
            Route::get('first-frame/{id}/show', 'FirstFrameController@show')->name('home-first-frame.show');
            Route::post('first-frame/{id}/update', 'FirstFrameController@update')->name('home-first-frame.update');
            Route::post('first-frame/{id}/archive', 'FirstFrameController@archive')->name('home-first-frame.archive');
            Route::post('first-frame/{id}/restore', 'FirstFrameController@restore')->name('home-first-frame.restore');        

            Route::post('first-frame/fetch', 'FirstFrameFetchController@fetch')->name('home-first-frame.fetch');
            Route::post('first-frame/fetch?archived=1', 'FirstFrameFetchController@fetch')->name('home-first-frame.fetch.archive');
            Route::post('first-frame/fetch-item/{id?}', 'FirstFrameFetchController@fetchItem')->name('home-first-frame.fetch-item');
            Route::post('first-frame/fetch-pagination/{id}', 'FirstFrameFetchController@fetchPagePagination')->name('home-first-frame.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Faqs
        |--------------------------------------------------------------------------
        */
        Route::namespace('Faqs')->group(function() {       
            Route::get('faqs', 'FaqController@index')->name('faqs.index');
            Route::get('faqs/create', 'FaqController@create')->name('faqs.create');
            Route::post('faqs/store', 'FaqController@store')->name('faqs.store');
            Route::get('faqs/{id}/show', 'FaqController@show')->name('faqs.show');
            Route::post('faqs/{id}/update', 'FaqController@update')->name('faqs.update');
            Route::post('faqs/{id}/archive', 'FaqController@archive')->name('faqs.archive');
            Route::post('faqs/{id}/restore', 'FaqController@restore')->name('faqs.restore');        

            Route::post('faqs/fetch', 'FaqFetchController@fetch')->name('faqs.fetch');
            Route::post('faqs/fetch?archived=1', 'FaqFetchController@fetch')->name('faqs.fetch.archive');
            Route::post('faqs/fetch-item/{id?}', 'FaqFetchController@fetchItem')->name('faqs.fetch-item');
            Route::post('faqs/fetch-pagination/{id}', 'FaqFetchController@fetchPagePagination')->name('faqs.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Challenges
        |--------------------------------------------------------------------------
        */
        Route::namespace('Challenges')->group(function() {       
            Route::get('challenges', 'ChallengeController@index')->name('challenges.index');
            Route::get('challenges/create', 'ChallengeController@create')->name('challenges.create');
            Route::post('challenges/store', 'ChallengeController@store')->name('challenges.store');
            Route::get('challenges/{id}/show', 'ChallengeController@show')->name('challenges.show');
            Route::post('challenges/{id}/update', 'ChallengeController@update')->name('challenges.update');
            Route::post('challenges/{id}/archive', 'ChallengeController@archive')->name('challenges.archive');
            Route::post('challenges/{id}/restore', 'ChallengeController@restore')->name('challenges.restore');        

            Route::post('challenges/fetch', 'ChallengeFetchController@fetch')->name('challenges.fetch');
            Route::post('challenges/fetch?archived=1', 'ChallengeFetchController@fetch')->name('challenges.fetch.archive');
            Route::post('challenges/fetch-item/{id?}', 'ChallengeFetchController@fetchItem')->name('challenges.fetch-item');
            Route::post('challenges/fetch-pagination/{id}', 'ChallengeFetchController@fetchPagePagination')->name('challenges.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for FrameFour
        |--------------------------------------------------------------------------
        */
        Route::namespace('FrameFour')->group(function() {       
            Route::get('frame-four', 'FrameFourController@index')->name('frame-four.index');
            Route::get('frame-four/create', 'FrameFourController@create')->name('frame-four.create');
            Route::post('frame-four/store', 'FrameFourController@store')->name('frame-four.store');
            Route::get('frame-four/{id}/show', 'FrameFourController@show')->name('frame-four.show');
            Route::post('frame-four/{id}/update', 'FrameFourController@update')->name('frame-four.update');
            Route::post('frame-four/{id}/archive', 'FrameFourController@archive')->name('frame-four.archive');
            Route::post('frame-four/{id}/restore', 'FrameFourController@restore')->name('frame-four.restore');        

            Route::post('frame-four/fetch', 'FrameFourFetchController@fetch')->name('frame-four.fetch');
            Route::post('frame-four/fetch?archived=1', 'FrameFourFetchController@fetch')->name('frame-four.fetch.archive');
            Route::post('frame-four/fetch-item/{id?}', 'FrameFourFetchController@fetchItem')->name('frame-four.fetch-item');
            Route::post('frame-four/fetch-pagination/{id}', 'FrameFourFetchController@fetchPagePagination')->name('frame-four.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for OurSolutions
        |--------------------------------------------------------------------------
        */
        Route::namespace('OurSolutions')->group(function() {       
            Route::get('our-solutions', 'OurSolutionController@index')->name('solutions.index');
            Route::get('our-solutions/create', 'OurSolutionController@create')->name('solutions.create');
            Route::post('our-solutions/store', 'OurSolutionController@store')->name('solutions.store');
            Route::get('our-solutions/{id}/show', 'OurSolutionController@show')->name('solutions.show');
            Route::post('our-solutions/{id}/update', 'OurSolutionController@update')->name('solutions.update');
            Route::post('our-solutions/{id}/archive', 'OurSolutionController@archive')->name('solutions.archive');
            Route::post('our-solutions/{id}/restore', 'OurSolutionController@restore')->name('solutions.restore');        

            Route::post('our-solutions/fetch', 'OurSolutionFetchController@fetch')->name('solutions.fetch');
            Route::post('our-solutions/fetch?archived=1', 'OurSolutionFetchController@fetch')->name('solutions.fetch.archive');
            Route::post('our-solutions/fetch-item/{id?}', 'OurSolutionFetchController@fetchItem')->name('solutions.fetch-item');
            Route::post('our-solutions/fetch-pagination/{id}', 'OurSolutionFetchController@fetchPagePagination')->name('solutions.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Project Priority Area
        |--------------------------------------------------------------------------
        */
        Route::namespace('ProjectPriorityAreas')->group(function() {       
            Route::get('project-priority-areas', 'ProjectPriorityAreaController@index')->name('project-priority-areas.index');
            Route::get('project-priority-areas/create', 'ProjectPriorityAreaController@create')->name('project-priority-areas.create');
            Route::post('project-priority-areas/store', 'ProjectPriorityAreaController@store')->name('project-priority-areas.store');
            Route::get('project-priority-areas/{id}/show', 'ProjectPriorityAreaController@show')->name('project-priority-areas.show');
            Route::post('project-priority-areas/{id}/update', 'ProjectPriorityAreaController@update')->name('project-priority-areas.update');
            Route::post('project-priority-areas/{id}/archive', 'ProjectPriorityAreaController@archive')->name('project-priority-areas.archive');
            Route::post('project-priority-areas/{id}/restore', 'ProjectPriorityAreaController@restore')->name('project-priority-areas.restore');        

            Route::post('project-priority-areas/fetch', 'ProjectPriorityAreaFetchController@fetch')->name('project-priority-areas.fetch');
            Route::post('project-priority-areas/fetch?archived=1', 'ProjectPriorityAreaFetchController@fetch')->name('project-priority-areas.fetch.archive');
            Route::post('project-priority-areas/fetch-item/{id?}', 'ProjectPriorityAreaFetchController@fetchItem')->name('project-priority-areas.fetch-item');
            Route::post('project-priority-areas/fetch-pagination/{id}', 'ProjectPriorityAreaFetchController@fetchPagePagination')->name('project-priority-areas.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for GrowthSectors
        |--------------------------------------------------------------------------
        */
        Route::namespace('GrowthSectors')->group(function() {       
            Route::get('growth-sectors', 'GrowthSectorController@index')->name('growth-sectors.index');
            Route::get('growth-sectors/create', 'GrowthSectorController@create')->name('growth-sectors.create');
            Route::post('growth-sectors/store', 'GrowthSectorController@store')->name('growth-sectors.store');
            Route::get('growth-sectors/{id}/show', 'GrowthSectorController@show')->name('growth-sectors.show');
            Route::post('growth-sectors/{id}/update', 'GrowthSectorController@update')->name('growth-sectors.update');
            Route::post('growth-sectors/{id}/archive', 'GrowthSectorController@archive')->name('growth-sectors.archive');
            Route::post('growth-sectors/{id}/restore', 'GrowthSectorController@restore')->name('project-priority-areas.restore');        

            // Route::post('project-priority-areas/fetch-pagination/{id}', 'ProjectPriorityAreaFetchController@fetchPagePagination')->name('growth-sectors.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for YouthWorkPH First Frame
        |--------------------------------------------------------------------------
        */
        Route::namespace('YouthWorksFirstFrame')->group(function() {       
            Route::get('youthwork-first-frame', 'FirstFrameController@index')->name('youthwork-first-frame.index');
            Route::get('youthwork-first-frame/create', 'FirstFrameController@create')->name('youthwork-first-frame.create');
            Route::post('youthwork-first-frame/store', 'FirstFrameController@store')->name('youthwork-first-frame.store');
            Route::get('youthwork-first-frame/{id}/show', 'FirstFrameController@show')->name('youthwork-first-frame.show');
            Route::post('youthwork-first-frame/{id}/update', 'FirstFrameController@update')->name('youthwork-first-frame.update');
            Route::post('youthwork-first-frame/{id}/archive', 'FirstFrameController@archive')->name('youthwork-first-frame.archive');
            Route::post('youthwork-first-frame/{id}/restore', 'FirstFrameController@restore')->name('youthwork-first-frame.restore');        

            Route::post('youthwork-first-frame/fetch', 'FirstFrameFetchController@fetch')->name('youthwork-first-frame.fetch');
            Route::post('youthwork-first-frame/fetch?archived=1', 'FirstFrameFetchController@fetch')->name('youthwork-first-frame.fetch.archive');
            Route::post('youthwork-first-frame/fetch-item/{id?}', 'FirstFrameFetchController@fetchItem')->name('youthwork-first-frame.fetch-item');
            Route::post('youthwork-first-frame/fetch-pagination/{id}', 'FirstFrameFetchController@fetchPagePagination')->name('youthwork-first-frame.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Home Latest Study
        |--------------------------------------------------------------------------
        */
        Route::namespace('HomeLatestStudies')->group(function() {       
            Route::get('latest-study', 'LatestStudyController@index')->name('home-latest-study.index');
            Route::get('latest-study/create', 'LatestStudyController@create')->name('home-latest-study.create');
            Route::post('latest-study/store', 'LatestStudyController@store')->name('home-latest-study.store');
            Route::get('latest-study/{id}/show', 'LatestStudyController@show')->name('home-latest-study.show');
            Route::post('latest-study/{id}/update', 'LatestStudyController@update')->name('home-latest-study.update');
            Route::post('latest-study/{id}/archive', 'LatestStudyController@archive')->name('home-latest-study.archive');
            Route::post('latest-study/{id}/restore', 'LatestStudyController@restore')->name('home-latest-study.restore');        

            Route::post('latest-study/fetch', 'LatestStudyFetchController@fetch')->name('home-latest-study.fetch');
            Route::post('latest-study/fetch?archived=1', 'LatestStudyFetchController@fetch')->name('home-latest-study.fetch.archive');
            Route::post('latest-study/fetch-item/{id?}', 'LatestStudyFetchController@fetchItem')->name('home-latest-study.fetch-item');
            Route::post('latest-study/fetch-pagination/{id}', 'LatestStudyFetchController@fetchPagePagination')->name('home-latest-study.fetch-pagination');
        });


        /*
        |--------------------------------------------------------------------------
        | @Routes for Home Latest Study
        |--------------------------------------------------------------------------
        */
        Route::namespace('Procurements')->group(function() {       
            Route::get('procurements', 'ProcurementController@index')->name('procurements.index');
            Route::get('procurements/create', 'ProcurementController@create')->name('procurements.create');
            Route::post('procurements/store', 'ProcurementController@store')->name('procurements.store');
            Route::get('procurements/{id}/show', 'ProcurementController@show')->name('procurements.show');
            Route::post('procurements/{id}/update', 'ProcurementController@update')->name('procurements.update');
            Route::post('procurements/{id}/archive', 'ProcurementController@archive')->name('procurements.archive');
            Route::post('procurements/{id}/restore', 'ProcurementController@restore')->name('procurements.restore');        

            Route::post('procurements/fetch', 'ProcurementFetchController@fetch')->name('procurements.fetch');
            Route::post('procurements/fetch?archived=1', 'ProcurementFetchController@fetch')->name('procurements.fetch-archive');
            Route::post('procurements/fetch-item/{id?}', 'ProcurementFetchController@fetchItem')->name('procurements.fetch-item');
            Route::post('procurements/fetch-pagination/{id}', 'ProcurementFetchController@fetchPagePagination')->name('procurements.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Home Latest Study
        |--------------------------------------------------------------------------
        */
        Route::namespace('Advocacies')->group(function() {       
            Route::get('advocacies', 'AdvocacyController@index')->name('advocacies.index');
            Route::get('advocacies/create', 'AdvocacyController@create')->name('advocacies.create');
            Route::post('advocacies/store', 'AdvocacyController@store')->name('advocacies.store');
            Route::get('advocacies/{id}/show', 'AdvocacyController@show')->name('advocacies.show');
            Route::post('advocacies/{id}/update', 'AdvocacyController@update')->name('advocacies.update');
            Route::post('advocacies/{id}/archive', 'AdvocacyController@archive')->name('advocacies.archive');
            Route::post('advocacies/{id}/restore', 'AdvocacyController@restore')->name('advocacies.restore');        

            Route::post('advocacies/fetch', 'AdvocacyFetchController@fetch')->name('advocacies.fetch');
            Route::post('advocacies/fetch?archived=1', 'AdvocacyFetchController@fetch')->name('advocacies.fetch-archive');
            Route::post('advocacies/fetch-item/{id?}', 'AdvocacyFetchController@fetchItem')->name('advocacies.fetch-item');
            Route::post('advocacies/fetch-pagination/{id}', 'AdvocacyFetchController@fetchPagePagination')->name('advocacies.fetch-pagination');
        });
        /*
        |--------------------------------------------------------------------------
        | @Routes for Work Challenge
        |--------------------------------------------------------------------------
        */

        Route::namespace('WorkChallenges')->group(function() {       
            Route::get('work-challenges', 'WorkChallengeController@index')->name('work-challenges.index');
            Route::post('work-challenges/{id}/store', 'WorkChallengeController@store')->name('work-challenges.store');
            Route::post('work-challenges/{id}/update', 'WorkChallengeController@update')->name('work-challenges.update');
            Route::post('work-challenges/{id}/archive', 'WorkChallengeController@archive')->name('work-challenges.archive');
            Route::post('work-challenges/{id}/restore', 'WorkChallengeController@restore')->name('work-challenges.restore');

            Route::post('work-challenges/fetch', 'WorkChallengeFetchController@fetch')->name('work-challenges.fetch');
            Route::post('work-challenges/fetch?work_id={id}', 'WorkChallengeFetchController@fetch')->name('work-challenges.fetch.by.work');
            Route::post('work-challenges/fetch?archived=1', 'WorkChallengeFetchController@fetch')->name('work-challenges.fetch.archive');
            Route::post('work-challenges/fetch-item/{id?}', 'WorkChallengeFetchController@fetchItem')->name('work-challenges.fetch.item');
        });


        /*
        |--------------------------------------------------------------------------
        | @Routes for Work Solutions
        |--------------------------------------------------------------------------
        */

        Route::namespace('WorkSolutions')->group(function() {       
            Route::get('work-solutions', 'WorkSolutionController@index')->name('work-solutions.index');
            Route::post('work-solutions/{id}/store', 'WorkSolutionController@store')->name('work-solutions.store');
            Route::post('work-solutions/{id}/update', 'WorkSolutionController@update')->name('work-solutions.update');
            Route::post('work-solutions/{id}/archive', 'WorkSolutionController@archive')->name('work-solutions.archive');
            Route::post('work-solutions/{id}/restore', 'WorkSolutionController@restore')->name('work-solutions.restore');

            Route::post('work-solutions/fetch', 'WorkSolutionFetchController@fetch')->name('work-solutions.fetch');
            Route::post('work-solutions/fetch?work_id={id}', 'WorkSolutionFetchController@fetch')->name('work-solutions.fetch.by.work');
            Route::post('work-solutions/fetch?archived=1', 'WorkSolutionFetchController@fetch')->name('work-solutions.fetch.archive');
            Route::post('work-solutions/fetch-item/{id?}', 'WorkSolutionFetchController@fetchItem')->name('work-solutions.fetch.item');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Blogs
        |--------------------------------------------------------------------------
        */
        Route::namespace('Blogs')->group(function() {       
            Route::get('blogs', 'BlogController@index')->name('blogs.index');
            Route::get('blogs/create', 'BlogController@create')->name('blogs.create');
            Route::post('blogs/store', 'BlogController@store')->name('blogs.store');
            Route::get('blogs/{id}/show', 'BlogController@show')->name('blogs.show');
            Route::post('blogs/{id}/update', 'BlogController@update')->name('blogs.update');
            Route::post('blogs/{id}/archive', 'BlogController@archive')->name('blogs.archive');
            Route::post('blogs/{id}/restore', 'BlogController@restore')->name('blogs.restore');

            Route::post('blogs/fetch', 'BlogFetchController@fetch')->name('blogs.fetch');
            Route::post('blogs/fetch?archived=1', 'BlogFetchController@fetch')->name('blogs.fetch.archive');
            Route::post('blogs/fetch-item/{id?}', 'BlogFetchController@fetchItem')->name('blogs.fetch.item');
            Route::post('blogs/fetch-pagination/{id}', 'BlogFetchController@fetchPagePagination')->name('blogs.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Corporations
        |--------------------------------------------------------------------------
        */
        Route::namespace('Corporations')->group(function() {       
            Route::get('corporations', 'CorporationController@index')->name('corporations.index');
            Route::get('corporations/create', 'CorporationController@create')->name('corporations.create');
            Route::post('corporations/store', 'CorporationController@store')->name('corporations.store');
            Route::get('corporations/{id}/show', 'CorporationController@show')->name('corporations.show');
            Route::post('corporations/{id}/update', 'CorporationController@update')->name('corporations.update');
            Route::post('corporations/{id}/archive', 'CorporationController@archive')->name('corporations.archive');
            Route::post('corporations/{id}/restore', 'CorporationController@restore')->name('corporations.restore');

            Route::post('corporations/fetch', 'CorporationFetchController@fetch')->name('corporations.fetch');
            Route::post('corporations/fetch?archived=1', 'CorporationFetchController@fetch')->name('corporations.fetch.archive');
            Route::post('corporations/fetch-item/{id?}', 'CorporationFetchController@fetchItem')->name('corporations.fetch.item');
            Route::post('corporations/fetch-pagination/{id}', 'CorporationFetchController@fetchPagePagination')->name('corporations.fetch.pagination');
        });


        /*
        |--------------------------------------------------------------------------
        | @Routes for Projects
        |--------------------------------------------------------------------------
        */
        Route::namespace('Projects')->group(function() {       
            Route::get('projects', 'ProjectController@index')->name('projects.index');
            Route::get('projects/create', 'ProjectController@create')->name('projects.create');
            Route::post('projects/store', 'ProjectController@store')->name('projects.store');
            Route::get('projects/{id}/show', 'ProjectController@show')->name('projects.show');
            Route::post('projects/{id}/update', 'ProjectController@update')->name('projects.update');
            Route::post('projects/{id}/archive', 'ProjectController@archive')->name('projects.archive');
            Route::post('projects/{id}/restore', 'ProjectController@restore')->name('projects.restore');  
            Route::post('projects/{id}/remove-image', 'ProjectController@removeImage')->name('projects.remove-image');

            Route::post('projects/fetch', 'ProjectFetchController@fetch')->name('projects.fetch');
            Route::post('projects/fetch?archived=1', 'ProjectFetchController@fetch')->name('projects.fetch.archive');
            Route::post('projects/fetch-item/{id?}', 'ProjectFetchController@fetchItem')->name('projects.fetch.item');
            Route::post('projects/fetch-pagination/{id}', 'ProjectFetchController@fetchPagePagination')->name('projects.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Milestones
        |--------------------------------------------------------------------------
        */
        Route::namespace('Milestones')->group(function() {       
            Route::get('milestones', 'MilestoneController@index')->name('milestones.index');
            Route::get('milestones/create', 'MilestoneController@create')->name('milestones.create');
            Route::post('milestones/store', 'MilestoneController@store')->name('milestones.store');
            Route::get('milestones/{id}/show', 'MilestoneController@show')->name('milestones.show');
            Route::post('milestones/{id}/update', 'MilestoneController@update')->name('milestones.update');
            Route::post('milestones/{id}/archive', 'MilestoneController@archive')->name('milestones.archive');
            Route::post('milestones/{id}/restore', 'MilestoneController@restore')->name('milestones.restore');  

            Route::post('milestones/fetch', 'MilestoneFetchController@fetch')->name('milestones.fetch');
            Route::post('milestones/fetch?project_id={id}', 'MilestoneFetchController@fetch')->name('milestones.fetch.by.project');
            Route::post('milestones/fetch?archived=1', 'MilestoneFetchController@fetch')->name('milestones.fetch.archive');
            Route::post('milestones/fetch-item/{id?}', 'MilestoneFetchController@fetchItem')->name('milestones.fetch.item');
            Route::post('milestones/fetch-pagination/{id}', 'MilestoneFetchController@fetchPagePagination')->name('milestones.fetch.pagination');
        });


        /*
        |--------------------------------------------------------------------------
        | @Routes for Project Members
        |--------------------------------------------------------------------------
        */
        Route::namespace('ProjectMembers')->group(function() {       
            Route::get('project-members', 'ProjectMemberController@index')->name('project-members.index');
            Route::get('project-members/create', 'ProjectMemberController@create')->name('project-members.create');
            Route::post('project-members/store', 'ProjectMemberController@store')->name('project-members.store');
            Route::get('project-members/{id}/show', 'ProjectMemberController@show')->name('project-members.show');
            Route::post('project-members/{id}/update', 'ProjectMemberController@update')->name('project-members.update');
            Route::post('project-members/{id}/archive', 'ProjectMemberController@archive')->name('project-members.archive');
            Route::post('project-members/{id}/restore', 'ProjectMemberController@restore')->name('project-members.restore');  
            
            Route::post('project-members/fetch', 'ProjectMemberFetchController@fetch')->name('project-members.fetch');
            Route::post('project-members/fetch?project_id={id}', 'ProjectMemberFetchController@fetch')->name('project-members.fetch.by.project');
            Route::post('project-members/fetch?archived=1', 'ProjectMemberFetchController@fetch')->name('project-members.fetch.archive');
            Route::post('project-members/fetch-item/{id?}', 'ProjectMemberFetchController@fetchItem')->name('project-members.fetch.item');
            Route::post('project-members/fetch-pagination/{id}', 'ProjectMemberFetchController@fetchPagePagination')->name('project-members.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Careers
        |--------------------------------------------------------------------------
        */
        Route::namespace('Careers')->group(function() {
            Route::get('careers', 'CareerController@index')->name('careers.index');
            Route::get('careers/create', 'CareerController@create')->name('careers.create');
            Route::post('careers/store', 'CareerController@store')->name('careers.store');
            Route::get('careers/{id}/show', 'CareerController@show')->name('careers.show');
            Route::post('careers/{id}/update', 'CareerController@update')->name('careers.update');
            Route::post('careers/{id}/archive', 'CareerController@archive')->name('careers.archive');
            Route::post('careers/{id}/restore', 'CareerController@restore')->name('careers.restore');
            Route::post('careers/export', 'CareerController@export')->name('careers.export');

            Route::post('careers/fetch', 'CareerFetchController@fetch')->name('careers.fetch');
            Route::post('careers/fetch?archived=1', 'CareerFetchController@fetch')->name('careers.fetch-archive');
            Route::post('careers/fetch-item/{id?}', 'CareerFetchController@fetchView')->name('careers.fetch-item');
            Route::post('careers/fetch-pagination/{id}', 'CareerFetchController@fetchPagePagination')->name('careers.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for News
        |--------------------------------------------------------------------------
        */
        Route::namespace('News')->group(function() {
            Route::get('news', 'NewsController@index')->name('news.index');
            Route::get('news/create', 'NewsController@create')->name('news.create');
            Route::post('news/store', 'NewsController@store')->name('news.store');
            Route::get('news/{id}/show', 'NewsController@show')->name('news.show');
            Route::post('news/{id}/update', 'NewsController@update')->name('news.update');
            Route::post('news/{id}/archive', 'NewsController@archive')->name('news.archive');
            Route::post('news/{id}/restore', 'NewsController@restore')->name('news.restore');
            Route::post('news/export', 'NewsController@export')->name('news.export');

            Route::post('news/fetch', 'NewsFetchController@fetch')->name('news.fetch');
            Route::post('news/fetch?archived=1', 'NewsFetchController@fetch')->name('news.fetch-archive');
            Route::post('news/fetch-item/{id?}', 'NewsFetchController@fetchView')->name('news.fetch-item');
            Route::post('news/fetch-pagination/{id}', 'NewsFetchController@fetchPagePagination')->name('news.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for OurLeaderships
        |--------------------------------------------------------------------------
        */
        Route::namespace('OurLeaderships')->group(function() {
            Route::get('our-leaderships', 'OurLeadershipController@index')->name('our-leaderships.index');
            Route::get('our-leadership/create', 'OurLeadershipController@create')->name('our-leaderships.create');
            Route::post('our-leadership/store', 'OurLeadershipController@store')->name('our-leaderships.store');
            Route::get('our-leadership/{id}/show', 'OurLeadershipController@show')->name('our-leaderships.show');
            Route::post('our-leadership/{id}/update', 'OurLeadershipController@update')->name('our-leaderships.update');
            Route::post('our-leadership/{id}/archive', 'OurLeadershipController@archive')->name('our-leaderships.archive');
            Route::post('our-leadership/{id}/restore', 'OurLeadershipController@restore')->name('our-leaderships.restore');
            Route::post('our-leadership/reorder', 'OurLeadershipController@reOrder')->name('our-leaderships.reorder');

            Route::post('our-leaderships/fetch', 'OurLeadershipFetchController@fetch')->name('our-leaderships.fetch');
            Route::post('our-leaderships/fetch?archived=1', 'OurLeadershipFetchController@fetch')->name('our-leaderships.fetch-archive');
            Route::post('our-leaderships/fetch-item/{id?}', 'OurLeadershipFetchController@fetchView')->name('our-leaderships.fetch-item');
            Route::post('our-leaderships/fetch-pagination/{id}', 'OurLeadershipFetchController@fetchPagePagination')->name('our-leaderships.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Advisers
        |--------------------------------------------------------------------------
        */
        Route::namespace('Advisers')->group(function() {
            Route::get('advisers', 'AdviserController@index')->name('advisers.index');
            Route::get('adviser/create', 'AdviserController@create')->name('advisers.create');
            Route::post('adviser/store', 'AdviserController@store')->name('advisers.store');
            Route::get('adviser/{id}/show', 'AdviserController@show')->name('advisers.show');
            Route::post('adviser/{id}/update', 'AdviserController@update')->name('advisers.update');
            Route::post('adviser/{id}/archive', 'AdviserController@archive')->name('advisers.archive');
            Route::post('adviser/{id}/restore', 'AdviserController@restore')->name('advisers.restore');
            Route::post('adviser/reorder', 'AdviserController@reOrder')->name('advisers.reorder');

            Route::post('advisers/fetch', 'AdviserFetchController@fetch')->name('advisers.fetch');
            Route::post('advisers/fetch?archived=1', 'AdviserFetchController@fetch')->name('advisers.fetch-archive');
            Route::post('advisers/fetch-item/{id?}', 'AdviserFetchController@fetchView')->name('advisers.fetch-item');
            Route::post('advisers/fetch-pagination/{id}', 'AdviserFetchController@fetchPagePagination')->name('advisers.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Members
        |--------------------------------------------------------------------------
        */
        Route::namespace('Members')->group(function() {
            Route::get('our-members', 'MemberController@index')->name('members.index');
            Route::get('our-member/create', 'MemberController@create')->name('members.create');
            Route::post('our-member/store', 'MemberController@store')->name('members.store');
            Route::get('our-member/{id}/show', 'MemberController@show')->name('members.show');
            Route::post('our-member/{id}/update', 'MemberController@update')->name('members.update');
            Route::post('our-member/{id}/archive', 'MemberController@archive')->name('members.archive');
            Route::post('our-member/{id}/restore', 'MemberController@restore')->name('members.restore');
            
            Route::post('our-member/reorder', 'MemberController@reOrder')->name('members.reorder');

            Route::post('our-members/fetch', 'MemberFetchController@fetch')->name('members.fetch');
            Route::post('our-members/fetch?archived=1', 'MemberFetchController@fetch')->name('members.fetch-archive');
            Route::post('our-members/fetch-item/{id?}', 'MemberFetchController@fetchView')->name('members.fetch-item');
            Route::post('our-members/fetch-pagination/{id}', 'MemberFetchController@fetchPagePagination')->name('members.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for OurPeople
        |--------------------------------------------------------------------------
        */
        Route::namespace('OurPeople')->group(function() {
            Route::get('our-people', 'OurPeopleController@index')->name('our-people.index');
            Route::get('our-people/create', 'OurPeopleController@create')->name('our-people.create');
            Route::post('our-people/store', 'OurPeopleController@store')->name('our-people.store');
            Route::get('our-people/{id}/show', 'OurPeopleController@show')->name('our-people.show');
            Route::post('our-people/{id}/update', 'OurPeopleController@update')->name('our-people.update');
            Route::post('our-people/{id}/archive', 'OurPeopleController@archive')->name('our-people.archive');
            Route::post('our-people/{id}/restore', 'OurPeopleController@restore')->name('our-people.restore');

            Route::post('our-people/reorder', 'OurPeopleController@reOrder')->name('our-people.reorder');

            Route::post('our-people/fetch', 'OurPeopleFetchController@fetch')->name('our-people.fetch');
            Route::post('our-people/fetch?archived=1', 'OurPeopleFetchController@fetch')->name('our-people.fetch-archive');
            Route::post('our-people/fetch-item/{id?}', 'OurPeopleFetchController@fetchView')->name('our-people.fetch-item');
            Route::post('our-people/fetch-pagination/{id}', 'OurPeopleFetchController@fetchPagePagination')->name('our-people.fetch-pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Events
        |--------------------------------------------------------------------------
        */
        Route::namespace('Events')->group(function() {
            Route::get('events', 'EventController@index')->name('events.index');
            Route::get('events/create', 'EventController@create')->name('events.create');
            Route::post('events/store', 'EventController@store')->name('events.store');
            Route::get('events/{id}/show', 'EventController@show')->name('events.show');
            Route::post('events/{id}/update', 'EventController@update')->name('events.update');
            Route::post('events/{id}/archive', 'EventController@archive')->name('events.archive');
            Route::post('events/{id}/restore', 'EventController@restore')->name('events.restore');
            Route::post('events/export', 'EventController@export')->name('events.export');

            Route::post('events/fetch', 'EventFetchController@fetch')->name('events.fetch');
            Route::post('events/fetch?archived=1', 'EventFetchController@fetch')->name('events.fetch-archive');
            Route::post('events/fetch-item/{id?}', 'EventFetchController@fetchView')->name('events.fetch-item');
            Route::post('events/fetch-pagination/{id}', 'EventFetchController@fetchPagePagination')->name('events.fetch-pagination');
        });
        
        /*
        |--------------------------------------------------------------------------
        | @Routes for Studies
        |--------------------------------------------------------------------------
        */
        Route::namespace('Studies')->group(function() {       
            Route::get('studies', 'StudyController@index')->name('studies.index');
            Route::get('studies/create', 'StudyController@create')->name('studies.create');
            Route::post('studies/store', 'StudyController@store')->name('studies.store');
            Route::get('studies/{id}/show', 'StudyController@show')->name('studies.show');
            Route::post('studies/{id}/update', 'StudyController@update')->name('studies.update');
            Route::post('studies/{id}/archive', 'StudyController@archive')->name('studies.archive');
            Route::post('studies/{id}/restore', 'StudyController@restore')->name('studies.restore');
            Route::get('studies/{id}/download', 'StudyController@download')->name('studies.download');

            Route::post('studies/fetch', 'StudyFetchController@fetch')->name('studies.fetch');
            Route::post('studies/fetch?archived=1', 'StudyFetchController@fetch')->name('studies.fetch.archive');
            Route::post('studies/fetch-item/{id?}', 'StudyFetchController@fetchItem')->name('studies.fetch.item');
            Route::post('studies/fetch-pagination/{id}', 'StudyFetchController@fetchPagePagination')->name('studies.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Studies
        |--------------------------------------------------------------------------
        */
        Route::namespace('YouthWorks\YouthWorksCourses')->group(function() {       
            Route::get('youth-works-courses', 'YouthWorksCourseController@index')->name('youth-works-courses.index');
            Route::get('youth-works-courses/create', 'YouthWorksCourseController@create')->name('youth-works-courses.create');
            Route::post('youth-works-courses/store', 'YouthWorksCourseController@store')->name('youth-works-courses.store');
            Route::get('youth-works-courses/{id}/show', 'YouthWorksCourseController@show')->name('youth-works-courses.show');
            Route::post('youth-works-courses/{id}/update', 'YouthWorksCourseController@update')->name('youth-works-courses.update');
            Route::post('youth-works-courses/{id}/archive', 'YouthWorksCourseController@archive')->name('youth-works-courses.archive');
            Route::post('youth-works-courses/{id}/restore', 'YouthWorksCourseController@restore')->name('youth-works-courses.restore');
            Route::get('youth-works-courses/{id}/download', 'YouthWorksCourseController@download')->name('youth-works-courses.download');

            Route::post('youth-works-courses/fetch', 'YouthWorksCourseFetchController@fetch')->name('youth-works-courses.fetch');
            Route::post('youth-works-courses/fetch?archived=1', 'YouthWorksCourseFetchController@fetch')->name('youth-works-courses.fetch.archive');
            Route::post('youth-works-courses/fetch-item/{id?}', 'YouthWorksCourseFetchController@fetchItem')->name('youth-works-courses.fetch.item');
            Route::post('youth-works-courses/fetch-pagination/{id}', 'YouthWorksCourseFetchController@fetchPagePagination')->name('youth-works-courses.fetch.pagination');
        });

         /*
        |--------------------------------------------------------------------------
        | @Routes for YouthWorksTeam
        |--------------------------------------------------------------------------
        */
        Route::namespace('YouthWorks\YouthWorksTeams')->group(function() {       
            Route::get('youth-works-teams', 'YouthWorksTeamController@index')->name('youth-works-teams.index');
            Route::get('youth-works-teams/create', 'YouthWorksTeamController@create')->name('youth-works-teams.create');
            Route::post('youth-works-teams/store', 'YouthWorksTeamController@store')->name('youth-works-teams.store');
            Route::get('youth-works-teams/{id}/show', 'YouthWorksTeamController@show')->name('youth-works-teams.show');
            Route::post('youth-works-teams/{id}/update', 'YouthWorksTeamController@update')->name('youth-works-teams.update');
            Route::post('youth-works-teams/{id}/archive', 'YouthWorksTeamController@archive')->name('youth-works-teams.archive');
            Route::post('youth-works-teams/{id}/restore', 'YouthWorksTeamController@restore')->name('youth-works-teams.restore');
            Route::get('youth-works-teams/{id}/download', 'YouthWorksTeamController@download')->name('youth-works-teams.download');

            Route::post('youth-works-teams/fetch', 'YouthWorksTeamFetchController@fetch')->name('youth-works-teams.fetch');
            Route::post('youth-works-teams/fetch?archived=1', 'YouthWorksTeamFetchController@fetch')->name('youth-works-teams.fetch.archive');
            Route::post('youth-works-teams/fetch-item/{id?}', 'YouthWorksTeamFetchController@fetchItem')->name('youth-works-teams.fetch.item');
            Route::post('youth-works-teams/fetch-pagination/{id}', 'YouthWorksTeamFetchController@fetchPagePagination')->name('youth-works-teams.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for YouthWorksVideos
        |--------------------------------------------------------------------------
        */
        Route::namespace('YouthWorks\YouthWorksVideos')->group(function() {       
            Route::get('youth-works-videos', 'YouthWorksVideoController@index')->name('youth-works-videos.index');
            Route::get('youth-works-videos/create', 'YouthWorksVideoController@create')->name('youth-works-videos.create');
            Route::post('youth-works-videos/store', 'YouthWorksVideoController@store')->name('youth-works-videos.store');
            Route::get('youth-works-videos/{id}/show', 'YouthWorksVideoController@show')->name('youth-works-videos.show');
            Route::post('youth-works-videos/{id}/update', 'YouthWorksVideoController@update')->name('youth-works-videos.update');
            Route::post('youth-works-videos/{id}/archive', 'YouthWorksVideoController@archive')->name('youth-works-videos.archive');
            Route::post('youth-works-videos/{id}/restore', 'YouthWorksVideoController@restore')->name('youth-works-videos.restore');
            Route::get('youth-works-videos/{id}/download', 'YouthWorksVideoController@download')->name('youth-works-videos.download');

            Route::post('youth-works-videos/fetch', 'YouthWorksVideoFetchController@fetch')->name('youth-works-videos.fetch');
            Route::post('youth-works-videos/fetch?archived=1', 'YouthWorksVideoFetchController@fetch')->name('youth-works-videos.fetch.archive');
            Route::post('youth-works-videos/fetch-item/{id?}', 'YouthWorksVideoFetchController@fetchItem')->name('youth-works-videos.fetch.item');
            Route::post('youth-works-videos/fetch-pagination/{id}', 'YouthWorksVideoFetchController@fetchPagePagination')->name('youth-works-videos.fetch.pagination');
        });

    });

     /*
    |--------------------------------------------------------------------------
    | @Routes for ADMIN - CIS
    |--------------------------------------------------------------------------
    */
    Route::namespace('CIS')->group(function() {

        /*
        |--------------------------------------------------------------------------
        | @Routes for UserClassifications
        |--------------------------------------------------------------------------
        */
         Route::namespace('UserClassifications')->group(function() {       
            Route::get('user-classifications', 'UserClassificationController@index')->name('user-classifications.index');
            Route::get('user-classifications/create', 'UserClassificationController@create')->name('user-classifications.create');
            Route::post('user-classifications/store', 'UserClassificationController@store')->name('user-classifications.store');
            Route::get('user-classifications/{id}/show', 'UserClassificationController@show')->name('user-classifications.show');
            Route::post('user-classifications/{id}/update', 'UserClassificationController@update')->name('user-classifications.update');
            Route::post('user-classifications/{id}/archive', 'UserClassificationController@archive')->name('user-classifications.archive');
            Route::post('user-classifications/{id}/restore', 'UserClassificationController@restore')->name('user-classifications.restore');
            Route::get('user-classifications/{id}/download', 'UserClassificationController@download')->name('user-classifications.download');

            Route::post('user-classifications/fetch', 'UserClassificationFetchController@fetch')->name('user-classifications.fetch');
            Route::post('user-classifications/fetch?archived=1', 'UserClassificationFetchController@fetch')->name('user-classifications.fetch.archive');
            Route::post('user-classifications/fetch-item/{id?}', 'UserClassificationFetchController@fetchItem')->name('user-classifications.fetch.item');
            Route::post('user-classifications/fetch-pagination/{id}', 'UserClassificationFetchController@fetchPagePagination')->name('user-classifications.fetch.pagination');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for Users
        |--------------------------------------------------------------------------
        */
         Route::namespace('Users')->group(function() {
            Route::get('users', 'UserController@index')->name('users.index');
            Route::get('users/create', 'UserController@create')->name('users.create');
            Route::post('users/store', 'UserController@store')->name('users.store');
            Route::get('users/{id}/show', 'UserController@show')->name('users.show');
            Route::post('users/{id}/update', 'UserController@update')->name('users.update');
            Route::post('users/{id}/archive', 'UserController@archive')->name('users.archive');
            Route::post('users/{id}/restore', 'UserController@restore')->name('users.restore');
            Route::post('users/export', 'UserController@export')->name('users.export');

            Route::post('users/fetch', 'UserFetchController@fetch')->name('users.fetch');
            Route::post('users/fetch?archived=1', 'UserFetchController@fetch')->name('users.fetch-archive');
            Route::post('users/fetch-item/{id?}', 'UserFetchController@fetchView')->name('users.fetch-item');
            Route::post('users/fetch-pagination/{id}', 'UserFetchController@fetchPagePagination')->name('users.fetch.pagination');
        });

         /*
        |--------------------------------------------------------------------------
        | @Routes for ConfidentialityCategory
        |--------------------------------------------------------------------------
        */
        Route::namespace('ConfidentialityCategories')->group(function() {       
            Route::get('confidentiality-categories', 'ConfidentialityCategoryController@index')->name('confidentiality-categories.index');
            Route::get('confidentiality-categories/create', 'ConfidentialityCategoryController@create')->name('confidentiality-categories.create');
            Route::post('confidentiality-categories/store', 'ConfidentialityCategoryController@store')->name('confidentiality-categories.store');
            Route::get('confidentiality-categories/{id}/show', 'ConfidentialityCategoryController@show')->name('confidentiality-categories.show');
            Route::post('confidentiality-categories/{id}/update', 'ConfidentialityCategoryController@update')->name('confidentiality-categories.update');
            Route::post('confidentiality-categories/{id}/archive', 'ConfidentialityCategoryController@archive')->name('confidentiality-categories.archive');
            Route::post('confidentiality-categories/{id}/restore', 'ConfidentialityCategoryController@restore')->name('confidentiality-categories.restore');
            Route::get('confidentiality-categories/{id}/download', 'ConfidentialityCategoryController@download')->name('confidentiality-categories.download');

            Route::post('confidentiality-categories/fetch', 'ConfidentialityCategoryFetchController@fetch')->name('confidentiality-categories.fetch');
            Route::post('confidentiality-categories/fetch?archived=1', 'ConfidentialityCategoryFetchController@fetch')->name('confidentiality-categories.fetch.archive');
            Route::post('confidentiality-categories/fetch-item/{id?}', 'ConfidentialityCategoryFetchController@fetchItem')->name('confidentiality-categories.fetch.item');
            Route::post('confidentiality-categories/fetch-pagination/{id}', 'ConfidentialityCategoryFetchController@fetchPagePagination')->name('confidentiality-categories.fetch.pagination');
        });


        /*
        |--------------------------------------------------------------------------
        | @Routes for ContactCategory
        |--------------------------------------------------------------------------
        */
         Route::namespace('ContactCategories')->group(function() {       
            Route::get('contact-categories', 'ContactCategoryController@index')->name('contact-categories.index');
            Route::get('contact-categories/create', 'ContactCategoryController@create')->name('contact-categories.create');
            Route::post('contact-categories/store', 'ContactCategoryController@store')->name('contact-categories.store');
            Route::get('contact-categories/{id}/show', 'ContactCategoryController@show')->name('contact-categories.show');
            Route::post('contact-categories/{id}/update', 'ContactCategoryController@update')->name('contact-categories.update');
            Route::post('contact-categories/{id}/archive', 'ContactCategoryController@archive')->name('contact-categories.archive');
            Route::post('contact-categories/{id}/restore', 'ContactCategoryController@restore')->name('contact-categories.restore');


            Route::post('contact-categories/fetch', 'ContactCategoryFetchController@fetch')->name('contact-categories.fetch');
            Route::post('contact-categories/fetch?archived=1', 'ContactCategoryFetchController@fetch')->name('contact-categories.fetch.archive');
            Route::post('contact-categories/fetch-item/{id?}', 'ContactCategoryFetchController@fetchItem')->name('contact-categories.fetch.item');
            Route::post('contact-categories/fetch-pagination/{id}', 'ContactCategoryFetchController@fetchPagePagination')->name('contact-categories.fetch.pagination');

            /*
             *
             */
            Route::post('contact-categories-field/{id}/archive', 'ContactCategoryController@archiveField')->name('contact-categories-field.archive');
        });

        /*
        |--------------------------------------------------------------------------
        | @Routes for ContactInformation
        |--------------------------------------------------------------------------
        */
         Route::namespace('ContactInformations')->group(function() {       
            Route::get('contact-informations', 'ContactInformationController@index')->name('contact-informations.index');
            Route::get('contact-informations/create', 'ContactInformationController@create')->name('contact-informations.create');
            Route::post('contact-informations/store', 'ContactInformationController@store')->name('contact-informations.store');
            Route::get('contact-informations/{id}/show', 'ContactInformationController@show')->name('contact-informations.show');
            Route::post('contact-informations/{id}/update', 'ContactInformationController@update')->name('contact-informations.update');
            Route::post('contact-informations/{id}/archive', 'ContactInformationController@archive')->name('contact-informations.archive');
            Route::post('contact-informations/{id}/restore', 'ContactInformationController@restore')->name('contact-informations.restore');

            Route::post('contact-informations/batch-deletion', 'ContactInformationController@batchDeletion')->name('contact-informations.batch-deletion');
            Route::post('contact-informations/batch-restore', 'ContactInformationController@batchRestore')->name('contact-informations.batch-restore');

            Route::get('contact-informations/upload', 'ContactInformationController@import')->name('contact-informations.import');
            Route::post('contact-informations/upload/information', 'ContactInformationController@upload')->name('contact-informations.upload');

            Route::post('contact-informations/update/excel-format', 'ContactInformationController@updateExcelFile')->name('excel-format.update');

            Route::post('contact-informations/fetch', 'ContactInformationFetchController@fetch')->name('contact-informations.fetch');
            Route::post('contact-informations/fetch?archived=1', 'ContactInformationFetchController@fetch')->name('contact-informations.fetch.archive');
            Route::post('contact-informations/fetch-item/{id?}', 'ContactInformationFetchController@fetchItem')->name('contact-informations.fetch.item');
            Route::post('contact-informations/fetch-pagination/{id}', 'ContactInformationFetchController@fetchPagePagination')->name('contact-informations.fetch.pagination');
        });

         /*
        |--------------------------------------------------------------------------
        | @Routes for RequestInformation
        |--------------------------------------------------------------------------
        */
         Route::namespace('RequestInformation')->group(function() {       
            Route::get('request-information', 'RequestInformationController@index')->name('request-information.index');
            Route::get('request-information/{id}/show', 'RequestInformationController@show')->name('request-information.show');
            Route::post('request-information/{id}/update', 'RequestInformationController@update')->name('request-information.update');
            Route::post('request-information/{id}/archive', 'RequestInformationController@archive')->name('request-information.archive');
            Route::post('request-information/{id}/restore', 'RequestInformationController@restore')->name('request-information.restore');

            Route::post('request-information/{id}/approve', 'RequestInformationController@approve')->name('request-information.approve');
            Route::post('request-information/{id}/disapprove', 'RequestInformationController@disapprove')->name('request-information.disapprove');

            Route::post('request-information/fetch', 'RequestInformationFetchController@fetch')->name('request-information.fetch');
            Route::post('request-information/fetch?archived=1', 'RequestInformationFetchController@fetch')->name('request-information.fetch.archive');
            Route::post('request-information/fetch-item/{id?}', 'RequestInformationFetchController@fetchItem')->name('request-information.fetch.item');
            Route::post('request-information/fetch-pagination/{id}', 'RequestInformationFetchController@fetchPagePagination')->name('request-information.fetch.pagination');
        });

         /*
        |--------------------------------------------------------------------------
        | @Routes for DefiniteFields
        |--------------------------------------------------------------------------
        */
         Route::namespace('DefiniteFields')->group(function() {       
            Route::get('definite-fields/create', 'DefiniteFieldController@create')->name('definite-fields.create');
            Route::post('definite-fields/store', 'DefiniteFieldController@store')->name('definite-fields.store');
            Route::post('definite-fields/{id}/update', 'DefiniteFieldController@update')->name('definite-fields.update');
            Route::post('definite-fields/{id}/archive', 'DefiniteFieldController@archive')->name('definite-fields.archive');

            Route::post('definite-fields/fetch-item/{id?}', 'DefiniteFieldFetchController@fetchItem')->name('definite-fields.fetch.item');
        });

         /*
        |--------------------------------------------------------------------------
        | @Routes for Report
        |--------------------------------------------------------------------------
        */
         Route::namespace('Reports')->group(function() {       
            Route::get('reports', 'ReportController@index')->name('reports.index');
            Route::post('reports/export', 'ReportController@export')->name('reports.export');
        });
    });

    /**
     * @Roles
     */
    Route::namespace('Roles')->group(function() {

        Route::get('roles', 'RoleController@index')->name('roles.index');
        Route::get('roles/create', 'RoleController@create')->name('roles.create');
        Route::post('roles/store', 'RoleController@store')->name('roles.store');
        Route::get('roles/{id}', 'RoleController@show')->name('roles.show');
        Route::post('roles/{id}/update', 'RoleController@update')->name('roles.update');
        Route::post('roles/{id}/archive', 'RoleController@archive')->name('roles.archive');
        Route::post('roles/{id}/restore', 'RoleController@restore')->name('roles.restore');

        Route::post('roles/{id}/update-permission', 'RoleController@updatePermissions')->name('roles.update-permissions');

        Route::post('roles/fetch', 'RoleFetchController@fetch')->name('roles.fetch');
        Route::post('roles/fetch?archived=1', 'RoleFetchController@fetch')->name('roles.fetch-archive');
        Route::post('roles/fetch-item/{id?}', 'RoleFetchController@fetchView')->name('roles.fetch-item');
        Route::post('role/fetch-pagination/{id}', 'RoleFetchController@fetchPagePagination')->name('roles.fetch-pagination');

    });

    /**
     * @Permissions
     */
    Route::namespace('Permissions')->group(function() {

        Route::post('permissions-fetch/{id?}', 'PermissionFetchController@fetch')->name('permissions.fetch');

    });

    Route::namespace('Notifications')->group(function() {

        Route::get('notifications', 'NotificationController@index')->name('notifications.index');
        Route::post('notifications/all/mark-as-read', 'NotificationController@readAll')->name('notifications.read-all');
        Route::post('notifications/{id}/read', 'NotificationController@read')->name('notifications.read');
        Route::post('notifications/{id}/unread', 'NotificationController@unread')->name('notifications.unread');
        
        Route::post('notifications-fetch', 'NotificationFetchController@fetch')->name('notifications.fetch');
        Route::post('notifications-fetch?read=1', 'NotificationFetchController@fetch')->name('notifications.fetch-read');
        Route::post('notifications-fetch?unread=1', 'NotificationFetchController@fetch')->name('notifications.fetch-unread');

    });

    Route::namespace('ActivityLogs')->group(function() {

        Route::get('activity-logs', 'ActivityLogController@index')->name('activity-logs.index');
        Route::post('activity-logs/fetch', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch');

        Route::post('activity-logs/fetch?id={id?}&sample=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.sample-items');

        Route::post('activity-logs/fetch?id={id?}&admin=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.admin-users');
        Route::post('activity-logs/fetch?id={id?}&user=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.users');

        Route::post('activity-logs/fetch?profile=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.profiles');

        Route::post('activity-logs/fetch?id={id?}&roles=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.roles');

        Route::post('activity-logs/fetch?id={id?}&pagecontents=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.pages');
        Route::post('activity-logs/fetch?id={id?}&pageitems=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.page-items');

        Route::post('activity-logs/fetch?id={id?}&articles=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.articles');

        Route::post('activity-logs/fetch?id={id?}&careers=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.careers');
        
        Route::post('activity-logs/fetch?id={id?}&works=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.works');

        Route::post('activity-logs/fetch?id={id?}&projects=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.projects');

        Route::post('activity-logs/fetch?id={id?}&studies=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.studies');     

        Route::post('activity-logs/fetch?id={id?}&news=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.news');       

        Route::post('activity-logs/fetch?id={id?}&studies=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.studies');

        Route::post('activity-logs/fetch?id={id?}&corporations=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.corporations');

        Route::post('activity-logs/fetch?id={id?}&blogs=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.blogs');

        Route::post('activity-logs/fetch?id={id?}&youth-works-courses=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.youth-works-courses');

        Route::post('activity-logs/fetch?id={id?}&youth-works-teams=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.youth-works-teams');

        Route::post('activity-logs/fetch?id={id?}&youth-works-videosteams=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.youth-works-videos');

        Route::post('activity-logs/fetch?id={id?}&user-classifications=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.user-classifications');

        Route::post('activity-logs/fetch?id={id?}&confidentiality-categories=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.confidentiality-categories');

        Route::post('activity-logs/fetch?id={id?}&contact-categories=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.contact-categories');

        Route::post('activity-logs/fetch?id={id?}&contact-informations=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.contact-informations');

        Route::post('activity-logs/fetch?id={id?}&request-information=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.request-information');

        Route::post('activity-logs/fetch?id={id?}&home-first-frame=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.home-first-frame');
        Route::post('activity-logs/fetch?id={id?}&home-latest-study=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.home-latest-study');
        Route::post('activity-logs/fetch?id={id?}&procurements=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.procurements');
        Route::post('activity-logs/fetch?id={id?}&advocacies=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.advocacies');
        Route::post('activity-logs/fetch?id={id?}&events=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.events');
        Route::post('activity-logs/fetch?id={id?}&our-leaderships=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.our-leaderships');
        Route::post('activity-logs/fetch?id={id?}&advisers=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.advisers');
        Route::post('activity-logs/fetch?id={id?}&members=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.members');
        Route::post('activity-logs/fetch?id={id?}&our-people=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.our-people');
        Route::post('activity-logs/fetch?id={id?}&project-priority-areas=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.project-priority-areas');
        Route::post('activity-logs/fetch?id={id?}&faqs=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.faqs');
        Route::post('activity-logs/fetch?id={id?}&challenges=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.challenges');
        Route::post('activity-logs/fetch?id={id?}&solutions=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.solutions');
        Route::post('activity-logs/fetch?id={id?}&frame-four=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.frame-four');

    });
});
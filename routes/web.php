<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| @User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->middleware('auth:web')->group(function() { 

    Route::namespace('User')->group(function() { 
        /*
        |--------------------------------------------------------------------------
        | @Contact Information Routes
        |--------------------------------------------------------------------------
        */
            Route::namespace('ContactInformation')->group(function() {
                Route::get('contact-information/', 'ContactInformationController@index')->name('contact-information.index');
                Route::get('contact-information/show/{id}', 'ContactInformationController@show')->name('contact-informations.show');
                Route::post('contact-information/export', 'ContactInformationController@export')->name('contact-information.export');

                Route::post('contact-information/fetch', 'ContactInformationFetchController@fetch')->name('contact-information.fetch');
                Route::post('contact-information/fetch-item/{id?}', 'ContactInformationFetchController@fetchItem')->name('contact-information.fetch.item');
                Route::post('contact-information/fetch-pagination/{id}', 'ContactInformationFetchController@fetchPagePagination')->name('contact-information.fetch.pagination');
            });

             /*
        |--------------------------------------------------------------------------
        | @Contact Information Routes
        |--------------------------------------------------------------------------
        */
            Route::namespace('RequestInformation')->group(function() {
                Route::post('contact-information/store', 'RequestInformationController@store')->name('contact-information.store');
            });

    });
});

Route::namespace('Auth')->group(function() {

	/* Guest Routes */
	Route::middleware('guest:web')->group(function() {

        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        Route::get('reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset-password/change', 'ResetPasswordController@reset')->name('password.change');

        Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');

        /* Socialite Login */
        Route::get('socialite/{provider}/login', 'SocialiteLoginController@login')->name('socialite.login');
		Route::get('socialite/{provider}/callback', 'SocialiteLoginController@callback')->name('socialite.callback');

		/* Facebook Login */
		Route::get('socialite/facebook/login', 'SocialiteLoginController@login')->name('facebook.login');
		Route::get('socialite/facebook/callback', 'SocialiteLoginController@callback')->name('facebook.callback');

	});

    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');

});

/* User Dashboard Routes */
Route::prefix('dashboard')->middleware('auth:web')->group(function() {

	Route::namespace('Auth')->group(function() {

		Route::get('logout', 'LoginController@logout')->name('logout');

        Route::get('email/reset', 'VerificationController@resend')->name('verification.resend');
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');

	});

	Route::middleware('verified')->group(function() {

		Route::get('', 'DashboardController@index')->name('dashboard');

		/**
         * @Count Fetch Controller
         */
        Route::post('count/notifications', 'CountFetchController@fetchNotificationCount')->name('counts.fetch.notifications');

		Route::namespace('Profiles')->group(function() {

            /**
             * @Profiles
             */
            Route::get('profile', 'ProfileController@show')->name('profiles.show');
            Route::post('profile/update', 'ProfileController@update')->name('profiles.update');

            Route::get('profile/change-password', 'ProfileController@showPassword')->name('profiles.change-password');
            Route::post('profile/change-password', 'ProfileController@changePassword')->name('profiles.change-password');

            Route::post('profile/fetch', 'ProfileController@fetch')->name('profiles.fetch');

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
            Route::post('activity-logs/fetch?profile=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.profiles');

        });

        Route::namespace('Samples')->group(function() {

			Route::get('sample-items', 'SampleItemController@index')->name('sample-items.index');
			Route::get('sample-items/create', 'SampleItemController@create')->name('sample-items.create');
			Route::post('sample-items/store', 'SampleItemController@store')->name('sample-items.store');
			Route::get('sample-items/show/{id}', 'SampleItemController@show')->name('sample-items.show');
			Route::post('sample-items/update/{id}', 'SampleItemController@update')->name('sample-items.update');
			Route::post('sample-items/{id}/archive', 'SampleItemController@archive')->name('sample-items.archive');
		    Route::post('sample-items/{id}/restore', 'SampleItemController@restore')->name('sample-items.restore');
		    Route::post('sample-items/{id}/remove-image', 'SampleItemController@removeImage')->name('sample-items.remove-image');

		    Route::post('sample-items/{id}/approve', 'SampleItemController@approve')->name('sample-items.approve');
		    Route::post('sample-items/{id}/deny', 'SampleItemController@deny')->name('sample-items.deny');

			Route::post('sample-items/fetch', 'SampleItemFetchController@fetch')->name('sample-items.fetch');
			Route::post('sample-items/fetch?archived=1', 'SampleItemFetchController@fetch')->name('sample-items.fetch-archive');
			Route::post('sample-items/fetch-item/{id?}', 'SampleItemFetchController@fetchView')->name('sample-items.fetch-item');
			Route::post('sample-items/fetch-pagination/{id}', 'SampleItemFetchController@fetchPagePagination')->name('sample-items.fetch-pagination');

		});

	});

});


Route::namespace('Pages')->group(function() {
    /**
     * Homepage
     */
    Route::get('', 'PageController@home')->name('home');
    Route::post('/download/latest_study', 'PageController@downloadLatestStudy')->name('download.latest-study');
    Route::post('/download/procurement', 'PageController@downloadProcurementOrCareer')->name('download.procurement');

    /**
     * Careers
     */
    
    Route::get('careers', 'PageController@careers')->name('careers');

    /**
     * Blog Page
     */
    
    Route::get('/blogs', 'PageController@blogs')->name('blogs');
    Route::get('/blogs/{id}/{author}/{name}', 'PageController@selectedBlogs')->name('blogs.show');

    /**
     * News Page
     */
    
    Route::get('/news', 'PageController@news')->name('news');
    Route::get('/news/{id}/{author}/{name}', 'PageController@selectedNews')->name('news.show');

    /**
     * Organization Page
     */
    
    Route::get('/organization', 'PageController@organizations')->name('organizations');
    /**
     * YouthWorkPH Page
     */
    Route::get('/youthworksph', 'PageController@youthWork')->name('youthworksph');

    /**
     * Project Page
     */
    
    Route::get('/projects', 'PageController@projects')->name('projects');
    Route::get('/projects/{id}/{name}', 'PageController@selectedProjects')->name('projects.show');

    /**
     * Areas Of Work
     */
    
    Route::get('/areas-of-work/workforce-development', 'PageController@workforceDevelopment')->name('areas-of-work.workforce');
    Route::get('/areas-of-work/teaching-and-learning', 'PageController@teachingAndLearning')->name('areas-of-work.teaching-and-learning');

    /**
     * Contact Us
     */
    // contact us
    Route::get('/contact-us', 'PageController@contactUs')->name('contact-us');
    Route::post('contact-us/store', 'PageController@storeContact')->name('store.contact-us');

    /**
     * Privacy Policy
     */
    Route::get('/privacy-policy','PageController@privacyPolicy')->name('privacy');
    // Route::get('/privacy-policy', function () { 
    //     return view('web.pages.privacy-policy'); 
    // })->name('web.privacy');
});

Route::namespace('FetchControllers')->group(function() {
    Route::post('blogs/fetch', 'BlogFetchController@fetch')->name('blogs.fetch');
    Route::post('our-leaderships/fetch', 'OurLeadershipFetchController@fetch')->name('our-leadership.fetch');
    Route::post('advisers/fetch', 'AdviserFetchController@fetch')->name('advisers.fetch');
});


/************/
/*STLYESHEET*/
/************/
Route::get('/stylesheet', function () { 
    return view('web.pages.stylesheet'); 
})->name('web.stylesheet');



/*******/
/*PAGES*/
/*******/
// Route::get('/home', function () { 
//     return view('web.pages.home'); 
// })->name('web.home');

// areas of work

// organization

Route::get('/projects/selected-project', function () { 
    return view('web.pages.project.show-project'); 
})->name('web.projects');

// youthworks ph


// blogs


Route::get('/blogs/selected-blog', function () { 
    return view('web.pages.blogs.show-blog'); 
})->name('web.blogs');

// careers




// change password
Route::get('/dashboard/change-password', function () { 
    return view('web.profiles.change-password'); 
})->name('web.change-password');

Route::get('/dashboard/view-details', function () { 
    return view('web.dashboards.show'); 
})->name('web.view-details');
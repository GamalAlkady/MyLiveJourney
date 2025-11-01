<?php

use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View as FacadesView;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Main localization group
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['web', 'checkblocked', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // Public Routes (No authentication required)
    Route::group(['middleware' => ['web']], function () {
        // Homepage
        Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
        Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('about');
        Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
        Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');

        // Places
        Route::group(['prefix' => 'place'], function () {
            Route::get('/details/{id}', 'App\Http\Controllers\HomeController@placeDdetails')->name('place.details');
            Route::get('/list', 'App\Http\Controllers\HomeController@allPlace')->name('places');
        });

        // Tours
        Route::group(['prefix' => 'tour'], function () {
            Route::get('/details/{id}', 'App\Http\Controllers\HomeController@tourDetails')->name('tour.details');
            Route::get('/list', 'App\Http\Controllers\HomeController@allTours')->name('tours');
            Route::get('/booking/{id}', 'App\Http\Controllers\HomeController@tourBooking')->name('tour.booking');
            Route::get('/booking', 'App\Http\Controllers\HomeController@storeBookingRequest')->name('store.tour.booking');
        });

        // Filters
        Route::get('/district/{id}', 'App\Http\Controllers\HomeController@districtWisePlace')->name('district.wise.place');
        Route::get('/placetype/{id}', 'App\Http\Controllers\HomeController@placetypeWisePlace')->name('placetype.wise.place');

        // AI Assistant
        Route::post('/ai/chat', [App\Http\Controllers\AiAssistantController::class, 'chat'])->name('ai.chat');
    });

    // Authentication Routes
    Auth::routes();

    // Public Routes (with activity tracking)
    Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {
        // Activation Routes
        Route::group(['prefix' => 'activate'], function () {
            Route::get('/', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);
            Route::get('/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
            Route::get('/resend', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
            Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);
        });

        // Socialite Register Routes
        Route::group(['prefix' => 'social'], function () {
            Route::get('/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialRedirect']);
            Route::get('/handle/{provider}', ['as' => 'social.handle', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialHandle']);
        });

        // Reactivate deleted account
        Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);
    });

    // Registered and Activated User Routes
    Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {
        Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    });

    // Registered and Activated User Routes (with 2-step verification)
    Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
        // Homepage Route - Redirect based on user role is in controller
        Route::get('/home', [
            'as' => 'public.home',
            'uses' => 'App\Http\Controllers\UserController@index',
        ]);

        // Show users profile - viewable by other users
        Route::get('profile/{username}', [
            'as' => '{username}',
            'uses' => 'App\Http\Controllers\ProfilesController@show',
        ]);
    });

    // User Profile and Account Routes
    Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {
        // Profile resource
        Route::resource('profile', \App\Http\Controllers\ProfilesController::class, [
            'only' => ['show', 'edit', 'update', 'create'],
        ]);

        // Profile management
        Route::group(['prefix' => 'profile/{username}'], function () {
            Route::put('updateUserAccount', [
                'as' => 'profile.updateUserAccount',
                'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
            ]);
            Route::put('updateUserPassword', [
                'as' => 'profile.updateUserPassword',
                'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
            ]);
            Route::delete('deleteUserAccount', [
                'as' => 'profile.deleteUserAccount',
                'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
            ]);
        });


        // Avatar management
        Route::group(['prefix' => 'images/profile/{id}'], function () {
            Route::get('avatar/{image}', [
                'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
            ]);
        });
        Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);
    });

    // User Dashboard and Management Routes
    Route::group([
        'as' => 'user.',
        'prefix' => 'user',
        'namespace' => 'App\Http\Controllers',
        'middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked'],
    ], function () {
        // Dashboard
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // User Management
        Route::resource('users', 'UsersManagementController');

        // Resources
        Route::resource('districts', 'DistrictController');
        Route::resource('placetypes', 'TypeController');
        Route::resource('places', 'PlaceController');
        Route::resource('tours', 'TourController');
        Route::resource('deleted-users', 'SoftDeletesController', [
            'only' => ['index', 'show', 'update', 'destroy'],
        ])->names([
            'index' => 'deleted',
            'show' => 'deleted.show',
            'update' => 'deleted.update',
            'destroy' => 'deleted.destroy',
        ]);

        // Chat System
        Route::resource('chats', 'ChatRoomController')->parameters(['chats' => 'room']);
        Route::group(['prefix' => 'chat/{room}'], function () {
            Route::post('/send', [ChatRoomController::class, 'sendMessage'])->name('chat.send');
            Route::post('/empty', [ChatRoomController::class, 'empty'])->name('chat.empty');
        });
        Route::get('tour/{tour}/chat', [TourController::class, 'chat'])->name('tours.chat');

        // Booking Management
        Route::group(['prefix' => 'booking'], function () {
            Route::get('/', 'BookingController@index')->name('bookings.index');
            Route::get('/pending', 'BookingController@pendingBookings')->name('bookings.pending');
            Route::get('/approved', 'BookingController@approvedBookings')->name('bookings.approved');
        });

        // Admin-specific routes
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('guides', 'UsersManagementController@guideList')->name('guides');
            Route::get('inactive-user/{user}', 'UsersManagementController@inactiveUser')->name('inactiveUser');
            Route::put('active-user/{user}', 'UsersManagementController@activeUser')->name('activeUser');
            Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
            Route::get('routes', 'AdminDetailsController@listRoutes');
            Route::get('active-users', 'AdminDetailsController@activeUsers');
        });

        // Admin and Guide routes
        Route::group(['middleware' => ['role:admin|guide']], function () {
            Route::get('running/tours/', 'TourController@runningTours')->name('tours.running');
            Route::post('tour/complete/{tour}', 'TourController@completeTour')->name('tour.complete');

            Route::group(['prefix' => 'booking-request'], function () {
                Route::put('approve/{booking}', 'BookingController@bookingApprove')->name('booking.approve');
                Route::put('reject/{booking}', 'BookingController@bookingReject')->name('booking.reject');
            });
        });

        // User-specific routes
        Route::group(['middleware' => ['role:user']], function () {
            Route::post('booking/store', 'BookingController@store')->name('booking.store');
            Route::delete('booking/destroy/{booking}', 'BookingController@destroy')->name('booking.destroy');
            Route::put('booking-request/cancel/{booking}', 'BookingController@bookingCancel')->name('booking.cancel');
        });
    });

    // Theme Management
    Route::resource('themes', \App\Http\Controllers\ThemesManagementController::class, [
        'names' => [
            'index' => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    // Utility Routes
    Route::redirect('/php', '/phpinfo', 301);

});
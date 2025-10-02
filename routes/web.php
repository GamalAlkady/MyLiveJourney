<?php

use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View as FacadesView;

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

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    // Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');
    Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('about');
    Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');
    Route::get('/place/details/{id}', 'App\Http\Controllers\HomeController@placeDdetails')->name('place.details');
    Route::get('/package/details/{id}', 'App\Http\Controllers\HomeController@packageDetails')->name('package.details');
    Route::get('/place-list', 'App\Http\Controllers\HomeController@allPlace')->name('all.place');
    Route::get('/package-list', 'App\Http\Controllers\HomeController@allPackage')->name('all.package');
    Route::get('/district/{id}', 'App\Http\Controllers\HomeController@districtWisePlace')->name('district.wise.place');
    Route::get('/placetype/{id}', 'App\Http\Controllers\HomeController@placetypeWisePlace')->name('placetype.wise.place');

    Route::get('/package/booking/{id}', 'App\Http\Controllers\HomeController@packageBooking')->name('package.booking');
    Route::get('/package/booking', 'App\Http\Controllers\HomeController@storeBookingRequest')->name('store.package.booking');
});


// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {
    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {
    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    // Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', [
        'as'   => 'public.home',
        'uses' => 'App\Http\Controllers\UserController@index',
        'name' => 'home',
    ]);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {
    // User Profile and Account Routes
    Route::resource(
        'profile',
        \App\Http\Controllers\ProfilesController::class,
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => 'profile.updateUserAccount',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => 'profile.updateUserPassword',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => 'profile.deleteUserAccount',
        'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {});

Route::redirect('/php', '/phpinfo', 301);


Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => [
        'auth',
        'activated',
        'role:admin',
        'activity',
        'twostep',
        'checkblocked'
    ]
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UsersManagementController::class, [
        'names' => [
            // 'index'   => '',
            // 'destroy' => 'user.destroy',
        ],
        'except' => [
            // 'deleted',
        ],
    ]);
    Route::resource('deleted-users', \App\Http\Controllers\Admin\SoftDeletesController::class, [
        'only' => ['index', 'show', 'update', 'destroy'],
    ])->names([
        'index'   => 'users.deleted',
        'show'    => 'users.deleted.show',
        'destroy' => 'users.deleted.destroy',
    ]);

    // Route::get('deleted', [\App\Http\Controllers\Admin\SoftDeletesController::class,'index'])->name('deleted');

    Route::post('search-users', 'App\Http\Controllers\Admin\UsersManagementController@search')->name('search-users');
    Route::put('active-user/{user}', 'App\Http\Controllers\Admin\UsersManagementController@activeUser')->name('activeUser');



    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');
    Route::resource('district', 'DistrictController');
    Route::resource('placetype', 'TypeController');
    Route::resource('place', 'PlaceController');
    Route::resource('about', 'AboutController');
    Route::resource('guide', 'GuideController');
    // Route::resource('users', 'UsersController');
    Route::resource('tour', 'TourController');
    Route::get('list', 'UsersController@guideList')->name('list');


    Route::get('booking-request/list', 'BookingController@pendingBookingList')->name('pending.booking');
    Route::post('booking-request/approve/{id}', 'BookingController@bookingApprove')->name('booking.approve');
    Route::post('booking-request/remove/{id}', 'BookingController@bookingRemoveByAdmin')->name('booking.remove');
    Route::get('running/packages/', 'BookingController@runningPackage')->name('package.running');
    Route::post('running/package/complete/{id}', 'BookingController@runningPackageComplete')->name('package.running.complete');
    Route::get('tour-history/list', 'BookingController@tourHistory')->name('tour.history');
});


Route::group([
    'as' => 'guide.',
    'prefix' => 'guide',
    'namespace' => 'App\Http\Controllers\Guide',
    'middleware' => [
        'auth',
        'activated',
        'role:guide',
        'activity',
        'twostep',
        'checkblocked'
    ]
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UsersManagementController::class, [
        'names' => [
            // 'index'   => '',
            // 'destroy' => 'user.destroy',
        ],
        'except' => [
            // 'deleted',
        ],
    ]);
    Route::resource('deleted-users', \App\Http\Controllers\Admin\SoftDeletesController::class, [
        'only' => ['index', 'show', 'update', 'destroy'],
    ])->names([
        'index'   => 'users.deleted',
        'show'    => 'users.deleted.show',
        'destroy' => 'users.deleted.destroy',
    ]);

    // Route::get('deleted', [\App\Http\Controllers\Admin\SoftDeletesController::class,'index'])->name('deleted');

    Route::post('search-users', 'App\Http\Controllers\Admin\UsersManagementController@search')->name('search-users');
    Route::put('active-user/{user}', 'App\Http\Controllers\Admin\UsersManagementController@activeUser')->name('activeUser');



    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');
    Route::resource('district', 'DistrictController');
    Route::resource('placetype', 'TypeController');
    Route::resource('place', 'PlaceController');
    Route::resource('about', 'AboutController');
    Route::resource('guide', 'GuideController');
    // Route::resource('users', 'UsersController');
    Route::resource('tour', 'TourController');
    Route::get('list', 'UsersController@guideList')->name('list');


    Route::get('booking-request/list', 'BookingController@pendingBookingList')->name('pending.booking');
    Route::post('booking-request/approve/{id}', 'BookingController@bookingApprove')->name('booking.approve');
    Route::post('booking-request/remove/{id}', 'BookingController@bookingRemoveByAdmin')->name('booking.remove');
    Route::get('running/packages/', 'BookingController@runningPackage')->name('package.running');
    Route::post('running/package/complete/{id}', 'BookingController@runningPackageComplete')->name('package.running.complete');
    Route::get('tour-history/list', 'BookingController@tourHistory')->name('tour.history');
});

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
    'namespace' => 'App\Http\Controllers\User',
    'middleware' => [
        'auth',
        'activated',
        'role:user',
        'activity',
        'twostep',
        'checkblocked'
    ]
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('districts', 'DashboardController@getDistrict')->name('district.index');
    Route::get('placetypes', 'DashboardController@getPlaceType')->name('placetype.index');

    Route::get('places', 'DashboardController@getPlaces')->name('place.index');
    Route::get('places/{id}', 'DashboardController@getPlaceDetails')->name('place.show');

    Route::get('guides', 'DashboardController@getGuides')->name('guide');
    Route::get('guide/{id}', 'DashboardController@getGuideDetails')->name('guide.show');

    Route::get('packages', 'DashboardController@getPackage')->name('package');
    Route::get('packages/{id}', 'DashboardController@getPackageDetails')->name('package.show');


    Route::get('tour-history/list', 'BookingController@tourHistory')->name('tour.history');
    Route::get('booking-request/list', 'BookingController@pendingBookingList')->name('pending.booking');
    Route::post('booking-request/cancel/{id}', 'BookingController@canceLBookingRequest')->name('booking.cancel');
});

Route::resource('themes', \App\Http\Controllers\ThemesManagementController::class, [
    'names' => [
        'index'   => 'themes',
        'destroy' => 'themes.destroy',
    ],
]);


FacadesView::composer('layouts.frontend.inc.footer', function ($view) {
    $placetypes = App\Models\Placetype::all();
    $view->with('placetypes', $placetypes);
});

<?php

use Illuminate\Support\Facades\Route;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------inr------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::get('/privacy-policy', [App\Http\Controllers\MainController::class, 'privacyPolicy']);
Route::get('redirect/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Route::get('/public', function () {
    return redirect('/');
});
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::get('user-locale/{locale}/{admin_id}', function ($locale, $admin_id) {
    AdminUser::find($admin_id)->update(['language' => $locale]);
    return redirect()->back();
})->name('user-locale');

Auth::routes();

Route::post('/get-search-ajax', [App\Http\Controllers\MainController::class, 'getSearchAjax'])->name('get-search-ajax');
Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
Route::get('/order-info/{id}', [App\Http\Controllers\OrdersController::class, 'show'])->name('order-info');
Route::post('/get-categories-ajax', [App\Http\Controllers\OrdersController::class, 'getCategoriesAjax'])->name('get-categories');
Route::post('/get-city-search-ajax', [App\Http\Controllers\MainController::class, 'getCitiesAjax'])->name('get-city-search-ajax');
Route::group([
    'middleware' => 'auth',
    'prefix' => ''
], function() {
    Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
    Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications');
    Route::get('/my-orders', [App\Http\Controllers\OrdersController::class, 'userOrders'])->name('my-orders');
    Route::group([
        'middleware' => 'default-user',
        'prefix' => ''
    ], function() {

    });
    Route::get('/create-order', [App\Http\Controllers\OrdersController::class, 'create'])->name('create-orders');
    Route::post('/store-order', [App\Http\Controllers\OrdersController::class, 'store'])->name('store-order');

    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');

    Route::post('/update-portfolio', [App\Http\Controllers\UserController::class, 'updatePortfolio'])->name('update-portfolio');
    Route::post('/get-portfolio-media', [App\Http\Controllers\UserController::class, 'getPortfolioMedia'])->name('get-portfolio-media');
    Route::post('/add-portfolio-image', [App\Http\Controllers\UserController::class, 'addPortfolioImage'])->name('add-portfolio-image');
    Route::post('/add-portfolio-video', [App\Http\Controllers\UserController::class, 'addPortfolioVideo'])->name('add-portfolio-video');
    Route::post('/delete-user', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');
    Route::post('/delete-media', [App\Http\Controllers\UserController::class, 'deleteMedia'])->name('delete-media');
    Route::post('/recover-delete-user', [App\Http\Controllers\UserController::class, 'recoverDeleteUser'])->name('recover-delete-user');
    Route::post('/order-respond/create', [App\Http\Controllers\OrdersController::class, 'orderRespond'])->name('order-respond-create');
    Route::post('/save-user-categories', [App\Http\Controllers\UserController::class, 'saveUserCategories'])->name('save-user-categories');
    Route::get('/executors', [App\Http\Controllers\UserController::class, 'executors'])->name('executors');
    Route::post('/executors/search', [App\Http\Controllers\UserController::class, 'searchExecutors'])->name('search-executors');
    Route::post('/edit-user', [App\Http\Controllers\UserController::class, 'update'])->name('edit-user');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show-user');
    Route::post('/user-request/create', [App\Http\Controllers\UserController::class, 'userRequest'])->name('user-request-create');
    Route::post('/buy-vip-status', [App\Http\Controllers\UserController::class, 'buyVipStatus'])->name('buy-vip-status');

    Route::group([
        'middleware' => 'author',
        'prefix' => ''
    ], function() {
        Route::get('/order-respond/accept', [App\Http\Controllers\OrdersController::class, 'orderRespondAccept'])->name('order-respond-accept');
        Route::get('/order-respond/change', [App\Http\Controllers\OrdersController::class, 'orderRespondChange'])->name('order-respond-change');
        Route::get('/close-order', [App\Http\Controllers\OrdersController::class, 'closeOrder'])->name('close-order');
        Route::get('/rate-user', [App\Http\Controllers\NotificationsController::class, 'rateUser'])->name('rate-user');
    });
});



Route::group([
    'middleware' => 'auth',
    'prefix' => '/dashboard'
], function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin', [App\Http\Controllers\Admin\AdminHomePageController::class, 'index']);
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('users')->name('users/')->group(static function() {
            Route::get('/',                                             'UsersController@index')->name('index');
            Route::get('/create',                                       'UsersController@create')->name('create');
            Route::post('/',                                            'UsersController@store')->name('store');
            Route::get('/{user}/edit',                                  'UsersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}',                                      'UsersController@update')->name('update-backend-user');
            Route::delete('/{user}',                                    'UsersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('task-categories')->name('task-categories/')->group(static function() {
            Route::get('/',                                             'TaskCategoriesController@index')->name('index');
            Route::get('/create',                                       'TaskCategoriesController@create')->name('create');
            Route::post('/',                                            'TaskCategoriesController@store')->name('store');
            Route::get('/{taskCategory}/edit',                          'TaskCategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TaskCategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{taskCategory}',                              'TaskCategoriesController@update')->name('update');
            Route::delete('/{taskCategory}',                            'TaskCategoriesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('sections')->name('sections/')->group(static function() {
            Route::get('/',                                             'SectionsController@index')->name('index');
            Route::get('/create',                                       'SectionsController@create')->name('create');
            Route::post('/',                                            'SectionsController@store')->name('store');
            Route::get('/{section}/edit',                               'SectionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SectionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{section}',                                   'SectionsController@update')->name('update');
            Route::delete('/{section}',                                 'SectionsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('task-sections')->name('task-sections/')->group(static function() {
            Route::get('/',                                             'TaskSectionsController@index')->name('index');
            Route::get('/create',                                       'TaskSectionsController@create')->name('create');
            Route::post('/',                                            'TaskSectionsController@store')->name('store');
            Route::get('/{taskSection}/edit',                           'TaskSectionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TaskSectionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{taskSection}',                               'TaskSectionsController@update')->name('update');
            Route::delete('/{taskSection}',                             'TaskSectionsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('orders')->name('orders/')->group(static function() {
            Route::get('/get-categories', 'OrdersController@getCategories')->name('get-categories');
            Route::get('/get-cities', 'OrdersController@getCities')->name('get-cities');
            Route::get('/',                                             'OrdersController@index')->name('index');
            Route::get('/create',                                       'OrdersController@create')->name('create');
            Route::post('/',                                            'OrdersController@store')->name('store');
            Route::get('/{order}/edit',                                 'OrdersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'OrdersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{order}',                                     'OrdersController@update')->name('update');
            Route::delete('/{order}',                                   'OrdersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('orders')->name('orders/')->group(static function() {
            Route::get('/',                                             'OrdersController@index')->name('index');
            Route::get('/create',                                       'OrdersController@create')->name('create');
            Route::post('/',                                            'OrdersController@store')->name('store');
            Route::get('/{order}/edit',                                 'OrdersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'OrdersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{order}',                                     'OrdersController@update')->name('update');
            Route::delete('/{order}',                                   'OrdersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('footer-titles')->name('footer-titles/')->group(static function() {
            Route::get('/',                                             'FooterTitlesController@index')->name('index');
            Route::get('/create',                                       'FooterTitlesController@create')->name('create');
            Route::post('/',                                            'FooterTitlesController@store')->name('store');
            Route::get('/{footerTitle}/edit',                           'FooterTitlesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'FooterTitlesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{footerTitle}',                               'FooterTitlesController@update')->name('update');
            Route::delete('/{footerTitle}',                             'FooterTitlesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('footer-links')->name('footer-links/')->group(static function() {
            Route::get('/',                                             'FooterLinksController@index')->name('index');
            Route::get('/create',                                       'FooterLinksController@create')->name('create');
            Route::post('/',                                            'FooterLinksController@store')->name('store');
            Route::get('/{footerLink}/edit',                            'FooterLinksController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'FooterLinksController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{footerLink}',                                'FooterLinksController@update')->name('update');
            Route::delete('/{footerLink}',                              'FooterLinksController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('prices')->name('prices/')->group(static function() {
            Route::get('/',                                             'PricesController@index')->name('index');
            Route::get('/create',                                       'PricesController@create')->name('create');
            Route::post('/',                                            'PricesController@store')->name('store');
            Route::get('/{price}/edit',                                 'PricesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PricesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{price}',                                     'PricesController@update')->name('update');
            Route::delete('/{price}',                                   'PricesController@destroy')->name('destroy');
        });
    });
});
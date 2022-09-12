<?php

use Illuminate\Support\Facades\Route;
use Brackets\AdminAuth\Models\AdminUser;
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

Route::get('/', function () {
    return view('welcome');
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

Route::group([
    'middleware' => 'auth',
    'prefix' => ''
], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications');
    Route::get('/my-orders', [App\Http\Controllers\OrdersController::class, 'userOrders'])->name('my-orders');
    Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
    Route::get('/create-order', [App\Http\Controllers\OrdersController::class, 'create'])->name('create-orders');
    Route::post('/order-respond/create', [App\Http\Controllers\OrdersController::class, 'orderRespond'])->name('order-respond-create');
    Route::get('/order-respond/accept', [App\Http\Controllers\OrdersController::class, 'orderRespondAccept'])->name('order-respond-accept');
    Route::get('/order-respond/change', [App\Http\Controllers\OrdersController::class, 'orderRespondChange'])->name('order-respond-change');
    Route::post('/get-categories-ajax', [App\Http\Controllers\OrdersController::class, 'getCategoriesAjax'])->name('get-categories');
    Route::post('/store-order', [App\Http\Controllers\OrdersController::class, 'store'])->name('store-order');
    Route::get('/order-info/{id}', [App\Http\Controllers\OrdersController::class, 'show'])->name('order-info');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);
});

Route::group([
    'middleware' => 'auth',
    'prefix' => '/dashboard'
], function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);
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
            Route::post('/{user}',                                      'UsersController@update')->name('update');
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
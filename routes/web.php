<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\PermissionsController;
use App\Http\Controllers\Backend\Logs\SqlLogsController;

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

Route::get('/', function () {
    return redirect()->route("home");
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/theme', [DashboardController::class, 'theme']);
Route::get('/developer-components', [DashboardController::class, 'developer_components']);
Route::get('/test', [DashboardController::class, 'test']);
Route::post('/ajax_upload', [DashboardController::class, 'ajax_upload']);
Route::post('/ajax_upload_base64', [DashboardController::class, 'ajax_upload_base64']);

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'middleware' => ['auth', 'role_permission']], function () {    

    Route::group(['prefix' => 'permissions', 'as'=>'permissions.'], function () {
        Route::get('index', [PermissionsController::class, 'index'])->name("index");
        Route::any('assign', [PermissionsController::class, 'assign'])->name("assign");
        Route::any('ajax_get_permissions/{id}', [PermissionsController::class, 'ajax_get_permissions'])->name("ajax_get_permissions");
        Route::any('assign_to_many', [PermissionsController::class, 'assign_to_many'])->name("assign_to_many");        
        Route::post('ajax_delete', [PermissionsController::class, 'ajax_delete'])->name("ajax_delete");
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name("dashboard");

    Route::resource("users", UsersController::class);
    Route::resource("roles", RolesController::class);

    Route::group(['prefix' => 'logs', 'as'=>'logs.'], function () {
        Route::get('sql', [SqlLogsController::class, 'index'])->name('sql.index');
    });
});
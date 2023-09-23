<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Logs\SqlLogsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\PermissionsController;
use App\Http\Controllers\Backend\RolesController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route("login");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'middleware' => ['auth', 'role_permission']], function () {    

    Route::get('dashboard', [DashboardController::class, 'index'])->name("dashboard");

    Route::resource("users", UsersController::class);
    Route::resource("roles", RolesController::class);

    Route::group(['prefix' => 'permissions', 'as'=>'permissions.'], function () {
        Route::get('index', [PermissionsController::class, 'index'])->name("index");
        Route::any('assign', [PermissionsController::class, 'assign'])->name("assign");
        Route::any('ajax_get_permissions/{id}', [PermissionsController::class, 'ajax_get_permissions'])->name("ajax_get_permissions");
        Route::any('assign_to_many', [PermissionsController::class, 'assign_to_many'])->name("assign_to_many");
        Route::delete('destroy/{id}', [PermissionsController::class, 'delete'])->name("destroy");
    });

    Route::group(['prefix' => 'logs', 'as'=>'logs.'], function () {
        Route::get('sql', [SqlLogsController::class, 'index'])->name('sql.index');
    });
});
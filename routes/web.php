<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("users", UsersController::class);
Route::resource("roles", RolesController::class);

Route::get('/permissions/index', [PermissionsController::class, 'index'])->name("permissions.index");
Route::any('/permissions/assign', [PermissionsController::class, 'assign'])->name("permissions.assign");
Route::any('/permissions/assign_to_many', [PermissionsController::class, 'assign_to_many'])->name("permissions.assign_to_many");
Route::delete('/permissions/delete/{id}', [PermissionsController::class, 'delete'])->name("permissions.delete");

<?php

use App\Helpers\SmsHelper;
use App\Helpers\WhatsAppHelper;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeveloperController;
use App\Http\Controllers\Backend\Logs\SystemLogsController;
use App\Http\Controllers\Backend\Logs\UserLogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\PermissionsController;
use App\Http\Controllers\Backend\PublicController;
use App\Http\Controllers\HomeController;
use App\Jobs\backend\JobSendEmailOnRegisration;

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

Route::get('email-test', function(){    
    dispatch(new JobSendEmailOnRegisration("Hardeep Singh", "hardeepvicky1@gmail.com", 123456, "http://localhost:8000"));
    dd('done');
});

Route::get('whatsapp-test', function(){    
    $whatsappHelper = new WhatsAppHelper();

    $whatsappHelper->setMsg("This is test msg from hardeep");

    $whatsappHelper->setFromMobile("9814040490");
    $whatsappHelper->setToMobile("9803915717");

    $whatsappHelper->send();

    dd('done');
});


Route::get('/', function () {
    return redirect()->route("home");
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/theme', [HomeController::class, 'theme']);
Route::get('/developer-components', [HomeController::class, 'developer_components']);
Route::get('/test', [HomeController::class, 'test']);

Route::get('/backend/ajax_send_email_otp/{id}', [RegisterController::class, 'ajax_send_email_otp']);
Route::get('/backend/email_otp_verify/{uid}', [RegisterController::class, 'email_otp_verify']);
Route::post('/backend/ajax_email_otp_verify', [RegisterController::class, 'ajax_email_otp_verify']);

Route::group(['prefix' => 'public', 'as'=>'public.'], function () {
    Route::post('ajax_upload', [PublicController::class, 'ajax_upload']);
    Route::post('ajax_upload_base64', [PublicController::class, 'ajax_upload_base64']);

    Route::get('auth/google_sign_in', [PublicController::class, 'google_sign_in']);
    Route::any('auth/google_callback', [PublicController::class, 'google_callback']);

    Route::any('backend_user_email_otp_verify', [PublicController::class, 'backend_user_email_otp_verify']);
});

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'middleware' => ['auth', 'role_permission']], function () {

    $name = "dashboard";
    Route::get($name, [DashboardController::class, 'index'])->name($name);

    /*** Controller Routes ***/
    Route::resource("users", UsersController::class);
    Route::resource("roles", RolesController::class);

    Route::group(['prefix' => 'permissions', 'as'=>'permissions.'], function () {

        $name = "index";
        Route::get($name, [PermissionsController::class, $name])->name($name);

        $name = "assign";
        Route::get($name, [PermissionsController::class, $name])->name($name);

        $name = "assign";
        Route::any($name, [PermissionsController::class, $name])->name($name);

        $name = "assign_to_many";
        Route::any($name, [PermissionsController::class, $name])->name($name);

        $name = "ajax_get_permissions";
        Route::get("$name/{id}", [PermissionsController::class, $name])->name($name);

        $name = "ajax_delete";
        Route::post($name, [PermissionsController::class, $name])->name($name);
    });

    Route::group(['prefix' => 'logs', 'as'=>'logs.'], function () {
        
        Route::group(['prefix' => 'user', 'as'=>'user.'], function () {

            $name = "email";
            Route::get($name, [UserLogsController::class, $name])->name($name);
        });

        Route::group(['prefix' => 'system', 'as'=>'system.'], function () {

            $name = "sql";
            Route::get($name, [SystemLogsController::class, $name])->name($name);
        });
    });

    $prefix = "developer";
    Route::group(['prefix' => $prefix, 'as'=> "$prefix."], function () {

        $name = "laravel_routes_index";
        Route::get($name, [DeveloperController::class, $name])->name($name);
    });
});
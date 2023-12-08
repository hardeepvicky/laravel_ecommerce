<?php

namespace App\Exceptions;

use App\Helpers\Menu;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (HttpException $e, HttpRequest $request) {

            $error_code = $e->getStatusCode();

            $error_msg = $e->getMessage();

            $request = request();

            $current_url = $request->url();

            $current_route_name = Route::currentRouteName();

            $data = compact("error_code", "error_msg", "current_url", "current_route_name");

            $data['layout'] = 'backend.layouts.error';
            $view_name = "errors.ajax.default";

            if ($request->ajax())
            {
                return response()->view($view_name, $data, $e->getStatusCode());
            }
            else
            {
                $view_name = "errors.default";

                if ($error_code == 401)
                {
                    $data['layout'] = 'backend.layouts.backend';
                    
                    $view_name = "errors.401";

                    Menu::setCurrentRouteName($current_route_name);

                    $menus = Menu::get(Auth::user()->id);

                    $header_menu_list = Menu::getList($menus);

                    $common_elements_path = "backend.common_elements";

                    $breadcums = Menu::getBreadcums($menus);

                    $data = array_merge($data, compact("menus", "header_menu_list", "common_elements_path", "breadcums"));
                }                

                return response()->view($view_name, $data, $error_code);
            }
        });
    }
}
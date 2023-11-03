<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Helpers\FileUtility;
use App\Helpers\LaravelExtend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DeveloperController extends BackendController
{
    public function __construct()
    {
        parent::__construct();        

        $this->routePrefix = "admin.developer";
        $this->viewPrefix = "backend.developer";
    }

    public function laravel_routes_index()
    {
        $routes = LaravelExtend::getRoutes();

        $this->setForView(compact("routes"));

        return $this->view(__FUNCTION__);
    }
}

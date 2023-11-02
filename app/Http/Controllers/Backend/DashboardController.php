<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Helpers\FileUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DashboardController extends BackendController
{
    public function __construct()
    {
        parent::__construct();        

        $this->routePrefix = "admin.dashbaord";
        $this->viewPrefix = "backend.dashboards";
    }

    public function index()
    {
        $view_name = "admin";

        $msg = "Comming Soon";

        $this->setForView(compact("view_name", "msg"));

        return $this->view($view_name);
    }
}

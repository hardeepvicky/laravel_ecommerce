<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends WebController
{
    public function __construct()
    {
        parent::__construct();        

        $this->routePrefix = "";

        $this->viewPrefix = "backend.dashboards";

        $this->setForView([
            'msg' => 'Currently Only Configured For Admin User for Backend'
        ]);
    }

    public function index()
    {
        $this->layout = "backend.layouts.default";
        $view_name = "default";

        if (Auth::check())
        {
            $this->layout = "backend.layouts.main";
            $view_name = "admin";
        }

        $this->setForView(compact("view_name"));

        return $this->view($view_name);
    }

    public function test()
    {
        return view("backend.test");
    }

    public function theme()
    {
        return view("backend.theme");
    }

    public function developer_components()
    {
        return view("backend.developer_components");
    }
}

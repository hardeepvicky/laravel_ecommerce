<?php

namespace App\Http\Controllers;

class DashboardController extends WebController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->layout = "backend.layouts.default";

        $this->routePrefix = "";

        $this->viewPrefix = "backend.dashboards";

        $this->setForView([
            'msg' => 'Currently Only Configured For Admin User for Backend'
        ]);
    }

    public function index()
    {
        return $this->view("admin");
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

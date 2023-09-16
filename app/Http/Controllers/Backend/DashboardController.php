<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class DashboardController extends BackendController
{
    public function __construct()
    {
        $this->routePrefix = "admin.dashboard";
        $this->viewPrefix = "backend.dashboard";
    }

    public function index()
    {
        
    }
}

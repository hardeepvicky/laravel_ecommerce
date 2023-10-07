<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class BackendController extends WebController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->layout = "backend.layouts.default";
    }
}

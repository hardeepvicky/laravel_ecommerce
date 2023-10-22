<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class BackendController extends WebController
{
    public function __construct()
    {
        parent::__construct();
        
        $request = request();

        if ( $request->ajax() ) {
            $this->layout = "backend.layouts.ajax";
        }
        else {
            $this->layout = "backend.layouts.main";
        }
    }
}

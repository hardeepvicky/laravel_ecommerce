<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public $url_prefix, $view_prefix;
    private $data = [];

    protected function setForView(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    protected function view($view_name)
    {
        return view($this->view_prefix . "." . $view_name, $this->data);
    }
}

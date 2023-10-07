<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseComponent extends Component
{
    public $view_data = [];

    public String $view_path;
    
    public function __construct()
    {
        
    }

    public function setForView($data)
    {
        $this->view_data = array_merge($this->view_data, $data);
    }

    public function render()
    {
        return view($this->view_path, $this->view_data);
    }
}

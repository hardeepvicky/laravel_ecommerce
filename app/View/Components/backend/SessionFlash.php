<?php

namespace App\View\Components\backend;

use App\View\Components\BaseComponent;

class SessionFlash extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->view_path = "backend.components.session-flash";
    }
}

<?php

namespace App\View\Components\Backend;

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
        
        $this->view_path = "components.backend.session-flash";
    }
}

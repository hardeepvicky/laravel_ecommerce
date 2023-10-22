<?php

namespace App\View\Components\Backend;

use App\View\Components\BaseComponent;

class YesNoLabel extends BaseComponent
{
    public function __construct(
        public String $value
    )
    {
        parent::__construct();
        
        $this->view_path = "components.backend.yes-no-label";
    }
}

<?php

namespace App\View\Components\Backend;

use App\View\Components\BaseComponent;

class SummaryDeleteButton extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public String $url
    )
    {
        parent::__construct();
        
        $this->view_path = "backend.components.summary-delete-button";
    }
}

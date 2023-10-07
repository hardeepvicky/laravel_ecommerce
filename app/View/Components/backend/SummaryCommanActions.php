<?php

namespace App\View\Components\backend;

use App\View\Components\BaseComponent;

class SummaryCommanActions extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $id,
        public $routePrefix,
    )
    {
        parent::__construct();
        
        $this->view_path = "backend.components.summary-comman-actions";
    }
}

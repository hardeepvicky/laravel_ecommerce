<?php

namespace App\View\Components\Backend;

use App\View\Components\BaseComponent;

class PaginationLinks extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $records
    )
    {
        parent::__construct();

        $this->view_path = "backend.components.pagination-links";
    }
}

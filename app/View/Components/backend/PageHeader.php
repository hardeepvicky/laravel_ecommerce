<?php

namespace App\View\Components\Backend;

use App\View\Components\BaseComponent;

class PageHeader extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public String $title,
        public Array $breadcums,
        public Array $links = [],
    )
    {
        $this->view_path = 'components.backend.page-header';
    }
}

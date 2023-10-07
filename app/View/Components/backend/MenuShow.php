<?php

namespace App\View\Components\Backend;

use App\Helpers\Menu;
use App\View\Components\BaseComponent;

class MenuShow extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->view_path = "backend.components.menu";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->setForView([
            'menu' => Menu::get()
        ]);

        return parent::render();
    }
}

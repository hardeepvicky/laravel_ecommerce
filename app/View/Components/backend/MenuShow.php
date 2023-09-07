<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;
use App\Helpers\Menu;

class MenuShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.menu-show', [
            'menu' => Menu::get()
        ]);
    }
}

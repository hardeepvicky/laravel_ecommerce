<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class PaginationLinks extends Component
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
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.pagination-links');
    }
}

<?php

namespace App\View\Components\inputs;

use Illuminate\View\Component;

class TextField extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public String $name,
        public String $label,
        public String $type="text",
        public String $value = "",
        public String $cssClassName = "",
        public String $placeholder = "",
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
        return view('components.inputs.text-field');
    }
}

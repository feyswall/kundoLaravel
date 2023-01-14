<?php

namespace App\View\Components\system;

use Illuminate\View\Component;

class JimboTable extends Component
{
    public $states;
    public $district;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($states, $district)
    {
        $this->states = $states;
        $this->district = $district;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.system.jimbo-table');
    }
}

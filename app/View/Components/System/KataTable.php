<?php

namespace App\View\Components\system;

use Illuminate\View\Component;

class KataTable extends Component
{
    public $areas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($areas)
    {
        $this->areas = $areas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.system.kata-table');
    }
}

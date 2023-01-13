<?php

namespace App\View\Components\System;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;
    // public array $headers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $areas;
    public $id;
    public $district;

    public function __construct(array $headers, $areas, $id, $district)
    {
        $this->district = $district;
        $this->headers = $headers;
        $this->areas = $areas;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.system.table');
    }
}

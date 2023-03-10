<?php

namespace App\View\Components\System;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class HalmashuriTable extends Component
{
    public  $headers;
    // public array $headers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $areas;
    public $district;

    public function __construct(array $headers, $areas, $district)
    {
        $this->district = $district;
        $this->headers = $headers;
        $this->areas = $areas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.system.halmashauri-table');
    }
}

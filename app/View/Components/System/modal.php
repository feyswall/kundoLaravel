<?php

namespace App\View\Components\system;

use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;

    public $aria;

    public $size;

    public $title;

    public function __construct($id, $aria, $size, $title)
    {
        $this->id = $id;
        $this->aria = $aria;
        $this->size = $size;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.system.modal');
    }
}

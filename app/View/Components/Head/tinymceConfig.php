<?php

namespace App\View\Components\Head;

use Illuminate\View\Component;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class tinymceConfig extends Component
{

    /**
     * The selector type
     * @var string
     */
    public $selector ;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selector = '')
    {
        $this->selector = $selector;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.head.tinymce-config');
    }
}

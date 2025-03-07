<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class tinymceEditor extends Component
{
    
    /**
     * The selector type
     * @var string
     */
    public $selector ;

        /**
     * The value type
     * @var string
     */
    public $value ;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selector = '', $value = '')
    {
        $this->selector=$selector;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}

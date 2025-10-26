<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $url;

    public $itemName;

    public $itemId;

    /**
     * Create a new component instance.
     */
    public function __construct($url, $itemName, $itemId=NULL)
    {
        $this->url = $url;
        $this->itemName = $itemName;
        $this->itemId = $itemId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-button');
    }
}

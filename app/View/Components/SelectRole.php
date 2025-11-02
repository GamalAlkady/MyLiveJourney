<?php

namespace App\View\Components;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectRole extends Component
{
    public $roles;
    public  $value=null;
    /**
     * Create a new component instance.
     */
    public function __construct($value=null)
    {
        $this->value=$value;
        $this->roles=Role::withoutAdmin()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-role');
    }
}

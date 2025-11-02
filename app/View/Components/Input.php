<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $type = 'text';

    public string $name;

    public string $value = '';

    public ?string $label = null;

    public string $placeholder;

    public ?string $icon;

    public bool $required = true;

    public function __construct(string $name, string $placeholder,
        ?string $label = null, ?string $icon = null, $type = 'text', string $value = '',
        bool $required = true, public bool $autofocus = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->required = $required;
        $this->type = $type;
    }

    public function autofocus(): string
    {
        return $this->autofocus ? 'autofocus' : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}

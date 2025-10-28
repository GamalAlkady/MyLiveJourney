<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmButton extends Component
{
    public $url;
    public $buttonName="Confirm";
    public $tooltip='';
    public $method;
    public $modalTitle, $modalMessage,$modalClass='danger', $formTrigger='confirmModal', $actionBtnIcon='';
  
    public function __construct(string $url, string $tooltip,  
    string $modalTitle, string $modalMessage, 
    string $modalClass= 'danger', string $formTrigger= 'confirmModal',string $actionBtnIcon= NULL,
    string $buttonName='Confirm',string $method='PUT')
    {
        $this->url = $url;
        $this->tooltip = $tooltip;
        $this->method = $method;
        $this->modalTitle = $modalTitle;
        $this->modalMessage = $modalMessage;
        $this->modalClass = $modalClass;
        $this->buttonName = $buttonName;
        $this->actionBtnIcon = $actionBtnIcon;
        $this->formTrigger = $formTrigger;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-button');
    }
}

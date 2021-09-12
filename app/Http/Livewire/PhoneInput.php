<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PhoneInput extends Component
{
    
    public $arPhone = [''];
    public $code = '';

    public function mount($phones,$code)
    {
        $this->code = $code;

        if($phones)
        {
            $this->arPhone = [];
        
            foreach($phones as $item)
            {
                $this->arPhone[] = $item->phone ?? $item;
            }
            
        }

    }

    public function render()
    {
        return view('livewire.phone-input');
    }

    public function addInput()
    {
        $this->arPhone[] = '';
    }
    public function removeInput($index)
    {
        unset($this->arPhone[$index]);
    }
}

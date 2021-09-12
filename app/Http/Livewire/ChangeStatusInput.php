<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Box;

class ChangeStatusInput extends Component
{
    public $inputValue = '';
    public $inputs = [['value' => '']];
    protected $listeners  = [
        'checkNumber'
    ];
    public $statuses;

    public function mount($statuses)
    {
        $this->statuses = $statuses;
    }
    public function render()
    {
        return view('livewire.change-status-input');
    }

    public function increamentInput()
    {
        $this->inputs[] = ['value' => ''];
    }

}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;

class CargoForm extends Component
{
    public $cargo = [];
    public $cargos = [];
    public $cargo_number = '';

    public function mount($id)
    {
        $this->getCargo($id);
    }
        
    public function render()
    {
        return view('livewire.cargo-form');
    }

    public function getCargo($id)
    {
        if($id)
        {
            $this->cargo = Cargo::findOrFail($id);
        }
    }
    public function resetCargo()
    {
        $this->cargo = '';
    }
    public function searchCargo()
    {   
        if(!$this->cargo_number)
        {
            $this->cargos = [];
        }
        $this->cargos = Cargo::where('number','like','%'.$this->cargo_number.'%')->where('is_active','active')->get();
    }
}

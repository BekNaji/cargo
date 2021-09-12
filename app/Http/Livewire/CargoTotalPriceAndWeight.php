<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Box;

class CargoTotalPriceAndWeight extends Component
{
    public $cargo;
    public $total_weight = 0;
    public $total_price = 0;
    public $fee = 0;

    protected $listeners = [
        'boxUpdated' => 'calculate'
    ];

    public function mount($cargo)
    {
        if($cargo)
        {
            $this->cargo = $cargo;
            $this->calculate();
        }
    }

    public function render()
    {
        return view('livewire.cargo-total-price-and-weight');
    }

    public function calculate()
    {
        if($this->cargo->id)
        {
        
            $this->total_weight = Box::where('cargo_id',$this->cargo->id)->sum('total_weight');
            $this->total_price  = Box::where('cargo_id',$this->cargo->id)->sum('total_price');
            $this->fee = $this->total_price - $this->cargo->paid;
        }
    }
}

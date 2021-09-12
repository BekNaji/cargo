<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShippingCalculatePrice extends Component
{
    public $categories;
    public $shipping;

    public function mount($categories,$shipping)
    {
        $this->categories = $categories;
        $this->shipping = $shipping;
    }

    public function render()
    {
        return view('livewire.shipping-calculate-price');
    }
}

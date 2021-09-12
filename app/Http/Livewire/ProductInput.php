<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ProductInput extends Component
{
    public $itemkey = '';
    public $item = 0;
    public $items = [];
    public $loop = 0;
    public $product = [];

    protected $listeners = [
        'getItems'
    ];

    public function mount($i,$product)
    {
        $this->loop = $i;
        if($product)
        {
            $this->product = $product;
            $this->getItem($product->item->id,$product->item->name);
        }
        
    }

    public function render()
    {
        return view('livewire.product-input');
    }

    public function getItem($id,$name)
    {
        $this->itemkey = $name;
        $this->item = $id;
        $this->items = [];
    }


    public function getItems()
    {
        if($this->itemkey)
        {
            return $this->items = Item::where('name','like','%'.$this->itemkey.'%')->get();
        }
        $this->items = [];
    }
}

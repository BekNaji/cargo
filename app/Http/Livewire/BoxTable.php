<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Box;

class BoxTable extends Component
{
    public $boxes = [];
    public $url = '';
    public $cargo_id = '';

    protected $listeners = [
        'boxUpdated' => 'getBoxes',
        'boxRemove',
    ];
    public function mount($cargo_id)
    {
        $this->cargo_id = $cargo_id;
        $this->getBoxes($cargo_id);
    }

    public function render()
    {
        return view('livewire.box-table');
    }

    public function getBoxes($cargo_id)
    {
        if($cargo_id)
        {
            $this->boxes = Box::where('cargo_id',$cargo_id)->get();
        }
        $this->url = '';
    }

    public function openIframe($url)
    {
        $this->url = $url;
    }

    public function boxRemove($id)
    {
        $box = Box::findOrFail($id);
        $cargo_id = $box->cargo->id;
        $box->delete();
        $this->emit('boxUpdated',$cargo_id);
    }
}

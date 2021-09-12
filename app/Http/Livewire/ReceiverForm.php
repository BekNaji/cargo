<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class ReceiverForm extends Component
{
    public $key;
    public $receivers = [];
    public $receiver = [];
    public $url = '';

    protected $listeners = [
        'receiverUpdated',
        'receiverUpdated' => 'resetUrl',
    ];

    public function mount($receiver_id)
    {
        if($receiver_id)
        {
            $this->receiver = Customer::findOrFail($receiver_id);
        }
        
    }

    public function render()
    {
        return view('livewire.receiver-form');
    }


    public function search()
    {
        if(!$this->key)
        {
            return $this->receivers = [];
        }
        $this->receivers = Customer::where('type','R')
                        ->where('name','like','%'.$this->key.'%')
                        ->with(['phones'])->limit(5)->get();
    }

    public function getReceiver($id)
    {
        $this->receiver = Customer::where('id',$id)->with(['phones','passport','addresses','addresses.region','addresses.district'])->first();
    }

    public function resetReceiver()
    {
        $this->receiver = [];
    }

    public function receiverUpdated($id)
    {
        if($id != 0){
            $this->receiver = Customer::findOrFail($id);
        }
    }

    public function openIframe($url)
    {
        $this->url = $url;
    }

    public function resetUrl()
    {
        $this->url = '';
    }
    
}

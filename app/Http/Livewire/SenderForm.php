<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class SenderForm extends Component
{
    public $key;
    public $senders = [];
    public $sender = [];
    public $url = '';

    protected $listeners = [
        'senderUpdated',
        'senderUpdated' => 'resetUrl',
    ];

    public function mount($sender_id)
    {
        if($sender_id)
        {
            $this->sender = Customer::findOrFail($sender_id);
        }

        
    }

    public function render()
    {
        return view('livewire.sender-form');
    }

    public function senderUpdated($id)
    {
        if($id != 0)
        {
          $this->sender = Customer::findOrFail($id);
        }
    }

    public function search()
    {
        if(!$this->key)
        {
            return $this->senders = [];
        }
        $this->senders = Customer::where('type','S')
                        ->where('name','like','%'.$this->key.'%')
                        ->with(['phones'])->limit(5)->get();
    }

    public function getSender($id)
    {
        
        $this->sender = Customer::findOrFail($id);
    }

    public function resetSender()
    {
        $this->sender = [];
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

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Status;
use App\Models\Baza;
use App\User;
use App\Models\Branch;

class BoxFilter extends Component
{
    public $statuses = [];
    public $bazas = [];
    public $users = [];
    public $branches = [];

    public function mount()
    {
        $this->statuses = Status::orderBy('sort','ASC')->get();
        $this->bazas = Baza::orderBy('id','DESC')->get();
        $this->users = User::orderBy('id','DESC')->get();
        $this->branches = Branch::orderBy('id','DESC')->get();
    }

    public function render()
    {
        return view('livewire.box-filter');
    }
}

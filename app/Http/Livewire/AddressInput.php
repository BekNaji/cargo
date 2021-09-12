<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Region;
use App\Models\District;

class AddressInput extends Component
{
    public $regions;

    public $region_id;
    public $district_id;
    public $open_address;

    public $districts;

    public function mount($addresses)
    {

        $this->region_id = old('region') ?? $addresses->region_id ??  0;
        $this->district_id = old('district') ?? $addresses->district_id ??  0;
        $this->open_address =  old('open_address') ?? $addresses->open_address ?? '';
        $this->changedRegion($this->region_id);
        $this->regions = Region::all();
    }
    public function render()
    {
        return view('livewire.address-input');
    }

    public function changedRegion($value)
    {
        if($value)
        {
            $this->region_id = $value;
            $this->districts = District::where('region_id',$value)->orderBy('name_uz','ASC')->get();
        }
        
    }
}

<div>
    <label for="">{{ __('Address') }}</label>
    {{old('region')}}
    <select name="region" class="form-control" wire:click="changedRegion($event.target.value)" required> 
        <option value="">{{__('Select one')}}</option>
        @foreach ($regions as $region)
        <option value="{{$region->id}}" {{$region->id == $region_id ? 'selected' : ''}}>{{$region->name_uz}}</option>
        @endforeach
    </select>

    @if ($districts)
    <select name="district" class="form-control mt-2" required>
        <option value="">{{__('Select one')}}</option>
        @foreach ($districts as $item)
        <option value="{{$item->id}}"  {{$item->id == $district_id ? 'selected' : ''}}>{{$item->name_uz}}</option>
        @endforeach
    </select>     
    <textarea class=" mt-2 form-control" name="open_address" id="" cols="5" >{{$open_address ?? ''}}</textarea>
    @endif
</div>

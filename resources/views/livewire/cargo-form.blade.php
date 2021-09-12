<div>
    @if($cargo)
        <input type="hidden" name="cargo_id" value="{{$cargo->id}}" id="cargo_id">
        <h3>{{$cargo->number}}</h3>
        <a href="javascript:;" wire:click="resetCargo">{{__('Change')}}</a>
    @else 
        <input 
        class="form-control" 
        type="text" 
        name="cargo_number"
        wire:model="cargo_number"
        wire:keydown="searchCargo"
        required>
        @if($cargos)
        <div class="shadow-sm result">
            @foreach ($cargos as $item)
                <span class="result-row" wire:click="getCargo({{ $item->id }})">
                    <span>{{ $item->number }}</span><br>
                </span>
            @endforeach
        </div>
        @endif
    @endif
</div>

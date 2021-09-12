<div>
    <div class="form-group">
        <select name="status_id" class="form-control" required>
            <option value="">{{__('Select one')}}</option>
            @foreach ($statuses as $status)
            <option value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
        </select>
    </div>
    <hr> 
    @foreach ($inputs as $key => $input)
    <div class="form-group">
        <input type="text" name="numbers[]" class='form-control inputs' placeholder="{{ __('Number of cargo') }}" wire:model.defer="inputs.{{$key}}.value" >
    </div>   
    
    @endforeach
    <div class="form-group">
        <a href="javascript:;" class="btn btn-success btn-sm" wire:click="increamentInput">+</a>
        <button class="btn btn-primary btn-sm">{{__('Save')}}</button>
    </div>  
</div>



<div>
    <label for="">{{ __('Phone') }}</label>
    @foreach ($arPhone as $index => $phone)
        <div class="d-flex">
            <span style="width: 10%">
                <input class="form-control" value={{ $code }} name="code" readonly />
            </span>

            <span>
                <input class="form-control" type="text" name="phones[]" wire:model.lazy="arPhone.{{$index}}"
                    minlength="9" maxlength="10" required />
                @if ($errors->has('phones.*'))
                    <em class="text-danger">
                        {{ $errors->first('phones.'.$index) }}
                    </em>
                @endif
            </span>
            <span class="ml-2 cursor-pointer" wire:click="removeInput({{ $index }})">X</span>
        </div>
    @endforeach
    <a href="javascript:;" wire:click="addInput()">{{__('Add new phone')}}</a>
</div>

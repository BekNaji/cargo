@csrf
<input type="hidden" name="iframe" value="{{request('iframe')}}">
<input type="hidden" name="id" value="{{$receiver->id ?? 0}}">
@if (isset($receiver->number))
<div class="form-group">
    <label for="">{{ __('Number') }}</label>
    <h3>{{$receiver->number ?? ''}}</h3>

</div>  
@endif
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($receiver->name ?? '') }}" required>
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Passport') }}</label>
    <input class="form-control " type="text" name="passport" value="{{ old('passport') ?? ($receiver->passport->passport ?? '') }}" maxlength="9" minlength="9" required>
    @if ($errors->has('passport'))
        <em class="text-danger">
            {{ $errors->first('passport') }}
        </em>
    @endif
</div>

<div class="form-group">
    @livewire('phone-input', ['phones' => old('phones') ?? $receiver->phones ?? '','code'=>'998'])
</div>

<div class="form-group">
    @livewire('address-input', ['addresses' => old('addresses') ?? $receiver->addresses ?? '','errors' => $errors])
</div>






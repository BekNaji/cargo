@csrf
<input type="hidden" name="iframe" value="{{request('iframe')}}">
<input type="hidden" name="id" value="{{$sender->id ?? 0}}">
@if (isset($sender->number))
<div class="form-group">
    <label for="">{{ __('Number') }}</label>
    <h3>{{$sender->number ?? ''}}</h3>
</div>
 
@endif
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($sender->name ?? '') }}" required>
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>

<div class="form-group">
    @livewire('phone-input', ['phones' => old('phones.*') ?? $sender->phones ?? '','code'=>'90','errors' => $errors])
</div>







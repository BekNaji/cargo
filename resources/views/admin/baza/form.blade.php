@csrf
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($baza->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{ __('Color') }}</label>
    <input class="form-control " type="color" name="color" value="{{ old('color') ?? ($baza->color ?? '#ffffff') }}">
    @if ($errors->has('color'))
        <em class="text-danger">
            {{ $errors->first('color') }}
        </em>
    @endif
</div>



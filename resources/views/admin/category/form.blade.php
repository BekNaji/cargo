@csrf
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($category->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{ __('Price') }}</label>
    <input class="form-control " type="text" name="price" value="{{ old('price') ?? ($category->price ?? '') }}">
    @if ($errors->has('price'))
        <em class="text-danger">
            {{ $errors->first('price') }}
        </em>
    @endif
</div>



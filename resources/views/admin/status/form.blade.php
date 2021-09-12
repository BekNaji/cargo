@csrf
<input type="hidden" name="id" value="{{$status->id ?? 0}}">
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($status->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{ __('Color') }}</label>
    <input class="form-control " type="color" name="color" value="{{ old('color') ?? ($status->color ?? '#ffffff') }}">
    @if ($errors->has('color'))
        <em class="text-danger">
            {{ $errors->first('color') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Is send message') }}</label>
    <select name="is_send" class="form-control">
        <option value="1" {{old('is_send') == '1' || isset($status) && $status->is_send == '1' ? 'selected' : ''}}>{{__('Yes')}}</option>
        <option value="0" {{old('is_send') == '0' || isset($status) && $status->is_send == '0' ? 'selected' : ''}}>{{__('No')}}</option>
    </select>
    @if ($errors->has('is_send'))
        <em class="text-danger">
            {{ $errors->first('is_send') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Sort') }}</label>
    <input type="number" name="sort" value="{{$status->sort ?? ''}}" class="form-control">
    @if ($errors->has('sort'))
        <em class="text-danger">
            {{ $errors->first('sort') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Send message') }}</label>
    <textarea name="message" cols="5" class="form-control">{{old('message') ?? $status->message ?? ''}}</textarea>
    @if ($errors->has('message'))
        <em class="text-danger">
            {{ $errors->first('message') }}
        </em>
    @endif
</div>



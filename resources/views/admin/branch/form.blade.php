@csrf
<input type="hidden" name="id" value="{{$branch->id ?? 0}}">
<div class="form-group">
    <label for="">{{ __('Logo') }}</label>
    <input class="form-control " type="file" name="logo" value="{{ old('logo') ?? ($branch->logo ?? '') }}">
    @if ($errors->has('logo'))
        <em class="text-danger">
            {{ $errors->first('logo') }}
        </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($branch->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Phone') }}</label>
    <input class="form-control " type="text" name="phone" value="{{ old('phone') ?? ($branch->phone ?? '') }}">
    @if ($errors->has('phone'))
        <em class="text-danger">
            {{ $errors->first('phone') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Address from') }}</label>
    <input class="form-control " type="text" name="address_from" value="{{ old('address_from') ?? ($branch->address_from ?? '') }}">
    @if ($errors->has('address_from'))
        <em class="text-danger">
            {{ $errors->first('address_from') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Address to') }}</label>
    <input class="form-control " type="text" name="address_to" value="{{ old('address_to') ?? ($branch->address_to ?? '') }}">
    @if ($errors->has('address_to'))
        <em class="text-danger">
            {{ $errors->first('address_to') }}
        </em>
    @endif
</div>


<div class="form-group">
    <label for="">{{ __('Website') }}</label>
    <input class="form-control " type="text" name="website" value="{{ old('website') ?? ($branch->website ?? '') }}">
    @if ($errors->has('website'))
        <em class="text-danger">
            {{ $errors->first('website') }}
        </em>
    @endif
</div>


<div class="form-group">
    <label for="">{{ __('Status') }}</label>
    <select name="status" id="status" class="form-control">
        <option value="active" {{isset($branch->status) && $branch->status == 'active' ? 'selected':''}}>{{__('Active')}}</option>
        <option value="inactive" {{isset($branch->status) && $branch->status == 'inactive' ? 'selected':''}}>{{__('Inactive')}}</option>
    </select>
    @if ($errors->has('status'))
        <em class="text-danger">
            {{ $errors->first('status') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Sms config for sender') }}</label>
    <select name="sender_smsconfig_id" class="form-control" required>
        <option value="">{{ __('Select one') }}</option>
        @foreach ($smsconfigs as $smsconfig)
            <option value="{{ $smsconfig->id }}" {{Helper::selectOne($branch->sender_smsconfig_id ?? '',old('sender_smsconfig_id') ?? $smsconfig->id ?? '') ? 'selected' : ''}}>
               {{$smsconfig->name ?? ''}}
            </option>
        @endforeach
    </select>
    @if ($errors->has('sender_smsconfig_id'))
        <em class="text-danger">
            {{ $errors->first('sender_smsconfig_id') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Sms config for receiver') }}</label>
    <select name="receiver_smsconfig_id" class="form-control" required>
        <option value="">{{ __('Select one') }}</option>
        @foreach ($smsconfigs as $smsconfig)
            <option value="{{ $smsconfig->id }}" {{Helper::selectOne($branch->receiver_smsconfig_id ?? '',old('receiver_smsconfig_id') ?? $smsconfig->id ?? '') ? 'selected' : ''}}>
               {{$smsconfig->name ?? ''}}
            </option>
        @endforeach
    </select>
    @if ($errors->has('receiver_smsconfig_id'))
        <em class="text-danger">
            {{ $errors->first('receiver_smsconfig_id') }}
        </em>
    @endif
</div>



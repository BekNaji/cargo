@csrf
<input type="hidden" name="id" value="{{$smsconfig->id ?? 0}}">
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($smsconfig->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Title sms') }}</label>
    <input class="form-control " type="text" name="title" value="{{ old('title') ?? ($smsconfig->title ?? '') }}">
    @if ($errors->has('title'))
        <em class="text-danger">
            {{ $errors->first('title') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Login') }}</label>
    <input class="form-control " type="text" name="login" value="{{ old('login') ?? ($smsconfig->login ?? '') }}">
    @if ($errors->has('login'))
        <em class="text-danger">
            {{ $errors->first('login') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Password') }}</label>
    <input class="form-control " type="text" name="password"
        value="{{ old('password') ?? $smsconfig->password ?? '' }}">
    @if ($errors->has('password'))
        <em class="text-danger">
            {{ $errors->first('password') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Token') }}</label>
    <input class="form-control " type="text" name="token" value="{{ old('token') ?? ($smsconfig->token ?? '') }}">
    @if ($errors->has('token'))
        <em class="text-danger">
            {{ $errors->first('token') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Module') }}</label>
    <select name="module" class="form-control">
        <option value="">{{__('Select one')}}</option>
        @php $modules = ['eskiz','massgsm'] @endphp
        @foreach ($modules as $item)
        <option value="{{ $item }}" {{Helper::selectOne($item,old('module') ?? $smsconfig->module ?? '') ? 'selected' : ''}}>{{ $item }}</option>
        @endforeach
        
    </select>
    @if ($errors->has('module'))
        <em class="text-danger">
            {{ $errors->first('module') }}
        </em>
    @endif
</div>

<div class="form-group">
    <div class="row">
        <div class="col-4">
            <label>{{__('Messsage keys')}}</label><br>
            <span>#SENDER#</span><br>
            <span>#RECEIVER#</span><br>
            <span>#CARGO#</span><br>
            <span>#BOXES#</span><br>
            <span>#STATUS#</span><br>
            <span>#STATUS_MESSAGE#</span><br>
        </div>
        <div class="col-8">
            <label for="">{{ __('Message') }}</label>
            <textarea name="message" id="" cols="30" rows="10" class="form-control">{{old('message') ?? $smsconfig->message ?? ''}}</textarea>
            @if ($errors->has('message'))
                <em class="text-danger">
                    {{ $errors->first('message') }}
                </em>
            @endif
        </div>
    </div>
</div>

@csrf
<div class="form-group">
    <label for="roles">{{__('Branch')}}</label>
    <select class="form-control" name="branch_id" required>
        <option value="">Select one</option>
        @forelse ($branches as $branch)
            <option value="{{$branch->id}}" {{isset($user) && $branch->id == $user->branch_id ? 'selected' : ''}}>{{$branch->name}}</option>
        @empty
            No found
        @endforelse
    </select>
    @if($errors->has('branch_id')) 
    <em class="text-danger">
        {{ $errors->first('branch_id') }}
    </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{__('Name')}}</label>
    <input class="form-control " type="text" name="name" value="{{old('name') ?? $user->name ?? ''}}" >
    @if($errors->has('name')) 
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
        @endif
</div>

<div class="form-group">
    <label for="">{{__('Email')}}</label>
    <input class="form-control " type="email" name="email" value="{{old('email') ?? $user->email ?? ''}}" >
    @if($errors->has('email'))
        <em class="text-danger">
        {{ $errors->first('email') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{__('Password')}}</label>
    <input class="form-control " type="password" name="password" autocomplete="off">
    @if($errors->has('password'))
        <em class="text-danger">
        {{ $errors->first('password') }}
        </em>
    @endif
</div>
<div class="form-group">
    <label for="">{{__('Password confirm')}}</label>
    <input class="form-control " type="password" name="password_confirmation"  >
    @if($errors->has('password_confirmation'))
        <em class="text-danger">
        {{ $errors->first('password_confirmation') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="roles">{{__('Role')}}</label>
    <select class="form-control" name="roles[]" id="roles" multiple>
        @forelse ($roles as $role)
            @if (isset($user) && in_array($role->name,$user->getRoleNames()->toArray()))
            <option value="{{$role->name}}" selected>{{$role->name}}</option>
            @else
            <option value="{{$role->name}}">{{$role->name}}</option>
            @endif
            
        @empty
            No found
        @endforelse
    </select>
</div>
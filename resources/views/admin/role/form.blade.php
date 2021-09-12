@csrf
<div class="form-group">
    <label for="">{{ __('Name') }}</label>
    <input class="form-control " type="text" name="name" value="{{ old('name') ?? ($role->name ?? '') }}">
    @if ($errors->has('name'))
        <em class="text-danger">
            {{ $errors->first('name') }}
        </em>
    @endif
</div>

<div class="form-group">
    <label for="">{{ __('Permissions') }}</label>
    <select class="form-control" name="permissions[]" id="permissions" multiple>
        @foreach ($permissions as $permission)
        @if (isset($rolePermissions) && in_array($permission->name,$rolePermissions ?? old('permissions')))
        <option value="{{$permission->name}}" selected >{{$permission->name}}</option>  
        @else
        <option value="{{$permission->name}}" >{{$permission->name}}</option>   
        @endif
        
        @endforeach
    </select>
    @if ($errors->has('permissions'))
        <em class="text-danger">
            {{ $errors->first('permissions') }}
        </em>
    @endif
</div>


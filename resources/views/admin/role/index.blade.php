@extends('layouts.app')
@section('title',__('Role list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Role list')}}</b>
            <div>
                <a href="{{route('admin.role.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Permissions')}}</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($roles  as $role)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form id="id-{{$role->id}}" action="{{route('admin.role.destroy',$role->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                
                                <a class="dropdown-item" href="{{route('admin.role.edit',$role->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$role->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </td>
                    <td>{{$role->name}}</td>
                    <td>
                        @forelse ($role->permissions as $permission)
                            <span class="badge badge-secondary">{{$permission->name}}</span>
                        @empty
                            
                        @endforelse
                    </td>
                </tr>
                @empty
                    <tr>
                        <td>{{__('No records')}}</td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
        </div>
    </div>
@endsection

@section('js')
<script>
    function remove(id){
        if(confirm('{{__("Are you sure")}}')){
            return $('#id-'+id).submit();
        }
    }
</script>
@endsection

@extends('layouts.app')
@section('title', __('User list'))
@section('content')
    <div class="col-12 bg-white p-4">
        <div class="d-flex justify-content-between mb-3">
            <b>Users List</b>
            <div>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead> 
                    <tr>
                        <th>#</th>
                        <th>{{ __('Action') }}</th>
                        <th>{{ __('Branch') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th>{{ __('Created at')}}</th>
                        
                    </tr>
                </thead>
                <thead>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{$user->id}}" action="{{route('admin.user.destroy',$user->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                        </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        <a class="dropdown-item" href="{{route('admin.user.edit',$user->id)}}">{{__('Edit')}}</a>
                                        <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$user->id}})">{{__('Remove')}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->branch->name ?? '' }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge badge-secondary">{{ $role }}</span>
                                @empty
                                    <span>Not found</span>
                                @endforelse
                            </td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @empty

                    @endforelse

                </thead>
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

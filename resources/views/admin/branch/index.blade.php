@extends('layouts.app')
@section('title',__('Branches list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Branches list')}}</b>
            <div>
                <a href="{{route('admin.branch.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Logo')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Status')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($branches  as $branch)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form id="id-{{$branch->id}}" action="{{route('admin.branch.destroy',$branch->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                
                                <a class="dropdown-item" href="{{route('admin.branch.edit',$branch->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$branch->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </td>
                    <td><img width="100" src="{{asset($branch->logo)}}" alt="{{$branch->name}}"></td>
                    <td><a href="{{route('admin.branch.show',$branch->id)}}">{{$branch->name}}</td>
                    <td>{{$branch->phone}}</td>
                    
                    <td>
                        @if ($branch->status == 'active')
                            <span class="text-success">{{$branch->status}}</span>
                        @else
                            <span class="text-success">{{$branch->status}}</span>
                        @endif
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
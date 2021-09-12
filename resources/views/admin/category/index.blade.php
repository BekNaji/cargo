@extends('layouts.app')
@section('title',__('Category list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Category list')}}</b>
            <div>
                <a href="{{route('admin.category.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Created at')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories  as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form id="id-{{$category->id}}" action="{{route('admin.category.destroy',$category->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.category.edit',$category->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$category->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </form>
                    </td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->price}}</td>
                    <td>{{$category->created_at}}</td>
                
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
@extends('layouts.app')
@section('title',__('Baza list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Baza list')}}</b>
            <div>
                <a href="{{route('admin.baza.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Color')}}</th>
                    <th>{{__('Created at')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bazas  as $baza)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form id="id-{{$baza->id}}" action="{{route('admin.baza.destroy',$baza->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.baza.edit',$baza->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$baza->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </form>
                    </td>
                    <td>{{$baza->name}}</td>
                    <td><span class="p-2 text-white" style="background: {{$baza->color ?? ''}}">{{$baza->color}}</span></td>
                    <td>{{$baza->created_at}}</td>
                
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
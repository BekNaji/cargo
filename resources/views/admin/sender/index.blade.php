@extends('layouts.app')
@section('title',__('Senders list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Sender list')}}</b>
            <div>
                <a href="{{route('admin.sender.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phones')}}</th>
                    <th>{{__('Created at')}}</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($senders  as $sender)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form action="{{route('admin.sender.destroy',$sender->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.sender.edit',$sender->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$sender->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </td>
                    <td>{{$sender->name}}</td>
                    <td>
                        @forelse ($sender->phones as $item)
                            {{$item->phone}} <br>
                        @empty
                            Not Found
                        @endforelse
                    </td>
                    <td>{{$sender->created_at}}</a></td>
                
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
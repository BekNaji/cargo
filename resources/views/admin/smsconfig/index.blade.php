@extends('layouts.app')
@section('title',__('Sms config list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Sms config list')}}</b>
            <div>
                <a href="{{route('admin.smsconfig.create')}}" class="btn btn-primary btn-sm">{{__('Create')}}</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Login')}}</th>
                    <th>{{__('Pasword')}}</th>
                    <th>{{__('Module')}}</th>
                    <th>{{__('Created at')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($smsconfigs  as $smsconfig)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <form id="id-{{$smsconfig->id}}" action="{{route('admin.smsconfig.destroy',$smsconfig->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                                </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.smsconfig.edit',$smsconfig->id)}}">{{__('Edit')}}</a>
                                <a href="javascript:;" class="dropdown-item remove" onclick="remove({{$smsconfig->id}})">{{__('Remove')}}</a>
                            </div>
                        </div>
                    </form>
                    </td>
                    <td>{{$smsconfig->name ?? ''}}</td>
                    <td>{{$smsconfig->title ?? ''}}</td>
                    <td>{{$smsconfig->login ?? ''}}</td>
                    <td>{{$smsconfig->password ?? ''}}</td>
                    <td>{{$smsconfig->module ?? ''}}</td>
                    <td>{{$smsconfig->created_at}}</td>
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
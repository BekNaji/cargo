@extends('layouts.app')
@section('title',__('Role show'))
@php
    $data = [
        ['title' => __('Role'),'url' => route('admin.role.index'),'current' =>'N'],
        ['title' => __('Role show'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <p><b>{{__('Name')}}</b>: {{$role->name}}</p>
        <p><b>{{__('Permissions')}}</b>: 
        @forelse ($role->permissions as $permission)
            <span class="badge badge-secondary">{{$permission->name}}</span>
        @empty
            {{__('Permissions not found')}}
        @endforelse</p>
        <p><b>{{__('Created date')}}</b>: {{$role->created_at}}</p>
    </div>
@endsection
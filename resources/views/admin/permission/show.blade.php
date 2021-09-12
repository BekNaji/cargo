@extends('layouts.app')
@section('title',__('Permission show'))
@php
    $data = [
        ['title' => __('Permission list'),'url' => route('admin.permission.index'),'current' =>'N'],
        ['title' => __('Permission show'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <p><b>{{__('Name')}}</b>: {{$permission->name}}</p>
        <p><b>{{__('Register date')}}</b>: {{$permission->created_at}}</p>
    </div>
@endsection
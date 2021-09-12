@extends('layouts.app')
@section('title',__('Role create'))
@php
    $data = [
        ['title' => __('Roles'),'url' => route('admin.role.index'),'current' =>'N'],
        ['title' => __('Role create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.role.store')}}" method="POST">
            @include('admin.role.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
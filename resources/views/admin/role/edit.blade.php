@extends('layouts.app')
@section('title',__('Role edit'))
@php
    $data = [
        ['title' => __('Role list'),'url' => route('admin.role.index'),'current' =>'N'],
        ['title' => __('Role edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.role.update',$role->id)}}" method="POST">
            @method('PUT')
            @include('admin.role.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
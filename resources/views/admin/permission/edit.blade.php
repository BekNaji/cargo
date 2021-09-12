@extends('layouts.app')
@section('title',__('Permission edit'))
@php
    $data = [
        ['title' => __('Permission list'),'url' => route('admin.permission.index'),'current' =>'N'],
        ['title' => __('Permission  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.permission.update',$permission->id)}}" method="POST">
            @method('PUT')
            @include('admin.permission.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
@extends('layouts.app')
@section('title',__('Branch create'))
@php
    $data = [
        ['title' => __('Branch'),'url' => route('admin.permission.index'),'current' =>'N'],
        ['title' => __('Branch create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.branch.store')}}" method="POST" enctype="multipart/form-data">
            @include('admin.branch.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
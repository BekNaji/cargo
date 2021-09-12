@extends('layouts.app')
@section('title',__('Permission create'))
@php
    $data = [
        ['title' => __('Permissons'),'url' => route('admin.permission.index'),'current' =>'N'],
        ['title' => __('Permisson create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.permission.store')}}" method="POST">
            @include('admin.permission.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
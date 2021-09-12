@extends('layouts.app')
@section('title',__('Status create'))
@php
    $data = [
        ['title' => __('Status'),'url' => route('admin.status.index'),'current' =>'N'],
        ['title' => __('Status create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.status.store')}}" method="POST">
            @include('admin.status.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
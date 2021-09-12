@extends('layouts.app')
@section('title',__('Item create'))
@php
    $data = [
        ['title' => __('Item'),'url' => route('admin.item.index'),'current' =>'N'],
        ['title' => __('Item create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.item.store')}}" method="POST">
            @include('admin.item.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
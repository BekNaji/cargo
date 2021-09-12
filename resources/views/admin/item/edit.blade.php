@extends('layouts.app')
@section('title',__('Item edit'))
@php
    $data = [
        ['title' => __('Item list'),'url' => route('admin.item.index'),'current' =>'N'],
        ['title' => __('Item  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.item.update',$item->id)}}" method="POST">
            @method('PUT')
            @include('admin.item.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
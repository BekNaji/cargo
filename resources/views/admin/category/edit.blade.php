@extends('layouts.app')
@section('title',__('Category edit'))
@php
    $data = [
        ['title' => __('Category list'),'url' => route('admin.category.index'),'current' =>'N'],
        ['title' => __('Category  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.category.update',$category->id)}}" method="POST">
            @method('PUT')
            @include('admin.category.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
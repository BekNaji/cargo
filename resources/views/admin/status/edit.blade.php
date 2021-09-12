@extends('layouts.app')
@section('title',__('Status edit'))
@php
    $data = [
        ['title' => __('Status list'),'url' => route('admin.status.index'),'current' =>'N'],
        ['title' => __('Status  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.status.update',$status->id)}}" method="POST">
            @method('PUT')
            @include('admin.status.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
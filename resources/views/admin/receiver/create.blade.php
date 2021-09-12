@extends('layouts.app')
@section('title',__('Receiver create'))
@php
    $data = [
        ['title' => __('Receiver'),'url' => route('admin.receiver.index'),'current' =>'N'],
        ['title' => __('Receiver create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@if (request('iframe') != 'y')
@include('partials.breadcrumb',['breadcrumb' => $data]) 
@endif

    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.receiver.store')}}" method="POST" enctype="multipart/form-data">
            @include('admin.receiver.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
@extends('layouts.app')
@section('title',__('Receiver edit'))
@php
    $data = [
        ['title' => __('Receiver list'),'url' => route('admin.receiver.index'),'current' =>'N'],
        ['title' => __('Receiver  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@if (request('iframe') != 'y')
@include('partials.breadcrumb',['breadcrumb' => $data])
@endif
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.receiver.update',$receiver->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.receiver.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
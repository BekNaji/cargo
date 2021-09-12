@extends('layouts.app')
@section('title',__('Sms config edit'))
@php
    $data = [
        ['title' => __('Sms config list'),'url' => route('admin.smsconfig.index'),'current' =>'N'],
        ['title' => __('Sms config  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.smsconfig.update',$smsconfig->id)}}" method="POST">
            @method('PUT')
            @include('admin.smsconfig.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
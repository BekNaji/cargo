@extends('layouts.app')
@section('title',__('Sms config create'))
@php
    $data = [
        ['title' => __('Sms config'),'url' => route('admin.smsconfig.index'),'current' =>'N'],
        ['title' => __('Sms config create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.smsconfig.store')}}" method="POST">
            @include('admin.smsconfig.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
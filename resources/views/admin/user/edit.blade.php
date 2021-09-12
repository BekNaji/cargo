@extends('layouts.app')
@section('title',__('User edit'))
@php
    $data = [
        ['title' => __('Users'),'url' => route('admin.user.index'),'current' =>'N'],
        ['title' => __('User edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.user.update',$user->id)}}" method="POST">
            @method('PUT')
            @include('admin.user.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
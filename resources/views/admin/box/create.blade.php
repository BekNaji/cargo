@extends('layouts.app')
@section('title',__('Box create'))
@php
    $data = [
        ['title' => __('Box'),'url' => route('admin.box.index'),'current' =>'N'],
        ['title' => __('Box create'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@if(request('iframe') != 'y')
@include('partials.breadcrumb',['breadcrumb' => $data])
@endif
  
    <form action="{{route('admin.box.store')}}" method="POST">
        @include('admin.box.form')
    
    </form>
  
@endsection
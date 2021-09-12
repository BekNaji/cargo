@extends('layouts.app')
@section('title',__('Branch edit'))
@php
    $data = [
        ['title' => __('Branch list'),'url' => route('admin.branch.index'),'current' =>'N'],
        ['title' => __('Branch  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.branch.update',$branch->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @if ($branch->logo)
               <img width="150" src="{{asset($branch->logo)}}"> 
            @endif
            @include('admin.branch.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
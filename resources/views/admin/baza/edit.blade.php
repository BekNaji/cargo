@extends('layouts.app')
@section('title',__('Baza edit'))
@php
    $data = [
        ['title' => __('Baza list'),'url' => route('admin.baza.index'),'current' =>'N'],
        ['title' => __('Baza  edit'),'url' => '#','current' =>'Y'],
    ]    
@endphp
@section('content')
@include('partials.breadcrumb',['breadcrumb' => $data])
    <div class="col-md-12 bg-white p-3">
        <form action="{{route('admin.baza.update',$baza->id)}}" method="POST">
            @method('PUT')
            @include('admin.baza.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
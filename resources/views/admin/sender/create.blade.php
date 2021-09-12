@extends('layouts.app')
@section('title',__('Sender create'))
@php
    $data = [
        ['title' => __('Sender'),'url' => route('admin.sender.index'),'current' =>'N'],
        ['title' => __('Sender create'),'url' => '#','current' =>'Y'],
];
@endphp
@section('content')

    @if (request('iframe') != 'y')
        @include('partials.breadcrumb',['breadcrumb' => $data])
    @endif
    <div class="col-md-12 bg-white p-3">
        <form id="form" action="{{route('admin.sender.store')}}" method="POST" enctype="multipart/form-data">
            @include('admin.sender.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
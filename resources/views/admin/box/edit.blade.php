@extends('layouts.app')
@section('title', __('Box edit'))
@php
$data = [['title' => __('Box list'), 'url' => route('admin.box.index'), 'current' => 'N'], ['title' => __('Box  edit'), 'url' => '#', 'current' => 'Y']];
@endphp
@section('content')
@if(request('iframe') != 'y')
    @include('partials.breadcrumb',['breadcrumb' => $data])
@endif

    <form action="{{ route('admin.box.update', $box->id) }}" method="POST">
        @method('PUT')
        @include('admin.box.form')
    </form>

@endsection

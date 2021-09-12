@extends('layouts.app')
@section('title', __('Cargo create'))
@php
$data = [['title' => __('Cargo'), 'url' => route('admin.cargo.index'), 'current' => 'N'], ['title' => __('Cargo create'), 'url' => '#', 'current' => 'Y']];
@endphp
@section('content')

    @include('partials.breadcrumb',['breadcrumb' => $data])
    <form action="{{ route('admin.cargo.store') }}" method="post">
        @include('admin.cargo.form')
    </form>
@endsection

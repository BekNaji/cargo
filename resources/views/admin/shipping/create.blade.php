@extends('layouts.app')
@section('title', __('Shipping create'))
@php
$data = [['title' => __('Shipping'), 'url' => route('admin.shipping.index'), 'current' => 'N'], ['title' => __('Shipping create'), 'url' => '#', 'current' => 'Y']];
@endphp
@section('content')

    @include('partials.breadcrumb',['breadcrumb' => $data])
    <form action="{{ route('admin.shipping.store') }}" method="post">
        @include('admin.shipping.form')
    </form>
@endsection

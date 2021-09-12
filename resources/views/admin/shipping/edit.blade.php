@extends('layouts.app')
@section('title', __('Shipping edit'))
@php
$data = [['title' => __('Shipping'), 'url' => route('admin.shipping.index'), 'current' => 'N'], ['title' => __('Shipping edit'), 'url' => '#', 'current' => 'Y']];
@endphp
@section('content')

    @include('partials.breadcrumb',['breadcrumb' => $data])
    <form action="{{ route('admin.shipping.update',$shipping->id) }}" method="post">
        @method('PUT')
        @include('admin.shipping.form')
    </form>
@endsection
<style>
    .result .result-row {
        display: block;
        cursor: pointer;
        border-bottom: 1px solid #cccc;
        padding: 10px 15px;
    }

    .result .result-row:hover {
        background: #cccc;
    }

</style>

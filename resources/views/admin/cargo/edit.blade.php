@extends('layouts.app')
@section('title', __('Cargo edit'))
@php
$data = [['title' => __('Cargo'), 'url' => route('admin.cargo.index'), 'current' => 'N'], ['title' => __('Cargo edit'), 'url' => '#', 'current' => 'Y']];
@endphp
@section('content')

    @include('partials.breadcrumb',['breadcrumb' => $data])
    <form action="{{ route('admin.cargo.update',$cargo->id) }}" method="post">
        @method('PUT')
        @include('admin.cargo.form')
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

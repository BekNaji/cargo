@extends('layouts.print')
@section('title', 'Box print')

@section('contetn')
<div class="col-6">
    <h1>{{$cargo->number ?? ''}}</h1>
</div>
<div class="col-6">
    <img src="{{$barcode}}" alt="">
</div>
@endsection
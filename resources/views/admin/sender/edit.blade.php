@extends('layouts.app')
@section('title',__('Sender edit'))
@php
    $data = [
        ['title' => __('Sender list'),'url' => route('admin.sender.index'),'current' =>'N'],
        ['title' => __('Sender  edit'),'url' => '#','current' =>'Y'],
];
@endphp
@section('content')
@if (request('iframe') != 'y')
    @include('partials.breadcrumb',['breadcrumb' => $data])
@endif
    <div class="col-md-12 bg-white p-3">
        <form id="form" action="{{route('admin.sender.update',$sender->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.sender.form')
        <button type="submit" class="btn btn-primary btn-sm">{{__("Submit")}}</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        console.log('Test');
        $('#form').submit(function(e){
            console.log('Submited');
            e.preventDefault();
            $('.btn').attr('disabled',true);
            $(this).submit();

        });
    </script>
@endsection 

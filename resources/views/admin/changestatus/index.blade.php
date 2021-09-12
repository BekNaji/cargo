@extends('layouts.app')
@section('title', __('Change status form'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Change status list') }}</b>
        </div>
        <form action="{{route('admin.change.status.bynumber')}}" method="POST">
            @csrf
            @livewire('change-status-input',['statuses' => $statuses])
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(".inputs").keyup(function() {
            $(this).next(".inputs").focus();
        });
    </script>
@endsection

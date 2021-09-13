<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Result</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{  __('Kargo')}}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        <main class="py-4">
            <div class="container">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($shipping)
                                <div class="d-flex justify-content-between mb-3">
                                    <span>
                                        <b>{{__('Receiver')}}:</b> {{Helper::str_hide($shipping->receiver->name ) ?? ''}}
                                    </span>
                                    <span>
                                        <b>{{__('Sender')}}:</b> {{Helper::str_hide($shipping->sender->name) ?? ''}}
                                    </span>
                                    <span>
                                       <b>{{__('Branch')}}:</b> {{$shipping->branch->name ?? ''}}
                                    </span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('Number')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Date')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($shipping->logs as $item)
                                            <tr>
                                                <td>{{$loop->iteration ?? ''}}</td>
                                                <td>{{$item->shipping->number ?? ''}}</td>
                                                <td>{{$item->status->name ?? ''}} {{$item->status->message ?? ''}}</td>
                                                <td>{{date('d.m.Y h:i:s',strtotime($item->created_at))}}</td>
                                            </tr>
                                            @empty
                                                
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                                @else 
                                <p>{{__('Not found')}}</p> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>

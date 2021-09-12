@extends('layouts.app')
@section('title', __('Status list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Status list') }}</b>
            <div>
                <a href="{{ route('admin.status.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Actions')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Color')}}</th>
                        <th>{{ __('Is send') }}</th>
                        <th>{{ __('Sort') }}</th>
                        <th>{{ __('Message') }}</th>
                        <th>{{__('Created at')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statuses  as $status)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{ $status->id }}" action="{{ route('admin.status.destroy', $status->id) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.status.edit', $status->id) }}">{{ __('Edit') }}</a>
                                            <a href="javascript:;" class="dropdown-item remove"
                                                onclick="remove({{ $status->id }})">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $status->name }}</td>
                            <td><span class="p-2 text-white"
                                    style="background: {{ $status->color ?? '' }}">{{ $status->color }}</span></a></td>
                            <td>
                                @if ($status->is_send == '1')
                                <span class="badge badge-success p-2">
                                   {{__('Yes')}}
                                </span>
                                @else
                                <span class="badge badge-danger p-2">
                                    {{__('No')}}
                                 </span>
                                @endif
                            </td>

                            <td>
                                {{$status->sort ?? ''}}
                            </td>

                            <td>{{ $status->message }}</td>
                            <td>{{ $status->created_at }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td>{{ __('No records') }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        function remove(id) {
            if (confirm('{{ __('Are you sure') }}')) {
                return $('#id-' + id).submit();
            }
        }
    </script>
@endsection

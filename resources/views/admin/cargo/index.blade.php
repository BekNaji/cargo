@extends('layouts.app')
@section('title', __('Cargo list'))
@section('content')
@livewire('cargo-filter')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Cargo list') }}</b>
            <div>
                <a href="{{ route('admin.cargo.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="no-wrap">{{ __('Actions') }}</th>
                        <th class="no-wrap">{{ __('Number') }}</th>
                        <th class="no-wrap">{{ __('Baza') }}</th>
                        <th class="no-wrap">{{ __('Status') }}</th>
                        <th class="no-wrap">{{ __('Sender') }}</th>
                        <th class="no-wrap">{{ __('Receiver') }}</th>
                        <th class="no-wrap">{{ __('User') }}</th>
                        <th class="no-wrap">{{ __('Branch') }}</th>
                        <th class="no-wrap">{{ __('Creted at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cargos  as $cargo)
                        <tr style="background: {{$cargo->status->color}}; ">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{ $cargo->id }}" action="{{ route('admin.cargo.destroy', $cargo->id) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" target="_blank"
                                                href="{{ route('admin.print.cargo', $cargo->id) }}">{{ __('Print') }}</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.cargo.edit', $cargo->id) }}">{{ __('Edit') }}</a>
                                            <a href="javascript:;" class="dropdown-item remove"
                                                onclick="remove({{ $cargo->id }})">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="no-wrap">{{ $cargo->number ?? '' }}</td>
                            <td class="no-wrap">{{ $cargo->baza->name ?? ''  }}</td>
                            <td class="no-wrap">{{ $cargo->status->name }}</td>
                            <td class="no-wrap">{{ $cargo->sender->name ?? ''  }}</td>
                            <td class="no-wrap">{{ $cargo->receiver->name ?? ''  }}</td>
                            <td class="no-wrap">{{ $cargo->user->name ?? ''  }}</td>
                            <td class="no-wrap">{{ $cargo->branch->name ?? ''  }}</td>
                            <td class="no-wrap">{{ $cargo->created_at ?? ''  }}</td>

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

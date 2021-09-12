@extends('layouts.app')
@section('title', __('Senders list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Receivers list') }}</b>
            <div>
                <a href="{{ route('admin.receiver.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Actions') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Passport') }}</th>
                        <th>{{ __('Phones') }}</th>
                        <th>{{ __('Region') }}</th>
                        <th>{{ __('District') }}</th>
                        <th>{{ __('Created at') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($receivers  as $receiver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{ $receiver->id }}"
                                    action="{{ route('admin.receiver.destroy', $receiver->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.receiver.edit', $receiver->id) }}">{{ __('Edit') }}</a>
                                        <a href="javascript:;" class="dropdown-item remove"
                                            onclick="remove({{ $receiver->id }})">{{ __('Remove') }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $receiver->name }}</td>
                            <td>{{ $receiver->passport->passport ?? 'Not found' }}</td>
                            <td>
                                @forelse ($receiver->phones as $item)
                                    {{ $item->phone }} <br>
                                @empty
                                    Not Found
                                @endforelse
                            </td>
                            <td>{{ $receiver->addresses->region->name_uz ?? 'Not found' }}</td>
                            <td>{{ $receiver->addresses->district->name_uz ?? 'Not found'}}</td>
                            <td>{{ $receiver->created_at }}</td>
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

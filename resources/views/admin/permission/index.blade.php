@extends('layouts.app')
@section('title', __('Permission list'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Permission list') }}</b>
            <div>
                <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Actions')}}</th>
                        <th>{{__('Name')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions  as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{ $permission->id }}"
                                    action="{{ route('admin.permission.destroy', $permission->id) }}" method="POST">
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
                                            href="{{ route('admin.permission.edit', $permission->id) }}">{{ __('Edit') }}</a>
                                        <a href="javascript:;" class="dropdown-item remove"
                                            onclick="remove({{ $permission->id }})">{{ __('Remove') }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $permission->name }}</td>
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

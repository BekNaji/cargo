@extends('layouts.app')
@section('title', __('Box list'))
@section('content')
    @livewire('box-filter')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Box list') }}</b>
            <div>
                <a href="{{ route('admin.box.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="no-wrap">{{ __('Actions') }}</th>
                        <th class="no-wrap">{{ __('Cargo number') }}</th>
                        <th class="no-wrap">{{ __('Box number') }}</th>
                        <th class="no-wrap">{{ __('Total Weight') }}</th>
                        <th class="no-wrap">{{ __('Total Price') }}</th>
                        <th class="no-wrap">{{ __('Sender') }}</th>
                        <th class="no-wrap">{{ __('Receiver') }}</th>
                        <th class="no-wrap">{{ __('User') }}</th>
                        <th class="no-wrap">{{ __('Branch') }}</th>
                        <th class="no-wrap">{{ __('Status') }}</th>
                        <th class="no-wrap">{{ __('Created at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($boxes  as $box)
                        <tr style="background: {{ $box->status->color }}; ">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form id="id-{{ $box->id }}" action="{{ route('admin.box.destroy', $box->id) }}"
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
                                                href="{{ route('admin.box.edit', $box->id) }}">{{ __('Edit') }}</a>
                                            <a href="javascript:;" class="dropdown-item remove"
                                                onclick="remove({{ $box->id }})">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->cargo->number ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->number ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->total_weight . 'KG' ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->total_price . '$' ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->cargo->sender->name ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->cargo->receiver->name ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->cargo->user->name ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->cargo->branch->name ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->status->name ?? '' }}</a></td>
                            <td class="no-wrap"><a href="javascript:;"
                                    class="can-copy">{{ $box->created_at }}</a></td>

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

        function copyToClipboard(text) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();
        }
        $(document).on('click', '.can-copy', function() {
            console.log($(this).text());
            copyToClipboard($(this).text());
            toastr.success("Copied")
        })
    </script>
@endsection

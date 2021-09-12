<div>
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <b>{{ __('Boxes') }}</b>
            <div>
                @if ($cargo_id)
                <span class="cursor-pointer mr-4" onclick="refresh('boxUpdated',{{$cargo_id ?? 0}})"><i class="fas fa-sync"></i></span>
                <a href="javascript:;" data-toggle="modal" data-target="#left_modal_box" class="btn btn-primary btn-sm"
                wire:click="openIframe('{{ route('admin.box.create', ['iframe' => 'y', 'cargo_id' => $cargo_id ?? 0]) }}')">{{ __('Create') }}</a>  
                @else 
                <a href="javascript:;" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="{{__('First you have to create Cargo then you can create Box')}}">Create</a>
                @endif
               
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="no-wrap">{{ __('Actions') }}</th>
                            <th class="no-wrap">{{ __('Box number') }}</th>
                            <th class="no-wrap">{{ __('Total Weight') }}</th>
                            <th class="no-wrap">{{ __('Total Price') }}</th>
                            <th class="no-wrap">{{ __('Status') }}</th>
                            <th class="no-wrap">{{ __('Created at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($boxes  as $box)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>

                                    <div class="dropdown show">
                                        <a id="bar" class="dropdown-toggle" href="javascript:;" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{route('admin.print.box',$box->id)}}" target="_blank" class="dropdown-item">{{ __('Print') }}</a>
                                            <a href="javascript:;" class="dropdown-item" data-toggle="modal"
                                                data-target="#left_modal_box"
                                                wire:click="openIframe('{{ route('admin.box.edit', [$box->id, 'iframe' => 'y']) }}')">{{ __('Edit') }}</a>
                                            <a href="javascript:;" class="dropdown-item remove"
                                                onclick="remove({{ $box->id }})">{{ __('Remove') }}</a>
                                        </div>
                                    </div>


                                </td>
                                <td class="no-wrap">{{ $box->number ?? '' }}</td>
                                <td class="no-wrap">{{ $box->total_weight . 'KG' ?? '' }}</td>
                                <td class="no-wrap">{{ $box->total_price . '$' ?? '' }}</td>
                                <td class="no-wrap">{{ $box->status->name ?? '' }}</td>
                                <td class="no-wrap">{{ $box->created_at }}</td>

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
    </div>

    <div wire:ignore.self class="modal modal-right fade " id="left_modal_box" tabindex="-1" role="dialog"
        aria-labelledby="left_modal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Box') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="iframe" class="w-100 h-100" src="{{ $url }}" frameborder="0"></iframe>
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        wire:click="$emit('boxUpdated',{{ $cargo_id ?? 0 }})">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function remove(id) {
            if (confirm('{{ __('Are you sure') }}')) {
                Livewire.emit('boxRemove', id);
            }
        }
    </script>
@endpush

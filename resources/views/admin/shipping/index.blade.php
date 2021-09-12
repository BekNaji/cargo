@extends('layouts.app')
@section('title', __('Shipping list'))
@section('content')
    @livewire('shipping-filter')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{ __('Shipping list') }}</b>
            <div class="d-flex justify-content-between ">
                    <select name="paginate" class="mr-2">
                        <option value="20" {{session('paginate') == 20 ? 'selected' : ''}}>20</option>
                        <option value="30"  {{session('paginate') == 30 ? 'selected' : ''}}>30</option>
                        <option value="40"  {{session('paginate') == 40 ? 'selected' : ''}}>40</option>
                        <option value="50"  {{session('paginate') == 50 ? 'selected' : ''}}>50</option>
                    </select>
                <a href="javascript:;" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#change-status-modal">{{__('Change status')}}</a>
                <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><input type="checkbox" id="select-all"></th>
                        <th class="no-wrap">{{ __('Actions') }}</th>
                        <th class="no-wrap">{{ __('Number') }}</th>
                        <th class="no-wrap">{{ __('Baza') }}</th>
                        <th class="no-wrap">{{ __('Status') }}</th>
                        <th class="no-wrap">{{ __('Sender') }}</th>
                        <th class="no-wrap">{{ __('Receiver') }}</th>
                        <th class="no-wrap">{{ __('User') }}</th>
                        <th class="no-wrap">{{ __('Branch') }}</th>
                        <th class="no-wrap">{{ __('Created at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shippings  as $shipping)
                        <tr style="background: {{ $shipping->status->color ?? '' }}; ">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <input type="checkbox" class="shipping-checkbox" data-id="{{$shipping->id}}">
                            </td>
                            <td>
                                <form id="id-{{ $shipping->id }}"
                                    action="{{ route('admin.shipping.destroy', $shipping->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" target="_blank"
                                                href="{{ route('admin.print.shipping', $shipping->id) }}">{{ __('Print') }}</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.shipping.edit', $shipping->id) }}">{{ __('Edit') }}</a>
                                            <a href="javascript:;" class="dropdown-item remove"
                                                onclick="remove({{ $shipping->id }})">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="no-wrap">{{ $shipping->number ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->baza->name ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->status->name ?? ''}}</td>
                            <td class="no-wrap">{{ $shipping->sender->name ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->receiver->name ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->user->name ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->branch->name ?? '' }}</td>
                            <td class="no-wrap">{{ $shipping->created_at ?? '' }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td>{{ __('No records') }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <nav aria-label="" class="mt-2">
            {{ $shippings->links() }}
        </nav>
    </div>
<form action="{{route('admin.paginate.change')}}" method="get" id="paginate-change">
<input type="hidden" name="paginate_number" >
</form>
    <!-- Modal -->
<div class="modal fade" id="change-status-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Change status')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.change.status.byid')}}" id="status-change-form" method="POST">
            <input type="hidden" id="ids" name="ids">
            @csrf
            <select name="status_id" class="form-control">
                <option value="">Select one</option>
                @forelse (auth()->user()->statuses() as $item)
                <option value="{{$item->id ?? ''}}">{{$item->name ?? ''}}</option>
                @empty
                    
                @endforelse
            </select>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="$('#status-change-form').submit()">Save</button>
        </div>
      </div>
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
        $(document).on('change','#select-all',function(){
            var ids = [];
            if($(this).is(':checked')){
                $('.shipping-checkbox').each(function(index, element){
                    $(element).attr('checked',true);
                    ids[index] = $(element).data('id');
                });
            }else{
                $('.shipping-checkbox').each(function(index, element){
                    $(element).attr('checked',false);
                });
            }
            $('#ids').val(ids.toString());
        });
        
        $(document).on('change','[name=paginate]',function(){
            $('[name=paginate_number]').val($(this).val());
            $('#paginate-change').submit();
        })

    </script>
@endsection

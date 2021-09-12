<tr>
    <td>{{ $loop }}</td>
    <td>
        <input type="hidden" name="item_id[]" wire:model="item">
        <input type="text" name="item_name[]" class="w-100" wire:model="itemkey" wire:keydown='getItems'>
        <div class="position-relative">
            @if ($items)
                <div class="result-item shadow-sm position-absolute w-100 bg-white">
                    @foreach ($items as $item)
                        <div class="p-2 cursor-pointer" wire:click="getItem({{ $item->id }},'{{ $item->name }}')">
                            {{ $item->name ?? '' }}
                        </div>
                    @endforeach
                    <div class="p-2">
                        <a href="javascript:;">New</a>
                    </div>
                </div>
            @endif
        </div>
    </td>
    <td>
        <input type="number" name="item_count[]" class="w-100 item-count item-count-{{ $loop }}" data-id="{{ $loop }}" value="{{$product->count ?? ''}}">
    </td>
    <td>
        <input type="number" name="item_price[]" class="w-100 item-price item-price-{{ $loop }}" data-id="{{ $loop }}" value="{{$product->price ?? ''}}">
    </td>
    <td>
        <input type="number" name="item_total_price[]" class="w-100 item-total-{{ $loop }}" data-id="{{ $loop }}" readonly value="{{$product->total_price ?? ''}}">
    </td>
</tr>
@push('js')
    <script>
        $(document).on('keyup','.item-count, .item-price',function(){
            var id = $(this).data('id');
            var itemtotal = $('.item-count-'+id).val() * $('.item-price-'+id).val();
            $('.item-total-'+id).val(itemtotal)
        })
    </script>
@endpush

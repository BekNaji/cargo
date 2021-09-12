<div>
    <div class="form-group">
        <label>{{ __('Total weight') }}</label>
        <h3>{{ old('total_weight') ?? ($total_weight ?? 0) }} KG</h3>
        <input type="hidden" name="total_weight" class="form-control" 
            value="{{ old('total_weight') ?? ($total_weight ?? '') }}">
    </div>

    <div class="form-group">
        <label for="">{{ __('Total price') }}</label>
        <h3>{{ old('total_price') ?? $total_price ?? 0 }} $</h3>
        <input type="hidden" name="total_price" class="form-control"
            value="{{ old('total_price') ?? $total_price ?? '' }}" id="total_price">
    </div>
</div>
@push('js')
<script>
    console.log('test');
    $(document).on('keyup','#paid',function(){
        var fee = $('#total_price').val() - $(this).val();
        $('#fee_text').text(fee); $('#fee').val(fee);

    });
</script>
@endpush

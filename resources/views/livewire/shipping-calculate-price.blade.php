<div>
    {{-- {{dd($shipping)}} --}}
    <div class="form-group">
        <label for="">{{ __('Category') }}</label>
        <select name="category_id" class="form-control" id="category_id" required>
            <option value="">{{ __('Select one') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" data-price="{{ $category->price }}"
                    {{ Helper::selectOne(old('category_id') ?? ($shipping->category_id ?? 0), $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <em class="text-danger">
                {{ $errors->first('category_id') }}
            </em>
        @endif
    </div>

    <div class="form-group">
        <label for="">{{ __('Total weight') }}</label>
        <input class="form-control " type="text" name="total_weight" id="total_weight"
            value="{{ old('total_weight') ?? ($shipping->total_weight ?? '') }}" required>
        @if ($errors->has('total_weight'))
            <em class="text-danger">
                {{ $errors->first('total_weight') }}
            </em>
        @endif
    </div>
    <div class="form-group">
        <label for="">{{ __('Total Price') }}</label>
        <input class="form-control " type="text" name="total_price" id="total_price"
            value="{{ old('total_price') ?? ($shipping->total_price ?? '') }}" required>
        @if ($errors->has('total_price'))
            <em class="text-danger">
                {{ $errors->first('total_price') }}
            </em>
        @endif
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                console.log('test');
                $('#category_id').change( function() {
                    var category_price = $('#category_id option:selected').data('price');
                    var total_weight = $('#total_weight').val();
                    var total_price = category_price * total_weight;
                    $('#total_price').val(total_price);

                });
                $('#total_weight').keyup(function(){
                    var category_price = $('#category_id option:selected').data('price');
                    var total_weight = $('#total_weight').val();
                    var total_price = category_price * total_weight;
                    $('#total_price').val(total_price);
                })
            });
        </script>
    @endpush
</div>

@csrf
<input type="hidden" name="iframe" value="{{request('iframe') ?? ''}}">
<div class="row"> 
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Products') }}</div>
            <div class="card-body">
                <table class="w-100 h-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Count')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Total price')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 21; $i++)
                            @livewire('product-input',['i'=>$i,'product'=>$box->products[$i-1] ?? ''],key('item-'.$i))
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">{{ __('Box info') }}</div>
            <div class="card-body">

                <div class="form-group">
                    <label for="">{{ __('Cargo number') }}</label>
                    @livewire('cargo-form',['id' => $cargo->id ?? 0])
                    @if ($errors->has('total_weight'))
                        <em class="text-danger">
                            {{ $errors->first('total_weight') }}
                        </em>
                    @endif
                </div>
                <hr>
                @isset($box->number)
                <div class="form-group">
                    <label for="">{{ __('Box number') }}</label>
                    <h3>{{$box->number ?? '' }}</h3>
                </div>   
                @endisset
                @livewire('box-calculate-price',['categories' => $categories,'box'=>$box ?? ''])
                <div class="form-group">
                    <label for="">{{ __('Status') }}</label>
                    <select name="status_id" class="form-control" required>
                        <option value="" disabled selected>{{ __('Select one') }}</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ Helper::selectOne($status->id,old('status_id') ?? $box->status_id ?? $cargo->status_id ?? 0) ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status_id'))
                        <em class="text-danger">
                            {{ $errors->first('status_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">{{ __('Submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@csrf
<input type="hidden" name="cargo_id" value="{{ $cargo->id ?? 0 }}">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-8">
        @livewire('box-table',['cargo_id' => $cargo->id ?? 0])
        <div class="card mb-2">
            <div class="card-header">{{ __('Cargo') }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Cargo number') }}</label>
                            <h2>{{ $cargo->number ?? '' }}</h2>
                        </div>
                        @livewire('cargo-total-price-and-weight',['cargo'=>$cargo ?? ''])
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Baza') }}</label>
                            <select name="baza_id" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($bazas as $key => $baza)
                                    <option value="{{ $baza->id }}"
                                        {{ Helper::selectOne(old('baza_id') ?? ($cargo->baza_id ?? 0), $baza->id) ? 'selected' : '' }}>
                                        {{ $baza->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('baza_id'))
                                <em class="text-danger">
                                    {{ $errors->first('baza_id') }}
                                </em>
                            @endif
                        </div>

                        <div class="form-group">
                            @php
                                $payments = ['S' => __('Sender'), 'R' => __('Receiver')];
                            @endphp
                            <label for="">{{ __('Payment') }}</label>
                            <select name="payment" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($payments as $key => $payment)
                                    <option value="{{ $key }}"
                                        {{ old('payment') == $key || (isset($cargo) && $cargo->payment == $key) ? 'selected' : '' }}>
                                        {{ $payment }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('payment'))
                                <em class="text-danger">
                                    {{ $errors->first('payment') }}
                                </em>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Branches') }}</label>
                            <select name="branch_id" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ old('category_id') == $branch->id || $branch->id == auth()->user()->branch_id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('branch_id'))
                                <em class="text-danger">
                                    {{ $errors->first('branch_id') }}
                                </em>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Status') }}</label>
                            <select name="status_id" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ old('status_id') == $status->id || (isset($cargo->status_id) && $cargo->status_id == $status->id) ? 'selected' : '' }}>
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


                        <div class="form-group">
                            <label for="">{{ __('Sms config for sender') }}</label>
                            <select name="sender_smsconfig_id" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($smsconfigs as $smsconfig)
                                    <option value="{{ $smsconfig->id }}"
                                        {{ Helper::selectOne(auth()->user()->branch->sender_smsconfig_id ?? '', old('sender_smsconfig_id') ?? ($smsconfig->id ?? '')) ? 'selected' : '' }}>
                                        {{ $smsconfig->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('sender_smsconfig_id'))
                                <em class="text-danger">
                                    {{ $errors->first('sender_smsconfig_id') }}
                                </em>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Sms config for receiver') }}</label>
                            <select name="receiver_smsconfig_id" class="form-control" required>
                                <option value="">{{ __('Select one') }}</option>
                                @foreach ($smsconfigs as $smsconfig)
                                    <option value="{{ $smsconfig->id }}"
                                        {{ Helper::selectOne(auth()->user()->branch->receiver_smsconfig_id ?? '', old('receiver_smsconfig_id') ?? ($smsconfig->id ?? '')) ? 'selected' : '' }}>
                                        {{ $smsconfig->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('receiver_smsconfig_id'))
                                <em class="text-danger">
                                    {{ $errors->first('receiver_smsconfig_id') }}
                                </em>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block">{{ __('Submit') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <span>{{ __('Sender') }} </span>
                <span class="cursor-pointer " onclick="refresh('senderUpdated',{{ $cargo->sender_id ?? 0 }})"><i
                        class="fas fa-sync"></i></span>
            </div>
            <div class="card-body">
                @livewire('sender-form',['sender_id' => old('sender_id') ?? $cargo->sender_id ?? 0])
                @if ($errors->has('sender_id'))
                    <em class="text-danger">
                        {{ $errors->first('sender_id') }}
                    </em>
                @endif
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ __('Receiver') }}</span>
                <span class="cursor-pointer " onclick="refresh('receiverUpdated',{{ $cargo->receiver_id ?? 0 }})"><i
                        class="fas fa-sync"></i></span>
            </div>
            <div class="card-body">
                @livewire('receiver-form',['receiver_id' => old('receiver_id') ?? $cargo->receiver_id ?? 0])
                @if ($errors->has('receiver_id'))
                    <em class="text-danger">
                        {{ $errors->first('receiver_id') }}
                    </em>
                @endif
            </div>
        </div>
    </div>
</div>

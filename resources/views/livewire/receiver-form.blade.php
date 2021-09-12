<div>
    @if (!$receiver)
        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{__('Receiver Name')}}" wire:model="key" wire:keydown="search">
            <div class="shadow-sm result">
                @foreach ($receivers as $receiver)
                    <span class="result-row" wire:click="getReceiver({{ $receiver->id }})">
                        <span>{{ $receiver->name }}</span><br>
                        <span class="text-secondary">{{ $receiver->phones[0]->phone ?? '' }}</span>
                    </span>
                @endforeach
                <span class="result-row" data-toggle="modal" data-target="#left_modal_receiver" wire:click="openIframe('{{ route('admin.receiver.create',['iframe'=>'y'])}}')">
                    <span><a href="javascript:;" >{{ __('New') }}</a></span><br>
                </span>
            </div>
        </div>
    @else
        <div>
            <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $receiver->id }}">
            <div>
                <span class="text-secondary">{{ __('Name') }}</span> <br>
                <span>{{ $receiver->name }}</span>
            </div>
            <div class="mt-2">
                <span class="text-secondary">{{ __('Passport') }}</span> <br>
                <span>{{ $receiver->passport->passport ?? '' }}</span>
            </div>
            <div class="mt-2">
                <span class="text-secondary">{{ __('Phones') }}</span> <br>
                @foreach ($receiver->phones as $phone)
                    <span>{{ $phone->phone ?? '' }}</span><br>
                @endforeach
            </div>

            <div class="mt-2">
                <span class="text-secondary">{{ __('Region') }}</span> <br>
                <span>{{ $receiver->addresses->region->name_uz ?? '' }}</span>
            </div>

            <div class="mt-2">
                <span class="text-secondary">{{ __('District') }}</span> <br>
                <span>{{ $receiver->addresses->district->name_uz ?? ''}}</span>
            </div>

            <div class="mt-2">
                <span class="text-secondary">{{ __('Open Address') }}</span> <br>
                <span>{{ $receiver->addresses->open_address ?? ''}}</span>
            </div>

            <div class="mt-2">
                <a href="javascript:;" data-toggle="modal" data-target="#left_modal_receiver" wire:click="openIframe('{{ route('admin.receiver.edit',[$receiver->id ?? 0,'iframe' => 'y'])}}')">{{ __('Edit') }}</a> |
                <a href="javascript:;" wire:click="resetReceiver()">{{ __('Change') }}</a>
            </div>
        </div>
    @endif

    <div wire:ignore.self class="modal modal-right fade " id="left_modal_receiver" tabindex="-1" role="dialog" aria-labelledby="left_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Receiver')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$emit('receiverUpdated',{{$receiver->id ?? 0}})">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe class="w-100 h-100" src="{{$url}}" frameborder="0"></iframe>
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$emit('receiverUpdated',{{$receiver->id ?? 0}})">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>   


</div>

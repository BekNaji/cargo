<div>
    <form class="mb-3" action="{{ route('admin.shipping.index') }}" method="GET">
        <input type="text" class="form-control" name="key" id="key" value="" placeholder="{{__('Filter')}}">
        <input type="hidden" name="filter" value="y">
        <div class="position-relative" id="filter-box" style="display:none;">
            <div class="position-absolute bg-white shadow-lg w-100" style="height: 300px; z-index:99;">
                <div class="position-relative w-100 h-100">
                    <div class="p-5 " style="overflow:auto; height: 80%; border-bottom:1px solid #ccc;">
                        <div class="form-group">
                            <label>{{__('From')}}</label>
                            <input type="date" name="from" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>{{__('To')}}</label>
                            <input type="date" name="to" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label>{{__('Status')}}</label>
                            <select name="status_id" class="form-control form-control-sm">
                                <option value="">{{__('Select one')}}</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" {{Helper::selectOne($status->id,request('status_id')) ? 'selected' : ''}}>{{$status->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('Baza')}}</label>
                            <select name="baza_id" class="form-control form-control-sm">
                                <option value="">{{__('Select one')}}</option>
                                @foreach ($bazas as $baza)
                                    <option value="{{$baza->id}}" {{Helper::selectOne($baza->id,request('baza_id')) ? 'selected' : ''}}>{{$baza->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('User')}}</label>
                            <select name="user_id" class="form-control form-control-sm">
                                <option value="">{{__('Select one')}}</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{Helper::selectOne($user->id,request('user_id')) ? 'selected' : ''}}>{{$user->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('Branch')}}</label>
                            <select name="branch_id" class="form-control form-control-sm">
                                <option value="">{{__('Select one')}}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}" {{Helper::selectOne($branch->id,request('branch_id')) ? 'selected' : ''}}>{{$branch->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('Number')}}</label>
                            <input type="text" name="number" class="form-control form-control-sm" value="{{request('number')}}">
                        </div>

                        <div class="form-group">
                            <label>{{__('Receiver')}}</label>
                            <input type="text" name="receiver" class="form-control form-control-sm" value="{{request('receiver')}}">
                        </div>

                        <div class="form-group">
                            <label>{{__('Sender')}}</label>
                            <input type="text" name="sender" class="form-control form-control-sm" value="{{request('sender')}}">
                        </div>
                    </div>
                    <div class="position-absolute bg-white shadow-sm " style="bottom:15px; right:15px;">
                        <button type="submit" class="btn btn-primary btn-sm">{{__('Search')}}</button>
                        <a type="submit" href="{{route('admin.shipping.index')}}" class="btn btn-primary btn-sm">{{__('Clear filter')}}</a>
                        <button type="button" class="btn btn-secondary btn-sm" id="close-filter">{{__('Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
    <script>
        $(document).on('focus','#key',function(){
           $('#filter-box').show();
        });

        $(document).on('click','#close-filter',function(){
           $('#filter-box').hide();
        });
    </script>
    @endpush
</div>

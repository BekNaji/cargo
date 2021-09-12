@extends('layouts.app')
@section('title',__('Make excell'))
@section('content')
    <div class="col-md-12 bg-white p-3">
        <div class="d-flex justify-content-between mb-3">
            <b>{{__('Make excell')}}</b>
        </div>

        <form action="{{route('admin.excell.make')}}" method="post" id="excell-form">
            @csrf
            <div class="form-group">
                <label>{{__('From')}}</label>
                <input type="date" name="from" class="form-control">
            </div>

            <div class="form-group">
                <label>{{__('To')}}</label>
                <input type="date" name="to" class="form-control">
            </div>

            <div class="form-group">
                <label>{{__('Status')}}</label>
                <select name="status_id" class="form-control">
                    <option value="">{{__('Select one')}}</option>
                    @forelse ($statuses as $item)
                    <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label>{{__('Baza')}}</label>
                <select name="baza_id" class="form-control">
                    <option value="">{{__('Select one')}}</option>
                    @forelse ($bazas as $item)
                    <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label>{{__('Category')}}</label>
                <select name="category_id" class="form-control">
                    <option value="">{{__('Select one')}}</option>
                    @forelse ($categories as $item)
                    <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label>{{__('User')}}</label>
                <select name="user_id" class="form-control">
                    <option value="">{{__('Select one')}}</option>
                    @forelse ($users as $item)
                    <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label>{{__('Branch')}}</label>
                <select name="branch_id" class="form-control">
                    <option value="">{{__('Select one')}}</option>
                    @forelse ($branches as $item)
                    <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label>{{__('Excell ')}}</label>
                <select name="excell_type" class="form-control">
                    <option value="e1">{{__('E-1')}}</option>
                    <option value="e2">{{__('E-2')}}</option>
                </select>
            </div>
            <button class="btn btn-primary btn-block" type="submit">{{__("Make")}}</button>
        </form>
    </div>

@endsection

@section('js')
<script>
    $('#excell-form').submit(function(e){
        e.preventDefault();
        $('.btn-block').attr('disabled','disabled');
    })
</script>
@endsection

@extends('layouts.print')
@section('title', 'Box print')

@section('contetn')

    <div class="col-12 position-relative" >
        <div class="district-bg">
            {{$box->cargo->receiver->addresses->region->name_uz ?? ''}} <br>
            {{$box->cargo->receiver->addresses->district->name_uz ?? ''}} <br>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="c-border p-3">
                    <h4>{{auth()->user()->branch->address_from ?? ''}}</h4>
                </div>
            </div>

            <div class="col-6">
                <div class="c-border p-3">
                    <h4>{{auth()->user()->branch->address_to ?? ''}}</h4>
                </div>
            </div>
            <div class="col-6 text-center mt-3 d-flex justify-content-center align-items-center">
                <h3 style="font-size: 40px; transform: scale(2.5);">INVOICE NO: <span class="text-danger">{{$box->number ?? ''}}</span></h3>
            </div>

            <div class="col-6 text-center mt-3">
                <img class="mt-3" src="{{asset($barcode)}}" alt="barcode" style="height: 250px">
            </div>

            <div class="col-md-12">
                <table class="table-c-border w-100 print-c-table">
                    <thead>
                        <tr>
                            <td colspan="2">Sender</td>
                            <td colspan="3">{{$box->cargo->sender->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver</td>
                            <td colspan="3">{{$box->cargo->receiver->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver's Address</td>
                            <td colspan="3">
                                {{$box->cargo->receiver->addresses->region->name_uz ?? ''}},
                                {{$box->cargo->receiver->addresses->district->name_uz ?? ''}},
                                {{$box->cargo->receiver->addresses->open_address}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Passport number</td>
                            <td colspan="3">{{$box->cargo->receiver->passport->passport ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver's Phone number</td>
                            <td colspan="3">
                                @foreach ($box->cargo->receiver->phones as $phone)
                                <span>{{$phone->phone ?? ''}}</span>,  
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Website</td>
                            <td colspan="3">{{ auth()->user()->branch->website ?? ''}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Cargo number</td>
                            <td colspan="3">{{ $box->cargo->number ?? ''}}</td>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">Name of Goods</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>NO</td>
                            <td>Name</td>
                            <td>Quantity / Количество</td>
                            <td>Price / Цена</td>
                            <td>Total price / Итоговая цена:</td>
                        </tr>
                        @for ($i = 1; $i < 21; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$box->products[$i-1]->item->name ?? ''}}</td>
                                <td>{{$box->products[$i-1]->count ?? ''}}</td>
                                <td>{{$box->products[$i-1]->price ?? ''}}</td>
                                <td>{{$box->products[$i-1]->total_price ?? ''}}</td>
                            </tr>
                        @endfor
                        <tr>
                            <td colspan="3"></td>
                            <td>Total / Итого:</td>
                            <td style="font-size: 30px">${{$total_price ?? 0}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<hr>
    <div class="col-12 position-relative mt-5" >
        <div class="district-bg">
            {{$box->cargo->receiver->addresses->region->name_uz ?? ''}} <br>
            {{$box->cargo->receiver->addresses->district->name_uz ?? ''}} <br>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="c-border p-3">
                    <h4>{{auth()->user()->branch->address_from ?? ''}}</h4>
                </div>
            </div>

            <div class="col-6">
                <div class="c-border p-3">
                    <h4>{{auth()->user()->branch->address_to ?? ''}}</h4>
                </div>
            </div>
            <div class="col-6 text-center mt-3 d-flex justify-content-center align-items-center">
                <h3 style="font-size: 40px; transform: scale(2.5);">INVOICE NO: <span class="text-danger">{{$box->number ?? ''}}</span></h3>
            </div>

            <div class="col-6 text-center mt-3">
                <img class="mt-3" src="{{asset($barcode)}}" alt="barcode" style="height: 250px">
            </div>

            <div class="col-md-12">
                <table class="table-c-border w-100 print-c-table">
                    <thead>
                        <tr>
                            <td colspan="2">Sender</td>
                            <td colspan="3">{{$box->cargo->sender->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver</td>
                            <td colspan="3">{{$box->cargo->receiver->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver's Address</td>
                            <td colspan="3">
                                {{$box->cargo->receiver->addresses->region->name_uz ?? ''}},
                                {{$box->cargo->receiver->addresses->district->name_uz ?? ''}},
                                {{$box->cargo->receiver->addresses->open_address}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Passport number</td>
                            <td colspan="3">{{$box->cargo->receiver->passport->passport ?? ''}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Receiver's Phone number</td>
                            <td colspan="3">
                                @foreach ($box->cargo->receiver->phones as $phone)
                                <span>{{$phone->phone ?? ''}}</span>,  
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Website</td>
                            <td colspan="3">{{ auth()->user()->branch->website ?? ''}}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Cargo number</td>
                            <td colspan="3">{{ $box->cargo->number ?? ''}}</td>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">Name of Goods</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>NO</td>
                            <td>Name</td>
                            <td>Quantity / Количество</td>
                            <td>Price / Цена</td>
                            <td>Total price / Итоговая цена:</td>
                        </tr>
                        @for ($i = 1; $i < 21; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$box->products[$i-1]->item->name ?? ''}}</td>
                                <td>{{$box->products[$i-1]->count ?? ''}}</td>
                                <td>{{$box->products[$i-1]->price ?? ''}}</td>
                                <td>{{$box->products[$i-1]->total_price ?? ''}}</td>
                            </tr>
                        @endfor
                        <tr>
                            <td colspan="3"></td>
                            <td>Total / Итого:</td>
                            <td style="font-size: 30px">${{$total_price ?? 0}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

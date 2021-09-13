<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\Models\Box;
use App\Models\Cargo;
use App\Models\Shipping;
use Gate;
class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(Gate::denies('manage-shipping'), 401);
            return $next($request);
        });
    }
    public function box(Request $request)
    {
        $box = Box::where('id',$request->id)->with(['products','cargo','cargo.receiver','cargo.sender','cargo.receiver.addresses'])->first();
        $total_price = collect($box->products)->sum('total_price');
        $total_weight = $box->total_weight;
        $barcode = $this->getBarcode($box->number);
        return view('admin.print.box',compact('barcode','box','total_price'));
    }

    public function shipping(Request $request)
    {
        $shipping = Shipping::where('id',$request->id)->with(['products','receiver','sender','receiver.addresses'])->first();
        $total_price = collect($shipping->products)->sum('total_price');
        $total_weight = $shipping->total_weight;
        $barcode = $this->getBarcode($shipping->number);
        return view('admin.print.shipping',compact('barcode','shipping','total_price'));
    }

    public function cargo(Request $request)
    {
        $cargo = Cargo::where('id',$request->id)->with(['baza','boxes','status','sender','receiver','user','branch'])->first();
        $barcode = $this->getBarcode($cargo->number);
        return view('admin.print.cargo',compact('cargo','barcode'));
    }

    public function getBarcode($number)
    {
        //Generate into customize folder under public
        $bar = App::make('BarCode');
        $barcode = [
            'text' => $number,
            'size' => 40,
            'orientation' => 'horizontal',
            'code_type' => 'code128a',
            'print' => true,
            'sizefactor' => 2,
            'filename' => 'image1.jpeg',
            'filepath' => 'barcode'
        ];
        $barcontent = $bar->barcodeFactory()->renderBarcode(
        $text=$barcode["text"],
        $size=$barcode['size'],
        $orientation=$barcode['orientation'],
        $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar
        $print=$barcode['print'],
        $sizefactor=$barcode['sizefactor'],
        $filename = $barcode['filename'],
        $filepath = $barcode['filepath']
        )->filename($barcode['filename']);

        return $barcontent.'?barcode='.rand(1111,9999);
    }
}

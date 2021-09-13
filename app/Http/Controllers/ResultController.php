<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $shipping = Shipping::where('number',$request->number)->with(['receiver','sender','logs'])->first();

        return view('result',compact('shipping'));
    }
}

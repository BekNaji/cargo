<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ChangeStatusController extends Controller
{
    public function index()
    {
        $statuses = Status::orderBy('sort','ASC')->get();
        return view('admin.changestatus.index',compact('statuses'));
    }

    public function byId(Request $request)
    {
        $ids = explode(',',$request->ids);
        foreach($ids as $id)
        {
            $shipping = Shipping::find($id);
            $shipping->status_id = $request->status_id;
            $shipping->save();
        }
        return back()->with(['message' => 'Updated']);
    }

    public function byNumber(Request $request)
    {
        
        foreach($request->numbers as $number)
        {
            $shipping = Shipping::where('number',$number)->first();

            if($shipping->count())
            {
                $shipping->status_id = $request->status_id;
                $shipping->save();
            }
        }
        
        return redirect()->route('admin.shipping.index')->with(['message' => 'Updated']);
    }
}

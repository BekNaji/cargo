<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Status,
    Branch,
    Baza,
    Category,
    Shipping
};
use App\User;
use Illuminate\Http\Request;
use Excel;
use App\Exports\ShippingsExport;

class MakeExcellController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $users = User::all();
        $bazas = Baza::all();
        $categories = Category::all();
        return view('admin.excell.index',compact('branches','statuses','users','bazas','categories'));
    }

    public function make(Request $request)
    {   
        $query = Shipping::query();
        if($request->from)
        {
            $query->where('created_at','>=',$request->from);
        }

        if($request->to)
        {
            $query->where('created_at','<=',$request->to);
        }

        if($request->status_id)
        {
            $query->where('status_id',$request->status_id);
        }

        if($request->baza_id)
        {
            $query->whereHas('baza',function($query) use ($request){
                return $query->where('id',$request->baza_id);
            });
            
        }
        if($request->user_id)
        {
            $query->whereHas('user',function($query) use ($request){
                return $query->where('id',$request->user_id);
            });
        }

        if($request->branch_id)
        {
            $query->whereHas('branch',function($query) use ($request){
                return $query->where('id',$request->branch_id);
            });
        }
        $test =$shippings = $query->with(['receiver.phones','receiver.addresses','sender.phones','sender.addresses'])->get();
        
        $array = [];
        if($request->excell_type == 'e1')
        {
            $columns = [
                'Number','Addres','Phones','KG','Price','Receivers'
            ];
    
            $array[] = $columns;
    
            foreach($shippings as $shipping)
            {
                $data = [
                    $shipping->number,
                    ($shipping->receiver->addresses->region->name_uz ?? '').PHP_EOL.
                    ($shipping->receiver->addresses->district->name_uz ?? ''),
                    collect($test[0]->receiver->phones)->implode('phone',', ') ?? '',
                    $shipping->total_weight ?? '',
                    $shipping->total_price ?? '',
                    $shipping->receiver->name ?? '',
                ];
                $array[] = $data;
            }
            $file = date('d.m.Y h:i:s',time());
        }
        
        return Excel::download(new ShippingsExport($array), $file.'.xlsx');

    }
}

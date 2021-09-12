<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use Illuminate\Http\Request;
use App\Models\{
    Branch,
    Shipping,
    Category,
    Status,
    Baza,
    SmsConfig,
    ScheduleSms,
    Product 
};




class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = session('paginate') ?? 20;

        $shippings = Shipping::orderBy('id', 'DESC')->where('is_active','active')->with(['sender', 'receiver', 'status', 'baza', 'branch', 'user'])->paginate($paginate);

        if($request->filter == 'y')
        {
            $shippings = $this->useFilter($request);
        }
        
        return view('admin.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $bazas = Baza::all();
        $smsconfigs = SmsConfig::all();
        $categories = Category::all();
        return view('admin.shipping.create', compact('statuses', 'branches','bazas','smsconfigs','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        $shipping = Shipping::orderBy('id', 'DESC')->first();
        $lastId = $shipping->id ?? 1;
        $shipping = Shipping::create([
            'number' => sprintf("SH%07s", $lastId++),
            'is_active' => 'active',
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'payment' => $request->payment,
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status_id' => $request->status_id,
            'user_id' => auth()->user()->id,
            'branch_id' => $request->branch_id,
            'baza_id' => $request->baza_id,
            'category_id' => $request->category_id,
        ]);

        foreach($request->item_name as $key => $item)
        {
            if(!empty($item) && $request->item_id[$key])
            {
                Product::create([
                    'item_id' => $request->item_id[$key] ?? '',
                    'shipping_id' => $shipping->id,
                    'count' => $request->item_count[$key] ?? '',
                    'price' => $request->item_price[$key] ?? '',
                    'total_price' =>  $request->item_total_price[$key] ?? '',
                ]);
            }
            
        }

        return redirect()->route('admin.shipping.edit', $shipping->id)->with(['message' => __('Shipping created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id)->with(['products','status','products.item','status','baza','sender','receiver','branch'])->first();
        $branches = Branch::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $bazas = Baza::all();
        $smsconfigs = SmsConfig::all();
        $categories = Category::all();
        return view('admin.shipping.edit', compact('shipping', 'branches', 'statuses','bazas','smsconfigs','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $id)
    {
        Shipping::findOrFail($id)->update([
            'is_active' => 'active',
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'payment' => $request->payment,
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status_id' => $request->status_id,
            'user_id' => auth()->user()->id,
            'branch_id' => $request->branch_id,
            'baza_id' => $request->baza_id,
            'category_id' => $request->category_id,
        ]);

        Product::where('shipping_id',$id)->delete();

        foreach($request->item_name as $key => $item)
        {
            if(!empty($item) && $request->item_id[$key] != 0)
            {
                Product::create([
                    'item_id' => $request->item_id[$key] ?? '',
                    'shipping_id' => $id,
                    'count' => $request->item_count[$key] ?? '',
                    'price' => $request->item_price[$key] ?? '',
                    'total_price' =>  $request->item_total_price[$key] ?? '',
                ]);
            }
        }

        return redirect()->route('admin.shipping.edit', $id)->with(['message' => __('Shipping updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shipping::findOrFail($id)->delete();
        return back()->with(['message'=>__('Successfully removed')]);
    }


    public function useFilter($request)
    {
        $shippings = Shipping::query();
        if($request->from)
        {
            $shippings->where('created_at','>',$request->from);
        }

        if($request->to)
        {
            $shippings->where('created_at','<',$request->to);
        }

        if($request->number)
        {
            $shippings->where('number','like','%'.$request->number.'%');
        }

        if($request->status_id)
        {
            $shippings->where('status_id',$request->status_id);
        }

        if($request->baza_id)
        {
            $shippings->whereHas('baza',function($query) use ($request){
                return $query->where('id',$request->baza_id);
            });
            
        }
        if($request->user_id)
        {
            $shippings->whereHas('user',function($query) use ($request){
                return $query->where('id',$request->user_id);
            });
        }

        if($request->branch_id)
        {
            $shippings->whereHas('branch',function($query) use ($request){
                return $query->where('id',$request->branch_id);
            });
        }

        if($request->receiver)
        {
            $shippings->whereHas('receiver',function($query) use ($request){
                return $query->where('name','like','%'.$request->receiver.'%');
            });
        }

        if($request->sender)
        {
            $shippings->whereHas('sender',function($query) use ($request){
                return $query->where('name','like','%'.$request->sender.'%');
            });
        }

        return $shippings->orderBy('id','DESC')->with(['sender', 'receiver', 'status', 'baza', 'branch', 'user'])->paginate();
    }
}

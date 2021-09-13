<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BoxRequest;
use App\Models\Box;
use App\Models\Status;
use App\Models\Cargo;
use App\Models\Category;
use App\Models\Product;
use Gate;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(Gate::denies('manage-shipping'), 401);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boxes = Box::where('is_active','active')->with(['cargo','status','cargo.receiver','cargo.sender','cargo.branch','cargo.user'])->orderBy('id','DESC')->get();
        if($request->filter == 'y')
        {
            $boxes = $this->userFilter($request);
        }
        return view('admin.box.index',compact('boxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $cargo = [];
        if($request->cargo_id)
        {
            $cargo = Cargo::findOrFail($request->cargo_id);
        }
        return view('admin.box.create',compact('statuses','cargo','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoxRequest $request)
    {
        $last = Box::where('is_active','active')->orderBy('id','DESC')->first();
        $last_id = $last->id ?? 1;
        $box = Box::create([
            'number' => sprintf('B-%07s',$last_id),
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status_id' => $request->status_id,
            'cargo_id' => $request->cargo_id,
            'category_id' => $request->category_id,
        ]);

        foreach($request->item_name as $key => $item)
        {
            if(!empty($item))
            {
                Product::create([
                    'item_id' => $request->item_id[$key] ?? '',
                    'box_id' => $box->id ?? '',
                    'count' => $request->item_count[$key] ?? '',
                    'price' => $request->item_price[$key] ?? '',
                    'total_price' =>  $request->item_total_price[$key] ?? '',
                ]);
            }
            
        }
        return redirect()->route('admin.box.edit',[$box->id,'iframe' => $request->iframe ?? ''])->with(['message'=>__('Successfully created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $box = Box::where('id',$id)->with(['products','products.item'])->first();
        $cargo = Cargo::findOrFail($box->cargo_id);
        
        return view('admin.box.edit',compact('statuses','box','cargo','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoxRequest $request, $id)
    {
        Box::findOrFail($id)->update([
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status_id' => $request->status_id,
            'cargo_id' => $request->cargo_id,
            'category_id' => $request->category_id,
        ]);

        Product::where('box_id',$id)->delete();
        
       
        foreach($request->item_name as $key => $item)
        {
            if(!empty($item))
            {
                Product::create([
                    'item_id' => $request->item_id[$key] ?? '',
                    'box_id' => $id ?? '',
                    'count' => $request->item_count[$key] ?? '',
                    'price' => $request->item_price[$key] ?? '',
                    'total_price' =>  $request->item_total_price[$key] ?? '',
                ]);
            }
            
        }

        return redirect()->route('admin.box.edit',[$id,'iframe'=>$request->iframe])->with(['message'=>__('Successfully updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Box::findOrFail($id)->delete();
        return back()->with(['message' => 'Deleted!']);
    }

    public function userFilter($request)
    {
        $boxes = Box::query();
        if($request->from)
        {
            $boxes->where('created_at','>',$request->from);
        }

        if($request->to)
        {
            $boxes->where('created_at','<',$request->to);
        }

        if($request->number)
        {
            $boxes->where('number','like','%'.$request->number.'%');
        }

        if($request->status_id)
        {
            $boxes->where('status_id',$request->status_id);
        }

        if($request->baza_id)
        {
            $boxes->whereHas('cargo.baza',function($query) use ($request){
                return $query->where('id',$request->baza_id);
            });
            
        }

        if($request->user_id)
        {
            $boxes->whereHas('cargo.user',function($query) use ($request){
                return $query->where('id',$request->user_id);
            });
            
        }
        if($request->branch_id)
        {
            $boxes->whereHas('cargo.branch',function($query) use ($request){
                return $query->where('id',$request->branch_id);
            });
        }

        if($request->receiver)
        {
            $boxes->whereHas('cargo.receiver',function($query) use ($request){
                return $query->where('name','like','%'.$request->receiver.'%');
            });
        }

        if($request->sender)
        {
            $boxes->whereHas('cargo.sender',function($query) use ($request){
                return $query->where('name','like','%'.$request->sender.'%');
            });
        }

        return $boxes->with(['cargo','status','cargo.receiver','cargo.sender','cargo.branch','cargo.user'])->orderBy('id','DESC')->get();
    }
}

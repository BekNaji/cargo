<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CargoRequest;
use App\Models\Branch;
use App\Models\Cargo;
use App\Models\Category;
use App\Models\Status;
use App\Models\Baza;
use App\Models\SmsConfig;
use Illuminate\Http\Request;
use App\Models\ScheduleSms;
use Gate;

class CargoController extends Controller
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
        $cargos = Cargo::orderBy('id', 'DESC')->with(['sender', 'receiver', 'status', 'baza', 'branch', 'user'])->get();
        if($request->filter == 'y')
        {
            $cargos = $this->useFilter($request);
        }
        
        return view('admin.cargo.index', compact('cargos'));
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
        return view('admin.cargo.create', compact('statuses', 'branches','bazas','smsconfigs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
        $cargo = Cargo::orderBy('id', 'DESC')->first();
        $lastId = $cargo->id ?? 1;
        $cargo = Cargo::create([
            'number' => sprintf("C-%07s", $lastId++),
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
            'paid' => $request->paid,
            'fee' => $request->fee
        ]);

        return redirect()->route('admin.cargo.edit', $cargo->id)->with(['message' => __('Cargo created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $branches = Branch::all();
        $statuses = Status::orderBy('sort','ASC')->get();
        $bazas = Baza::all();
        $smsconfigs = SmsConfig::all();
        return view('admin.cargo.edit', compact('cargo', 'branches', 'statuses','bazas','smsconfigs'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoRequest $request, $id)
    {
        Cargo::findOrFail($id)->update([
            'is_active' => 'active',
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'payment' => $request->payment,
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status_id' => $request->status_id,
            'branch_id' => $request->branch_id,
            'baza_id' => $request->baza_id,
            'paid' => $request->paid,
            'fee' => $request->fee
        ]);

        return redirect()->route('admin.cargo.edit', $id)->with(['message' => __('Cargo updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cargo::findOrFail($id)->delete();
        return back()->with(['message'=>__('Successfully removed')]);
    }


    public function useFilter($request)
    {
        $cargos = Cargo::query();
        if($request->from)
        {
            $cargos->where('created_at','>',$request->from);
        }

        if($request->to)
        {
            $cargos->where('created_at','<',$request->to);
        }

        if($request->number)
        {
            $cargos->where('number','like','%'.$request->number.'%');
        }

        if($request->status_id)
        {
            $cargos->where('status_id',$request->status_id);
        }

        if($request->baza_id)
        {
            $cargos->whereHas('baza',function($query) use ($request){
                return $query->where('id',$request->baza_id);
            });
            
        }
        if($request->user_id)
        {
            $cargos->whereHas('user',function($query) use ($request){
                return $query->where('id',$request->user_id);
            });
        }

        if($request->branch_id)
        {
            $cargos->whereHas('branch',function($query) use ($request){
                return $query->where('id',$request->branch_id);
            });
        }

        if($request->receiver)
        {
            $cargos->whereHas('receiver',function($query) use ($request){
                return $query->where('name','like','%'.$request->receiver.'%');
            });
        }

        if($request->sender)
        {
            $cargos->whereHas('sender',function($query) use ($request){
                return $query->where('name','like','%'.$request->sender.'%');
            });
        }

        return $cargos->orderBy('id','DESC')->with(['sender', 'receiver', 'status', 'baza', 'branch', 'user'])->paginate();
    }
}

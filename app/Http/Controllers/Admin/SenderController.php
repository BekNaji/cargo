<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SenderRequest;
use App\Models\Customer;
use App\Models\Phone;
use Illuminate\Http\Request;
use Gate;

class SenderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(Gate::denies('manage-customers'), 401);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senders = Customer::orderBy('id', 'DESC')->where('type','S')->with('phones')->paginate();
        return view('admin.sender.index', compact('senders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SenderRequest $request)
    {
        $last = Customer::orderBy('id', 'DESC')->first();

        $sender = Customer::create([
            'number' => sprintf("S-%05s", $last->id ?? 0),
            'name' => $request->name,
            'type' => 'S',
        ]);

        foreach ($request->phones as $phone) 
        {   
            $item = new Phone();
            $item->phone = $phone;
            $item->type = 'S';
            $item->code = '90';
            $item->customer_id = $sender->id;
            $item->save();
        }

        return redirect()->route('admin.sender.edit', [$sender->id,'iframe'=>$request->iframe])->with(['message' => __("Successfuly created")]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sender = Customer::where('id',$id)->where('type','S')->with('phones')->first();

        return view('admin.sender.edit', compact('sender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SenderRequest $request, $id)
    {
        $sender = Customer::findOrFail($id)->update(['name' => $request->name]);

        Phone::where('customer_id',$id)->delete();

        foreach ($request->phones as $phone) 
        {   
            $item = new Phone();
            $item->phone = $phone;
            $item->type = 'S';
            $item->code = '90';
            $item->customer_id = $id;
            $item->save();
        }
        return redirect()->route('admin.sender.edit', [$id,'iframe'=>$request->iframe])->with(['message' => __("Successfuly updated")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return back()->with(['message' => __('Successfully removed!')]);
    }
}

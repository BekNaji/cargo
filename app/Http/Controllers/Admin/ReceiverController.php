<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiverRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Phone;
use App\Models\Passport;

use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivers = Customer::orderBy('id', 'DESC')->with(['phones','passport','addresses','addresses.region','addresses.district'])->where('type','R')->paginate();
        
        return view('admin.receiver.index', compact('receivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.receiver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiverRequest $request)
    {
        $last = Customer::orderBy('id', 'DESC')->where('type','R')->first();
        $last_id = $last ? $last->id +=1 : 0;
        $receiver = Customer::create([
            'number' => sprintf("R-%05s",$last_id),
            'name' => $request->name,
            'type' => 'R',
        ]);

        Passport::create(['passport' => $request->passport,'customer_id' => $receiver->id]);

        Address::create([
            'region_id' => $request->region,
            'district_id' => $request->district,
            'customer_id' => $receiver->id,
            'open_address' => $request->open_address ?? ''
        ]);

        foreach ($request->phones as $phone) 
        {   
            $item = new Phone();
            $item->phone = $phone;
            $item->type = 'R';
            $item->code = '998';
            $item->customer_id = $receiver->id;
            $item->save();
        }

        return redirect()->route('admin.receiver.edit', [$receiver->id,'iframe'=>$request->iframe ?? ''])->with(['message' => __("Successfuly created")]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receiver = Customer::where('id',$id)->where('type','R')->with(['phones','passport','addresses'])->first();
        
        return view('admin.receiver.edit', compact('receiver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReceiverRequest $request, $id)
    {
        $receiver = Customer::findOrFail($id);
        $rec = $receiver->update(['name' => $request->name]);

        if(!$receiver->passport)
        {
            Passport::create(['passport' => $request->passport,'customer_id'=> $id]);
        }else
        {
            Passport::where('customer_id',$id)->first()->update(['passport' => $request->passport]);
        }

        Address::where('customer_id',$id)->first()->update([
            'region_id' => $request->region,
            'district_id' => $request->district,
            'customer_id' => $id,
            'open_address' => $request->open_address
        ]);

        Phone::where('customer_id',$id)->delete();

        foreach ($request->phones as $phone) 
        {   
            $item = new Phone();
            $item->phone = $phone;
            $item->type = 'R';
            $item->code = '998';
            $item->customer_id = $id;
            $item->save();
        }
        return redirect()->route('admin.receiver.edit', [$id,'iframe'=>$request->iframe ?? ''])->with(['message' => __("Successfuly updated")]);
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

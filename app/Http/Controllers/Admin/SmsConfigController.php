<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsConfig;
use Illuminate\Http\Request;
use App\Http\Requests\SmsConfigRequest;

class SmsConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smsconfigs = SmsConfig::orderBy('id','DESC')->paginate();
        return view('admin.smsconfig.index',compact('smsconfigs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smsconfig.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmsConfigRequest $request)
    {
        $smsconfig = SmsConfig::create([
            'name' => $request->name,
            'title' => $request->title,
            'login' => $request->login,
            'password' => $request->password,
            'token' => $request->token,
            'message' => $request->message,
            'module' => $request->module,
        ]);
        return redirect()->route('admin.smsconfig.edit',$smsconfig->id)->with(['message' => __("Successfuly created") ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsConfig $smsconfig)
    {
        return view('admin.smsconfig.edit',compact('smsconfig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SmsConfigRequest $request, $id)
    {
        SmsConfig::findOrFail($id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'login' => $request->login,
            'password' => $request->password,
            'token' => $request->token,
            'message' => $request->message,
            'module' => $request->module,
        ]);
        return redirect()->route('admin.smsconfig.edit',$id)->with(['message' => __("Successfuly updated") ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SmsConfig::findOrFail($id)->delete();
        return back()->with(['message' => __('Successfully removed!')]);
    }
}

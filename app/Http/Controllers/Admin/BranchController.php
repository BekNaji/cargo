<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\SmsConfig;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Gate;


class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(Gate::denies('user manage'), 401);
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
        $branches = Branch::orderBy('id','DESC')->paginate();
        return view('admin.branch.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $smsconfigs = SmsConfig::all();
        return view('admin.branch.create',compact('smsconfigs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->phone = $request->phone;
        $branch->address_from = $request->address_from;
        $branch->address_to = $request->address_to;
        $branch->website = $request->website;
        $branch->status = $request->status;
        $branch->sender_smsconfig_id = $request->sender_smsconfig_id;
        $branch->receiver_smsconfig_id = $request->receiver_smsconfig_id;
        if ($request->file('logo')) {
            $branch->logo = CFile::upload($request->logo,'/images/branch/');
        }
        $branch->save();
        return redirect()->route('admin.branch.edit',$branch->id)->with(['message' => __('Successfully created')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $smsconfigs = SmsConfig::all();
        return view('admin.branch.edit',compact('branch','smsconfigs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->name = $request->name;
        $branch->phone = $request->phone;
        $branch->status = $request->status;
        $branch->address_from = $request->address_from;
        $branch->website = $request->website;
        $branch->address_to = $request->address_to;
        $branch->sender_smsconfig_id = $request->sender_smsconfig_id;
        $branch->receiver_smsconfig_id = $request->receiver_smsconfig_id;
        if($request->file('logo')){
            CFile::delete($branch->logo);
            $branch->logo = CFile::upload($request->logo,'/images/branch/');
        }
        $branch->save();

        return redirect()->route('admin.branch.index')->with(['message'=>__('Branch Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        CFile::delete($branch->logo);
        $branch->delete();
        return redirect()->route('admin.branch.index')->with(['message' => __('Deleted')]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StatusRequest;
use App\Models\Shipping;
use Gate;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(Gate::denies('manage-configs'), 401);
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
        $statuses = Status::orderBy('sort','ASC')->paginate();

        return view('admin.status.index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        $status = Status::create([
            'name' => $request->name,
            'color' => $request->color,
            'is_send' => $request->is_send,
            'sort' => $request->sort,
            'message' => $request->message
        ]);
        return redirect()->route('admin.status.edit',$status->id)->with(['message' => __("Successfuly created") ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('admin.status.edit',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, $id)
    {
        $status = Status::findOrFail($id)->update([
            'name' => $request->name,
            'color' => $request->color,
            'is_send' => $request->is_send,
            'sort' => $request->sort,
            'message' => $request->message
        ]);
        return redirect()->route('admin.status.edit',$id)->with(['message' => __("Successfuly updated") ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $status = Status::findOrFail($id);
        if($status->shippings->count())
        {
            return back()->with(['error' => __('You can not delete, you have to delete shipping which is using this status')]);
        }
        $status->delete();
        
        return back()->with(['message' => __('Successfully removed!')]);
    }
}

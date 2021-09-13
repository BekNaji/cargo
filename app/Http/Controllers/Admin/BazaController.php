<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baza;
use Illuminate\Http\Request;
use Gate;

class BazaController extends Controller
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
        $bazas = Baza::orderBy('id','DESC')->paginate();
        return view('admin.baza.index',compact('bazas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.baza.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255|min:3|unique:bazas']);
        $baza = Baza::create(['name' => $request->name,'color' => $request->color]);
        return redirect()->route('admin.baza.edit',$baza->id)->with(['message' => __("Successfuly created") ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Baza $baza)
    {
        return view('admin.baza.edit',compact('baza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(['name' => 'required|max:255|min:3|unique:bazas,name,'.$id]);
        $baza = Baza::findOrFail($id)->update(['name' => $request->name,'color' => $request->color]);
        return redirect()->route('admin.baza.edit',$id)->with(['message' => __("Successfuly updated") ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Baza::findOrFail($id)->delete();
        return back()->with(['message' => __('Successfully removed!')]);
    }
}

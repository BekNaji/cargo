<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\User;
use Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user manage'), 401);
        $users = User::orderBy('id','DESC')->with('branch')->get();

        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user manage'), 401);
        $roles = Role::all();
        $branches = Branch::all();

        return view('admin.user.create',compact('roles','branches'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user manage'), 401);
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email'=> 'required|min:3|max:255|unique:users',
            'password' => 'min:6|max:50|confirmed',
            'password_confirmation' => 'min:6|max:50',
            'branch_id' => 'required'
        ]);

        $user = User::create($request->all());

        $user->assignRole($request->roles);

        return redirect()->route('admin.user.index')->with(['message'=>__("User Creasted")]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.user.edit',compact('user','roles','branches'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('user manage'), 401);
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email'=> 'required|email|unique:users,email,'.$id,
            'branch_id' => 'required'
        ]);

        if($request->password){
            $request->validate([
                'password' => 'min:6|max:50|confirmed', 
                'password_confirmation' => 'min:6|max:50'
            ]);
        }
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);
        $user->branch_id = $request->branch_id;
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->save();
        return redirect()->route('admin.user.index')->with(['message'=>__("User Creasted")]);
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('user manage'), 401);
        $user = User::findOrFail($id)->delete();
        return back()->with(['message' => __('User deleted successfully')]);
    }
}

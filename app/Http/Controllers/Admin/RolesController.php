<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permissions;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        Gate::authorize('show-roles');
        $roles =Roles::all();
        return view('dashboard.Roles.index',['roles' => $roles]);
    }

    public function create(){
        Gate::authorize('add-roles');
        $permissions = Permissions::all();
        return view('dashboard.Roles.create',['permissions' => $permissions]);
    }

    public function store(Request $request){
        Gate::authorize('add-roles');


        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:roles',
            'permissions' =>'required|array|not_in:0'
        ]);


        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }


        $role =Roles::create([
            'name' => $request->name,
            'display_name' => ucwords($request->name)
        ]);

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.index')->with('success','Role Created');
    }

    public function destroy($id){
        Gate::authorize('delete-roles');

        $role = Roles::find($id);

        if ($role->name != 'super_admin'){
            $role->delete();
        }

        return back()->with('success','Role Deleted');
    }

    public function edit($id){
        Gate::authorize('edit-roles');

        $role = Roles::find($id);
        $permissions = Permissions::all();
        return view('dashboard.Roles.edit',['role'=>$role,'permissions'=>$permissions]);
    }

    public function update(Request $request , $id){
        Gate::authorize('edit-roles');

        $role = Roles::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:roles,name,'.$role->id.',id',
            'permissions' =>'required|array|not_in:0'
        ]);



        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        $role->name = $request->name;
        $role->display_name = ucwords($request->name);
        $role->save();

        $role->permissions()->detach();
        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.index')->with('success','Role Updated');
    }
}

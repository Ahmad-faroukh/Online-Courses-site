<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function index(){

        Gate::authorize('show-roles');

        $roles = Roles::all();
        $count = count($roles);
        return response()->json([
            'status' => 'success',
            'count' => $count,
            'data' => $roles,
        ],200);
    }

    public function show($id){

        Gate::authorize('show-roles');

        $role = Roles::find($id);

        if (is_null($role)){
            return response()->json('record not found',404);
        }

        $permissions = $role->permissions;

        return response()->json([
            'status' => 'success',
            'data' => $role,
        ],200);
    }

    public function store(Request $request){

        Gate::authorize('add-roles');


        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:roles',
            'permissions' =>'required|array|not_in:0'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $role = new Roles();
        $role->name = $request->name;
        $role->display_name = ucwords($request->name);
        $role->save();

        $role->permissions()->attach($request->permissions);

        return response()->json('role created' , 201);
    }

    public function update(Request $request , $id){

        Gate::authorize('edit-roles');

        $role = Roles::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:roles,name,'.$role->id.',id',
            'permissions' =>'required|array|not_in:0'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $role->name = $request->name;
        $role->display_name = ucwords($request->name);
        $role->save();

        $role->permissions()->detach();
        $role->permissions()->attach($request->permissions);

        return response()->json('role updated' , 200);
    }

    public function destroy($id){

        Gate::authorize('delete-roles');

        $role = Roles::find($id);
        if (is_null($role)){
            return response()->json('record not found',404);
        }

        return response()->json('role deleted',200);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(){

        Gate::authorize('show-users');
        $users = User::all();
        $count = count($users);
        return response([
            'status' => 'success',
            'count' => $count,
            'data' => $users
        ],200);
    }

    public function show($id){

        Gate::authorize('show-users');

        $user = User::find($id);

        if (is_null($user)){
            return response()->json('user not found',404);
        }

        return response()->json($user,200);
    }

    public function store(Request $request){

        Gate::authorize('add-users');

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable','numeric']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->save();

        return response()->json('user created',201);
    }

    public function update(Request $request , $id){

        Gate::authorize('edit-users');


        $user = User::find($id);

        if (is_null($user)){
            return response()->json('user not found',404);
        }

        $validator = Validator::make($request->all(),[
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.',id'],
            'phone' => ['nullable','numeric'],
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        if ($request->name != null){
            $user->name = $request->name;
        }
        if ($request->email != null){
            $user->email = $request->email;
        }
        if ($request->phone != null){
            $user->phone = $request->phone;
        }

        $user->save();

        return response()->json('user updated',201);
    }

    public function destroy($id){

        Gate::authorize('delete-users');

        $user = User::find($id);
        if (is_null($user)){
            return response()->json('user not found',404);
        }

        if ($user->email != 'admin@app.com'){
            $user->delete();
        }


        return response()->json('user deleted',200);
    }

}

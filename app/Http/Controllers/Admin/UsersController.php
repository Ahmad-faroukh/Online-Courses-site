<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        Gate::authorize('show-users');

        $users = User::orderBy('id')->paginate(50);
        return view('dashboard.Users.index',['users' => $users]);
    }

    public function create(){
        Gate::authorize('add-users');

        return view('dashboard.Users.create');
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
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        if ($request->bio != null){
            $user->bio = $request->bio;

        }

        $user->save();

        return back()->with('success','User Created');
    }

    public function destroy($id){
        Gate::authorize('delete-users');

        $user = User::find($id);
        if ($user->email != 'admin@app.com'){
            $user->delete();
        }
        return back()->with('success','User Deleted');
    }

    public function edit($id){
        Gate::authorize('edit-users');

        $user = User::find($id);
        $roles = Roles::all();

        return view('dashboard.users.edit',['user'=>$user , 'roles'=>$roles]);
    }

    public function update(Request $request , $id){
        Gate::authorize('edit-users');


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->bio != null){
            $user->bio = $request->input('bio',false);
        }

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.',id'],
            'phone' => ['nullable','numeric'],
        ]);


        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        $user->roles()->detach();
        $user->roles()->attach($request->roles);

        $user->save();

        return redirect()->route('users.index')->with('success','User Updated');
    }

    public function export($course_id)
    {
        $course = Course::find($course_id);
        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            $users =  $course->users()->pluck('id');
            return Excel::download(new UsersExport($users), 'users.xlsx');
        }
        return redirect()->route('pages.profile')->with('info','Access Denied');
    }

    public function removeFromCourse(Request $request , $courseID){
        $course = Course::find($courseID);
        $user = $request->userID;
        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            $course->users()->detach($user);
            return back()->with('success','User Removed From Course');
        }
        return redirect()->route('pages.profile')->with('info','Access Denied');
    }
}

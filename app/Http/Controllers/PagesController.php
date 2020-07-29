<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['enroll','profile']);
    }


    public function index()
    {
        return view('home');
    }

    public function browse(){
        $courses = Course::orderBy('created_at','desc')->paginate(6);
        return view('dashboard.pages.browse',['courses' => $courses]);
    }

    public function preview($id){
        $course = Course::find($id);
        return view('dashboard.pages.details',['course'=>$course]);
    }

    public function enroll($id){
        $course = Course::find($id);
        $user = auth()->user();
        $course->users()->sync($user,false);
        return view('dashboard.pages.thank-you');
    }

    public function profile(){
        $user = auth()->user();
        return view('dashboard.pages.profile',['user'=>$user]);
    }

    public function update(Request $request , $id){

        $user = User::find($id);

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['numeric'],
            'major' => ['string'],
            'country' => ['string'],
            'avatar' => ['image','max:1999','nullable'],
        ]);


        if($request->hasfile('avatar')){
            //get the file name with the extetion(jpg,png,...)
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            //get just the filename
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get the file extention
            $extention = $request->file('avatar')->getClientOriginalExtension();

            //final file name with extention concatinated with date to make it unique
            $fileNameToStore = $fileName.'_' .time(). '.' .$extention;

            //save the image in avatars folder in storage/public/avatars
            $path = $request->file('avatar')->storeAs('public/user_avatars',$fileNameToStore);


        }else{
            $fileNameToStore = $user->avatar;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->major = $request->major;
        $user->country = $request->country;
        $user->avatar = $fileNameToStore;

        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        $user->save();

        return redirect()->route('pages.profile')->with('success','Profile Updated');

    }

}

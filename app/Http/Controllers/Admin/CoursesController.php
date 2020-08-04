<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('show-courses');

        $courses = Course::all();
        return view('dashboard.courses.index',['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('add-courses');

        $categories = Category::all();

        return view('dashboard.courses.create',['categories' =>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('add-courses');

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
            'categories' => 'array',
            'cover_image' => 'image|max:1999'
        ]);


        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        if($request->hasfile('cover_image')){
            //get the file name with the extetion(jpg,png,...)
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just the filename
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get the file extention
            $extention = $request->file('cover_image')->getClientOriginalExtension();

            //final file name with extention concatinated with date to make it unique
            $fileNameToStore = $fileName.'_' .time(). '.' .$extention;

            //save the image in cover_images folder in storage/public/cover_images
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);


        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->input('description');
        $course->duration = $request->duration;
        $course->price = $request->price;
        $course->user_id = Auth::user()->id;
        $course->image = $fileNameToStore;
        $course->save();

        $course->categories()->attach($request->categories);

        return back()->with('success','Course Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $users = $course->users;

        // only allow users or trainers to view course content and topics
        if ($course->user_id == auth()->user()->id || $users->pluck('id')->contains(auth()->user()->id)){
            return view('dashboard.courses.show',['course' => $course,'users'=>$users]);
        }
        return redirect()->route('pages.preview',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $categories = Category::all();

        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            return view('dashboard.courses.edit',['course' => $course,'categories' => $categories]);
        }
        return abort('403','Unauthorized Access');
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
        $course = Course::find($id);

        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'duration' => 'required|numeric',
                'price' => 'required|numeric',
                'categories' => 'array',
                'cover_image' => 'image|max:1999'
            ]);


            if ($validator->fails()) {
                return back()->with('info', $validator->messages()->all()[0])->withInput();
            }

            if($request->hasfile('cover_image')){
                //get the file name with the extetion(jpg,png,...)
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                //get just the filename
                $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //get the file extention
                $extention = $request->file('cover_image')->getClientOriginalExtension();

                //final file name with extention concatinated with date to make it unique
                $fileNameToStore = $fileName.'_' .time(). '.' .$extention;

                //save the image in cover_images folder in storage/public/cover_images
                $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);


            }else{
                $fileNameToStore = $course->image;
            }

            $course->title = $request->title;
            $course->description = $request->input('description');
            $course->duration = $request->duration;
            $course->price = $request->price;
            $course->user_id = Auth::user()->id;
            $course->image = $fileNameToStore;
            $course->save();
            $course->categories()->detach();
            $course->categories()->attach($request->categories);
            return redirect()->route('courses.show',$id)->with('success','Course Updated');

        }

        return abort('403','Unauthorized Access');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            $course->delete();
            return back()->with('success','Course Deleted');
        }

        return abort('403','Unauthorized Access');
    }
}

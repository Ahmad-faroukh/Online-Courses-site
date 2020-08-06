<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function index(){

        Gate::authorize('show-courses');

        $courses = Course::all();
        $count = count($courses);
        return response()->json([
            'status' => 'success',
            'count' => $count,
            'data' => $courses,
        ],200);
    }

    public function show($id){

        Gate::authorize('show-courses');

        $course = Course::find($id);

        if (is_null($course)){
            return response()->json('course not found',404);
        }

        $topics = $course->topics;

        return response()->json([
            'status' => 'success',
            'data' => $course,
        ],200);
    }

    public function store(Request $request){

        Gate::authorize('add-courses');


        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->input('description');
        $course->duration = $request->duration;
        $course->price = $request->price;
        $course->user_id =$request->user()->id;
        $course->save();

        return response()->json('course created' , 201);
    }

    public function update(Request $request , $id){

        Gate::authorize('edit-courses');

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $course = Course::find($id);
        $course->title = $request->title;
        $course->description = $request->input('description');
        $course->duration = $request->duration;
        $course->price = $request->price;
        $course->save();

        return response()->json('course updated' , 200);
    }

    public function destroy($id){

        Gate::authorize('delete-courses');

        $course = Course::find($id);
        if (is_null($course)){
            return response()->json('user not found',404);
        }

        return response()->json('course deleted',200);
    }

}

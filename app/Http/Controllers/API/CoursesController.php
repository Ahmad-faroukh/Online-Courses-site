<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function index(){
        $courses = Course::all();
        $count = count($courses);
        return response()->json([
            'status' => 'success',
            'count' => $count,
            'data' => $courses,
        ],200);
    }

    public function show($id){
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
        $course->user_id =1;
        $course->save();

        return response()->json('course created' , 201);
    }

    public function update(Request $request , $id){
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
        $course->user_id =1;
        $course->save();

        return response()->json('course updated' , 200);
    }

    public function destroy($id){
        $course = Course::find($id);
        if (is_null($course)){
            return response()->json('user not found',404);
        }

        return response()->json('course deleted',200);
    }

}

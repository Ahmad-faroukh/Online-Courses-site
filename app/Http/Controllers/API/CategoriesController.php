<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        $count = count($categories);
        return response()->json([
            'status' => 'success',
            'count' => $count,
            'data' => $categories,
        ],200);
    }

    public function show($id){
        $category = Category::find($id);

        if (is_null($category)){
            return response()->json('record not found',404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category,
        ],200);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $category = new Category();
        $category->name = ucwords($request->name);
        $category->save();

        return response()->json('category created' , 201);
    }

    public function update(Request $request , $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json('category updated' , 200);
    }

    public function destroy($id){
        $category = Course::find($id);
        if (is_null($category)){
            return response()->json('record not found',404);
        }

        return response()->json('category deleted',200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        Gate::authorize('show-categories');
        $categories = Category::all();
        return view('dashboard.Categories.index',['categories'=>$categories]);
    }

    public function create(){
        Gate::authorize('add-categories');
        return view('dashboard.Categories.create');
    }

    public function store(Request $request){
        Gate::authorize('add-categories');

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100'
        ]);


        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        $category = new Category();
        $category->name = ucwords($request->name);
        $category->save();
        return back()->with('success','Category Created');
    }

    public function edit($id){
        Gate::authorize('edit-categories');

        $category = Category::find($id);
        return view('dashboard.categories.edit',['category'=>$category]);
    }

    public function update(Request $request , $id){
        Gate::authorize('edit-categories');


        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100'
        ]);


        if ($validator->fails()) {
            return back()->with('info', $validator->messages()->all()[0])->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success','Category Updated');
    }

    public function destroy($id){
        Gate::authorize('delete-categories');

        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success','Category Deleted');
    }

}

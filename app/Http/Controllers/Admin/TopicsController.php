<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\File;
use App\Http\Controllers\Controller;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create($course_id){
        $course = Course::find($course_id);
        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            return view('dashboard.topics.create',['course_id'=>$course_id]);
        }
        return redirect()->route('pages.profile')->with('info','Access Denied');
    }

    public function store(Request $request , $course_id){
        $course = Course::find($course_id);
        if ($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:100',
                'file.*' =>'file|nullable|max:1999|mimes:jpeg,bmp,png,txt,docx,pdf,zip,xlsx,pptx'
            ]);

            if ($validator->fails()) {
                return back()->with('info', $validator->messages()->all()[0])->withInput();
            }

            $topic = new Topic();
            $topic->title = $request->input('title');
            $topic->content = $request->input('content');
            $topic->course_id = $course_id;
            $topic->save();

            if($request->hasfile('files')){
                $files = $request->file('files');

                foreach ($files as $file){
                    $fileNameWithExt = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'_' .time(). '.' .$extension;

                    $path = $file->storeAs('public/files',$fileNameToStore);

                    $file = new File();
                    $file->title = $fileNameWithExt;
                    $file->path = $fileNameToStore;
                    $file->topic_id = $topic->id;
                    $file->save();
                }

            }else{
                $fileNameToStore = '';
            }


            return redirect()->route('courses.show',$course_id)->with('success','Topic Created');
        }
        return redirect()->route('pages.profile',auth()->user()->id)->with('info','Access Denied');

    }

    public function download($fileID){
        $file = File::find($fileID);
        $path = $file->path;
        $title = $file->title;
        return response()->download('storage/files/'.$path,$title);
    }

    public function destroy($id){
        $topic = Topic::find($id);
        if ($topic->course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            foreach ($topic->files as $file){
                $file->delete();
                Storage::disk('local')->delete('public/files/'.$file->path);
            }
            $topic->delete();

            return back()->with('success','Topic Deleted');
        }
        return redirect()->route('pages.profile',auth()->user()->id)->with('info','Access Denied');

    }

    public function edit($id){
        $topic = Topic::find($id);
        if ($topic->course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){
            return view('dashboard.topics.edit',['topic' => $topic]);

        }
        return redirect()->route('pages.profile',auth()->user()->id)->with('info','Access Denied');

    }

    public function update(Request $request , $id){

        $topic =Topic::find($id);
        if ($topic->course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin')){

            $validator = Validator::make($request->all(),[
                'title' => 'required|string|max:100',
                'file.*' =>'file|nullable|max:1999|mimes:jpeg,bmp,png,txt,docx,pdf,zip,xlsx,pptx'
            ]);

            if ($validator->fails()) {
                return back()->with('info', $validator->messages()->all()[0])->withInput();
            }

            $topic->title = $request->input('title');
            $topic->content = $request->input('content');
            $topic->save();

            if($request->hasfile('files')){
                $files = $request->file('files');

                foreach ($files as $file){
                    $fileNameWithExt = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $fileName.'_' .time(). '.' .$extension;

                    $path = $file->storeAs('public/files',$fileNameToStore);

                    $file = new File();
                    $file->title = $fileNameWithExt;
                    $file->path = $fileNameToStore;
                    $file->topic_id = $topic->id;
                    $file->save();
                }

            }else{
                $fileNameToStore = '';
            }


            return redirect()->route('courses.show',$topic->course_id)->with('success','Topic Updated');
        }

        return redirect()->route('pages.profile',auth()->user()->id)->with('info','Access Denied');

    }

    public function removeFile($file){
        $file = File::find($file);
        $file->delete();
        Storage::disk('local')->delete('public/files/'.$file->path);

        return back()->with('success','File Removed');
    }
}

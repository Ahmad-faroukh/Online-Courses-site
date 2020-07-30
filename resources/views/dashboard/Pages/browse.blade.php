@extends('dashboard.app')
@section('content')
    <div class="row match-height">
    @foreach($courses as $course)
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card" >
                <div class="card-body" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between">
                    <img style="width: 100%;" class="card-img-top img-fluid" src="{{asset('storage/cover_images/'.$course->image)}}" alt="Course Image">
                    <div class="card-block">
                        <h4 class="card-title">{{$course->title}}</h4>
                        <p class="card-text">{{substr($course->description ,0,100)}} ...</p>
                        <small class="card-title">Teacher : {{$course->user->name}}</small>
                        <br>
                        <a href="{{route('pages.preview',$course->id)}}" class="btn btn-outline-secondary">Course Details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    {{$courses->links()}}
@endsection
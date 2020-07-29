@extends('dashboard.app')
@section('content')
<section id="timeline" class="timeline-left timeline-wrapper">
    <div class="card border-grey border-lighten-2">
        <div class="card-header">
            <h4 class="card-title">{{$course->title}}</h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        </div>
        <div class="card-body collapse in">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <img style="width: 100%;" class="img-fluid" src="{{asset('storage/cover_images/'.$course->image)}}" alt="Course Image">
                    </div>
                    <div class="col-lg-7 col-xs-12">
                        <h3 class="my-1">{{$course->price}} $</h3>
                        <p class="lead">Duration : {{$course->duration}} Weeks</p>
                        <p>{{$course->description}}</p>
                        <form method="POST" action="{{route('pages.enroll',$course->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Enroll Now !</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
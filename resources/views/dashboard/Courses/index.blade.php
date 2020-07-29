@extends('dashboard.app')
@section('content')
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Course Management</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                    <p>View And Manage Courses</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Course Title</th>
                            <th>Course Duration</th>
                            <th>Course Price</th>
                            <th>Course Instructor</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <th scope="row">{{$course->id}}</th>
                                <td><a href="{{route('courses.show',$course->id)}}">{{$course->title}}</a></td>
                                <td>{{$course->duration}}</td>
                                <td>{{$course->price}}</td>
                                <td>{{$course->user->name}}</td>
                                <td>
                                    <form class ="form" method="POST" action="{{route('courses.destroy',$course->id)}}">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('courses.edit',$course->id)}}" class="btn btn-warning"><i class="icon-edit"></i> Edit</a>
                                        <button onclick="return confirm('Confirm Delete ?')" type="submit" class="btn btn-danger"> <i class="icon-delete"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
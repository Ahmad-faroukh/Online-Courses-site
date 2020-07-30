@extends('dashboard.app')
@section('content')
    <div class="col-md-12">
        @if($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin'))
        <div  style="text-align: center; padding: 5px;  padding-bottom: 20px;">
            <a href="{{route('topics.create',$course->id)}}" class="btn btn-success">Add New Topic</a>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-clipboard4"></i> {{$course->title}}</h4>
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
                <div class="card-block">
                    <h5>Course Description</h5>
                    <p>{{$course->description}}</p>

                    <h5>Course Duration : {{$course->duration}} Weeks</h5>
                    <h5>Tags</h5>
                    <ul>
                        @foreach($course->categories()->pluck('name') as $category)
                            <li>{{$category}}</li>
                        @endforeach
                    </ul>
                    <h5>Course Teacher : {{$course->user->name}}</h5>
                </div>
            </div>
        </div>

        @foreach($course->topics as $topic)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-align: center;" id="basic-layout-form"> {{$topic->title}}</h4>
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
                    <div class="card-block">
                        <p>{!! $topic->content !!}</p>
                        <ul>
                        @foreach($topic->files as $file)
                            <li><a href="{{route('topics.download',$file->id)}}">{{$file->title}}</a></li>

{{--                        <a href="{{asset('storage/files/'.$topic->file)}}" target="_blank">{{$topic->file}}</a>--}}
                        @endforeach
                        </ul>
                        @if($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin'))
                            <div style="text-align: center;">
                            <form class ="form" method="POST" action="{{route('topics.destroy',$topic->id)}}">
                                @csrf
                                @method('delete')
                                <a href="{{route('topics.edit',$topic->id)}}" class="btn btn-warning"><i class="icon-edit"></i> Edit</a>
                                <button onclick="return confirm('Confirm Delete ?')" type="submit" class="btn btn-danger"><i class="icon-delete"></i> Delete</button>
                            </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if($course->user_id == auth()->user()->id || auth()->user()->roles()->pluck('name')->contains('super_admin'))
            <div class="card" style="">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Students Enrolled</h4>
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
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            <form class ="form" method="get" action="{{route('students.suspend',$course->id)}}">
                                                <input type="hidden" value="{{$user->id}}" name="userID">
                                                <button onclick="return confirm('Are you sure you want to remove student from course  ?')" type="submit" class="btn btn-danger"> Suspend</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <form method="GET" action="{{route('students.export',$course->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Download Student Information</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
@extends('dashboard.app')
@section('content')
    <div class="row match-height">
    <div class="col-lg-8 col-md-12">
        <div class="card" >
            <div class="card-header">
                <h4 class="card-title">My Profile</h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <form method="POST" action="{{route('pages.update',auth()->user()->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="major">Major</label>
                                    <input id="major" name="major" type="text" class="form-control" disabled="" placeholder="Major" value="{{$user->major}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input id="name" name="name" type="text" class="form-control" disabled="" placeholder="Name" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input id="country" name="country" type="text" class="form-control" disabled="" placeholder="Country" value="{{$user->country}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" class="form-control" disabled="" placeholder="email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input id="phone" name="phone" type="text" class="form-control" disabled="" placeholder="Phone" value="{{$user->phone}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">Profile Image</label>
                                    <label id="file" class="file center-block">
                                        <input type="file" value="{{auth()->user()->avatar}}" id="file" name="avatar">
                                        <span class="file-custom"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-4">
                                <button type="button" class="btn btn-warning" onclick="enable()"><i class="icon-edit"></i> Edit Profile</button>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <button id="save" type="submit" class="btn btn-success" hidden >Save Changes</button>
                                </div>
                                <div class="col-md-4">
                                    <button id="cancel" type="reset" onclick="disable()" class="btn btn-primary" hidden >Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body collapse in">
                <div class="card-block">
                    <img style="width: 100%; border-radius: 5px;" src="{{asset('storage/user_avatars/'.$user->avatar)}}" alt="...">
                </div>
            </div>
        </div>
    </div>
    </div>

    @canany(['edit-courses','delete-courses'])
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form-center" style="text-align: center;">Manage Courses</h4>
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
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach($user->coursesCreated as $course)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>
                                        <a href="{{route('courses.show',$course->id)}}">{{$course->title}}</a>
                                    </td>
                                    <td>
                                        <form class ="form" method="POST" action="{{route('courses.destroy',$course->id)}}">
                                            @csrf
                                            @method('delete')

                                            @can('edit-courses')
                                            <a href="{{route('courses.edit',$course->id)}}" class="btn btn-warning"><i class="icon-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete-courses')
                                            <button onclick="return confirm('Confirm Delete ?')" type="submit" class="btn btn-danger"> <i class="icon-delete"></i> Delete</button>
                                            @endcanany

                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                {{--                        <a href="{{asset('storage/files/'.$topic->file)}}" target="_blank">{{$topic->file}}</a>--}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcanany
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form-center">My Courses</h4>
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

                    <div class="list-group">
                        <span style="text-align: center; background-color: #7b807a;" class="list-group-item active">
                            Registered Courses
                        </span>
                        @foreach($user->registeredCourses as $course)
                            <a href="{{route('courses.show',$course->id)}}" class="list-group-item list-group-item-action">{{$course->title}}</a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function enable() {
            document.getElementById("phone").disabled = false;
            document.getElementById("major").disabled = false;
            document.getElementById("country").disabled = false;
            document.getElementById("name").disabled = false;
            document.getElementById("save").hidden = false;
            document.getElementById("cancel").hidden = false;
        }
        function disable() {
            document.getElementById("phone").disabled = true;
            document.getElementById("major").disabled = true;
            document.getElementById("country").disabled = true;
            document.getElementById("name").disabled = true;
            document.getElementById("save").hidden = true;
            document.getElementById("cancel").hidden = true;
        }
    </script>
@endsection
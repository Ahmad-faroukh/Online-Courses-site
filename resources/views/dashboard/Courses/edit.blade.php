@extends('dashboard.app')
@section('content')
    <div class="col-md-12">
        <div class="card" >
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Create Course</h4>
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
                    <div class="card-text">
                        <p>Create A new Course</p>
                    </div>
                    <form class="form" method="POST" action="{{route('courses.update',$course->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="icon-clipboard4"></i>Course Details</h4>

                            <div class="form-group">
                                <label for="companyName">Course Title</label>
                                <input value="{{$course->title}}" type="text" id="companyName" class="form-control" placeholder="Title" name="title">
                            </div>

                            <div class="form-group">
                                <label for="projectinput8">Course Description</label>
                                <textarea id="projectinput8" rows="5" class="form-control" name="description" placeholder="About The Course">{{$course->description}}</textarea>
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="projectinput5">Course Duration<small>(weeks)</small></label>
                                        <input value="{{$course->duration}}" type="text" id="projectinput5" class="form-control" placeholder="Duration" name="duration">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="projectinput6">Course Price</label>
                                        <input value="{{$course->price}}" type="text" id="projectinput6" class="form-control" placeholder="Price" name="price">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="file">Course Image</label>
                                <label id="file" class="file center-block">
                                    <input type="file" id="file" name="cover_image">
                                    <span class="file-custom"></span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="multiselect">Tags</label>
                                <select multiple class="form-control" id="multiselect" name ="categories[]">
                                    @foreach($categories as $category)
                                        <option {{$course->categories()->pluck('id')->contains($category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-check2"></i> Save
                            </button>

                            <button type="reset" class="btn btn-warning mr-1">
                                <i class="icon-cross2"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
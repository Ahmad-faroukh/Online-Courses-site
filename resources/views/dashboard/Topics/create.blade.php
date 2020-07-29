@extends('dashboard.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Create New Topic</h4>
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
                    <form class="form" method="POST" action="{{route('topics.store',$course_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="icon-clipboard4"></i>Topics Details</h4>

                            <div class="form-group">
                                <label for="title">Topic Title</label>
                                <input type="text" id="title" class="form-control" placeholder="Title" name="title">
                            </div>

                            <div class="form-group">
                                <label for="article-ckeditor">Topic Content</label>
                                <textarea id="article-ckeditor" rows="5" class="form-control" name="content" placeholder="Main Content"></textarea>
                            </div>

                            <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                            <script>
                                CKEDITOR.replace( 'article-ckeditor' );
                            </script>


                            <div class="form-group">
                                <label for="file">Select Multiple Files</label>
                                <label id="file" class="file center-block">
                                    <input type="file" multiple id="file" name="files[]">
                                    <span class="file-custom"></span>
                                </label>
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
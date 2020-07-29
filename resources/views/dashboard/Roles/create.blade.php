@extends('dashboard.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form-center">Add Role</h4>
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

                    <form class="form" method="POST" action="{{route('roles.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-body">

                                    <div class="form-group">
                                        <label for="eventInput1">Role Name</label>
                                        <input type="text" id="eventInput1" class="form-control" placeholder="name" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="multiselect">Permissions</label>
                                        <select multiple class="form-control" id="multiselect" name ="permissions[]">
                                            @foreach($permissions as $permission)
                                                <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-primary">
                                        <i class="icon-check2"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-warning mr-1">
                                        <i class="icon-cross2"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

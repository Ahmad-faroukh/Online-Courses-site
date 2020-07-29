@extends('dashboard.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit User</h4>
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
                        <p>Edit User Information</p>
                    </div>

                    <form class="form" method="POST" action="{{route('users.update',$user->id)}}">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="icon-head"></i> {{$user->name}}'s Info</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1">User Name</label>
                                        <input value="{{$user->name}}" type="text" id="projectinput1" class="form-control" placeholder="User Name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput2">Email</label>
                                        <input value="{{$user->email}}" type="email" id="projectinput2" class="form-control" placeholder="Email" name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">Phone Number</label>
                                        <input value="{{$user->phone}}" type="text" id="projectinput4" class="form-control" placeholder="Phone" name="phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="projectinput8">User Bio</label>
                                <textarea id="projectinput8" rows="5" class="form-control" name="bio" placeholder="Bio">{{$user->bio}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="multiselect">Roles</label>
                            <select multiple class="form-control" id="multiselect" name ="roles[]">
                                @foreach($roles as $role)
                                    <option {{$user->roles()->pluck('id')->contains($role->id) ? 'selected' : ''}}
                                            value="{{$role->id}}">
                                        {{$role->display_name}}</option>
                                @endforeach
                            </select>
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
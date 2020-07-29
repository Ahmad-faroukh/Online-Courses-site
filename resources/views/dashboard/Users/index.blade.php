@extends('dashboard.app')

@section('content')
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Management</h4>
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
                    <p>View And Manage Users</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone Number</th>
                            <th>Role</th>
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
                                    @foreach($user->roles->pluck('display_name') as $role)
                                        - {{$role}} <br>
                                    @endforeach
                                </td>

                                <td>
                                    @if($user->email != 'admin@app.com')
                                        <form class ="form" method="POST" action="{{route('users.destroy',$user->id)}}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning"> <i class="icon-edit"></i> Edit</a>
                                            <button onclick="return confirm('Confirm Delete ?')" type="submit" class="btn btn-danger"> <i class="icon-delete"></i> Delete</button>
                                        </form>
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
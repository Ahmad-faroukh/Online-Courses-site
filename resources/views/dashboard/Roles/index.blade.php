@extends('dashboard.app')

@section('content')
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Role Management</h4>
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
                    <p>View And Manage Page Roles And Permissions</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{$role->display_name}}</td>
                                <td>
                                    @foreach($role->permissions->pluck('display_name') as $permission)
                                        - {{$permission}} <br>
                                    @endforeach
                                </td>
                                <td>

                                    @can('delete-roles')
                                        @if($role->name != 'super_admin')
                                            <form class ="form" method="POST" action="{{route('roles.destroy',$role->id)}}">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning"> <i class="icon-edit"></i> Edit</a>
                                                <button onclick="return confirm('Confirm Delete ?')" type="submit" class="btn btn-danger"> <i class="icon-delete"></i> Delete</button>
                                            </form>
                                        @endif
                                    @endcan

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
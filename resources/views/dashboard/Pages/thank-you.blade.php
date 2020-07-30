@extends('dashboard.pages.homeLayout')
@section('content')
    <div class="jumbotron text-center" style="text-align: center;">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Thank You For Purchasing This Course</strong> Visit Your Profile To Check Your Newly Purchased Course</p>
        <hr>
        <p>Click The Button Below To Visit Your Profile</p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{route('pages.profile',auth()->user()->id)}}" role="button">Preview Profile</a>
        </p>
    </div>
@endsection
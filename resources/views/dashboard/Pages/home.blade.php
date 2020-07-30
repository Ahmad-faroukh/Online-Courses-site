@extends('dashboard.Pages.homeLayout')
@section('content')
    <div class="row">
        @guest
            <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-md-4">
                    <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="email" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="user-name" placeholder="Email" autocomplete="email" autofocus  required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                        <div class="form-control-position">
                            <i class="icon-head"></i>
                        </div>
                    </fieldset>
                </div>


                <div class="col-md-4">
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="user-password" placeholder="Password" >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                        <div class="form-control-position">
                            <i class="icon-key3"></i>
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Login</button>
                </div>
            </form>
        @endguest
    </div>
    <div class="jumbotron text-center" style="text-align: center;">
        <h1>Welcome To My Moodle</h1>
        <p>This is an online course management website</p>

        @guest
            <p><a class="btn btn-success btn-lg" href="{{route('login')}}" role="button">Login</a> <a class="btn btn-warning btn-lg" href="{{route('register')}}" role="button">Register</a></p>
        @endguest
        <a href="{{route('pages.browse')}}" class="btn btn-primary">Get Started</a>
    </div>

@endsection
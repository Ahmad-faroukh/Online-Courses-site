<!DOCTYPE html>

<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Online Training Center</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('app-assets/images/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('app-assets/images/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/pace.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/ui/prism.min.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END Custom CSS-->



</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="{{asset('app-assets/images/logo/robust-logo-light.png')}}" data-expand="{{asset('app-assets/images/logo/robust-logo-light.png')}}" data-collapse="{{asset('app-assets/images/logo/robust-logo-small.png')}}" class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
                </ul>
                <ul class="nav navbar-nav float-xs-right">

                    @auth
                    <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="{{asset('storage/user_avatars/'.auth()->user()->avatar)}}" alt="avatar"><i></i></span><span class="user-name">{{Auth::user()->name}}</span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a href="{{route('pages.profile')}}" class="dropdown-item"><i class="icon-head"></i> My Profile</a><a href="{{route('pages.browse')}}" class="dropdown-item"><i class="icon-book"></i> Courses</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                              <button type="submit" class="dropdown-item"><i class="icon-power3"></i> Logout</button>
                            </form>
                        </div>
                    </li>
                    @endauth

                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->


<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <!-- main menu header-->
    <div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

            @canany(['show-roles','add-roles','show-users','add-users','show-categories','add-categories','show-courses'])
            <li class=" nav-item"><a href="#"><i class="icon-cogs"></i><span data-i18n="nav.dash.main" class="menu-title">Admin Control Panel</span></a>
                <ul class="menu-content">
                    @can('show-roles')
                    <li><a href="{{route('roles.index')}}" data-i18n="nav.dash.main" class="menu-item">Manage Roles</a>
                    </li>
                    @endcan

                    @can('add-roles')
                    <li><a href="{{route('roles.create')}}" data-i18n="nav.dash.main" class="menu-item">Add a Role</a>
                    </li>
                    @endcan

                    @can('show-users')
                    <li><a href="{{route('users.index')}}" data-i18n="nav.dash.main" class="menu-item">Manage Users</a>
                    </li>
                    @endcan

                    @can('add-users')
                    <li><a href="{{route('users.create')}}" data-i18n="nav.dash.main" class="menu-item">Add New User</a>
                    </li>
                    @endcan

                    @can('show-categories')
                    <li><a href="{{route('categories.index')}}" data-i18n="nav.dash.main" class="menu-item">Manage Categories</a>
                    </li>
                    @endcan

                    @can('add-categories')
                    <li><a href="{{route('categories.create')}}" data-i18n="nav.dash.main" class="menu-item">Create Category</a>
                    </li>
                    @endcan

                    @can('show-courses')
                    <li><a href="{{route('courses.index')}}" data-i18n="nav.dash.main" class="menu-item">Manage Courses</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <li class=" nav-item"><a href="{{route('pages.profile')}}"><i class="icon-users2"></i><span data-i18n="nav.dash.main" class="menu-item">My Profile</span></a>
            </li>


            <li class=" nav-item"><a href="{{route('pages.browse')}}"><i class="icon-book"></i><span data-i18n="nav.dash.main" class="menu-title">Browse Courses</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('courses.create')}}"><i class="icon-book"></i><span data-i18n="nav.dash.main" class="menu-title">Create Courses</span></a>
            </li>

        </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
</div>

<!-- / main menu-->

<div class="app-content content container-fluid">
    <div class="content-wrapper">


        <!--Container Area -->
        @yield('content')
        @include('sweetalert::alert')



    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!--
<footer class="footer footer-static footer-dark navbar-border">
    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
</footer>
-->

<!-- BEGIN VENDOR JS-->
<script src="{{asset('app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="{{asset('app-assets/vendors/js/ui/prism.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->

</body>
</html>

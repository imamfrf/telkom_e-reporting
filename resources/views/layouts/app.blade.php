<?php
use App\User;
if (!auth()->guest()){
    $users = User::find(auth()->id());
    $admin = $users->admin;
}

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('header')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('logo/logo_telkom.png')}}" width="70" height="37">
                    e-Reporting
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest

                        @else

                            <li class="nav-item">
                                <a class="nav-link" href="/"><img src="{{asset('open-iconic/svg/home.svg')}}" width="12" height="12"> Dashboard </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/input"><img src="{{asset('open-iconic/svg/plus.svg')}}" width="12" height="12"> Input Report </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/allreports"><img src="{{asset('open-iconic/svg/spreadsheet.svg')}}" width="12" height="12"> Show All Reports </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="/changepassword">
                                        Change Password
                                    </a>

                                    @if($admin == 1)
                                        <a class="dropdown-item" href="/register">
                                            Register New User
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

<!-- Footer -->
<footer>

    <!-- Copyright -->
    <div class="text-center py-0" style="color: #3d4852"><font color="#d3d3d3">© 2019 IFF</font>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</html>

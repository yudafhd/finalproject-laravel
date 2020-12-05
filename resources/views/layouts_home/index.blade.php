<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>DPD KNPI MOJOKERTO</title>
    @include('layouts.css_section') 
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
        <header class="topheader" id="top">
            <div class="fix-width">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button
                        class="navbar-toggler navbar-toggler-right"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Logo will be here -->
                <a class="navbar-brand" href="{{Route('homes')}}" style="font-weight: bold"
                        >
                        KNPI MOJOKERTO
                    </a>
                    <!-- This is the navigation menu -->
                    <div
                        class="collapse navbar-collapse"
                        id="navbarNavDropdown"
                    >
                        <ul class="navbar-nav mr-auto stylish-nav">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{Route('visi')}}"
                                    style="font-weight: bold"
                                    >Visi & Misi</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                    class="nav-link"
                                    style="font-weight: bold"
                                    href="{{Route('contact')}}"
                                    >Contact</a
                                >
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto stylish-nav">
                            <li class="nav-item">
                                @if (auth()->user())
                                <span style="font-weight: bold;margin-right:20px">
                                    Selamat datang Admin!
                                </span>
                                <a 
                                    class="btn btn-info"
                                    href="{{Route('okp.index')}}">
                                Go to Admin
                                </a> 
                                <a
                                    class="btn btn-danger font-13 m-l-10"
                                    href="{{Route('logout')}}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();"
                                    style="width: 120px;"
                                    >Keluar</a
                                >
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                <a
                                    class="btn btn-info font-13"
                                    href="{{Route('login')}}"
                                    style="width: 120px;"
                                    >Masuk</a
                                >
                                @endif
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <img style="width: 100%" src="{{asset('assets/images/background/login-register.jpg')}}" />
        </div>
            <div class="container m-b-40" style="min-height:75vh">
                @yield('content')
            </div>
        </div>
        @include('layouts.js_section') 
        <footer class="footer container"> © {{date("Y")}} KNPI MOJOKERTO 
            <span class="float-right">
            <i class="mdi mdi-facebook"></i>
            <i class="mdi mdi-instagram"></i>
            <i class="mdi mdi-email"></i>
            </span>
        </footer>
</body>
</html>
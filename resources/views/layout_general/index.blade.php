<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('favicon.png') }}"
        />
    <title>{{ config("app.name") }}</title>
    @include('layout_general.css_javascript_section')
    <link href="{{ asset('assets/css/theme/default.css') }}" rel="stylesheet" />

</head>
@if(isset($username))
    @if(!$username)

        <body class="fix-header">
        @else

        <body class="fix-header body-for-username">
    @endif
@endif

<body class="fix-header">
    <div id="main-wrapper">
        @if(isset($username))
            @if(!$username)
                <header class="topheader" id="top">
                    <div class="fix-width">
                        <nav class="navbar navbar-expand-md navbar-light">
                            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Logo will be here -->
                            <a class="navbar-brand" href="{{ url('') }}">
                                Pinterlink
                            </a>
                            <!-- This is the navigation menu -->
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav mr-auto stylish-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="../Documentation/document.html"
                                            target="_blank">Price</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../Documentation/document.html"
                                            target="_blank">Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../Documentation/document.html"
                                            target="_blank">FAQ</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto stylish-nav">
                                    @if(!auth()->check())
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ Route('login') }}">Masuk</a>
                                        </li>
                                        <li class="nav-item">
                                            <form method="GET" action="{{ Route('register') }}">
                                                <button class="btn btn-success font-13"
                                                    style="width: 120px;">Daftar</button>
                                            </form>
                                        </li>
                                    @else
                                        {{-- <span style="margin-right: 10px"> Selamat datang </span> --}}
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ auth()->user()->name }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{ Route('general') }}"><i
                                                        class="mdi mdi-settings"></i>
                                                    Pengaturan</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                                    <i class="mdi mdi-logout m-r-5"></i>Keluar</a>
                                            </div>
                                            <form id="logout-form" action="{{ route('logout') }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>

                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </header>
            @endif
        @endif
        <div class="body-content container">
            @yield('content')
        </div>
        @if(isset($username))
            @if(!$username)
                  <footer class="footer container">
                <ul class="list-unstyled list-inline d-flex">
                    <span class="d-block  ml-auto mr-auto">
                        <li class="list-inline-item">
                            <a href="#! ">Hubungi Saya</a>
                          </li>
                        <li class="list-inline-item">
                            <a href="https://wa.me/6281357778874?text=Halo%20min%20saya%20dari%20pinterlink">Whatsapp</a>
                          </li>
                        <li class="list-inline-item">
                            <a href="#!">Terms & Condition</a>
                          </li>
                    </span>
                  </ul>
                <div class="d-flex">
                    <span class="ml-auto mr-auto">
                        ©2019 {{ config("app.name") }}
                        <a href="https://www.instagram.com/pinterusmedia/"><i class="m-l-40 mdi mdi-instagram"></i></a>
                        <a href="https://www.facebook.com/pinterusmedia"><i id="youtube" class="mdi mdi-facebook"></i></a>
                        <a href="mailto:pinterusindonesia@gmail.com"><i id="youtube" class="mdi mdi-gmail"></i></a>
                    </span>
                </div>
            </footer>
            @else
                <footer class="footer container footer-for-username">
                    Made by Love <a href="{{ url('/') }}"> Pinter.link</a>
                </footer>
            @endif
        @endif
    </div>
</body>

</html>

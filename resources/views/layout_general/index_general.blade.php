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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="fix-header body-for-general bg-white">
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
                        <a class="navbar-brand" href="{{ url('') }}">
                            Pinterlink
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
                                        href="{{ Route('general') }}"
                                        >General</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ Route('general.theme') }}"
                                        >
                                        <i class="mdi mdi-format-paint"></i>
                                        Tema</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ Route('general.dashboard') }}"
                                        >Dashboard</a
                                    >
                                </li>
                                @if (!auth()->user()->userPurchaseMapNotExpired()->first())
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ Route('account.upgrade') }}"
                                        ><span class="badge badge-success p-1">
                                            <img src="{{ asset('gold.png') }}" />
                                            Upgrade Akun</span></a
                                    >
                                </li>
                                @endif
                            </ul>
                            <ul class="navbar-nav ml-auto stylish-nav">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{auth()->user()->name}}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{Route('account')}}" >
                                        <i id="youtube" class="mdi mdi-account"></i>
                                        Akun saya</a>
                                    <a class="dropdown-item" href="{{Route('transaction')}}" >
                                        <i id="youtube" class="mdi mdi-diamond"></i>
                                        Transaksi</a>
                                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                       <i class="mdi mdi-logout"></i>
                                      Keluar</a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                  </div>
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="body-content container">
                @yield('content')
            </div>
            <footer class="footer container">
                <ul class="list-unstyled list-inline d-flex">
                    <span class="d-block  ml-auto mr-auto">
                        <li class="list-inline-item">
                            <a href="#!">Hubungi Saya</a>
                          </li>
                        <li class="list-inline-item">
                            <a href="#!">Whatsapp</a>
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
        </div>
    </body>
</html>

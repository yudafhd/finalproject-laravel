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
            href="../assets/images/favicon.png"
        />
        <title>{{ config("app.name") }}</title>
        @include('layout_general.css_section')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    @if(!$username)
    <body class="fix-header">
    @else 
    <body class="fix-header body-for-username">
    @endif
    <body class="fix-header">
        <div id="main-wrapper">
            @if (!$username)
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
                        <a class="navbar-brand" href="index.html"
                            ><img
                                src="https://s1.bukalapak.com/ast/sigil/bukalapak-logo-primary.svg"
                                alt="logo"
                            />
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
                                        href="../Documentation/document.html"
                                        target="_blank"
                                        >Price</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="../Documentation/document.html"
                                        target="_blank"
                                        >Info</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="../Documentation/document.html"
                                        target="_blank"
                                        >FAQ</a
                                    >
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto stylish-nav">
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="../Documentation/document.html"
                                        target="_blank"
                                        >Masuk</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="btn btn-info font-13"
                                        href="https://wrappixel.com/templates/adminpro/"
                                        style="width: 120px;"
                                        >Daftar</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            @endif
            
            <div class="body-content container">
                @yield('content')
            </div>
            @include('layout_general.js_section')
            @if (!$username)
                <footer class="footer container">
                    © 2019 {{ config("app.name") }}
                </footer>
            @else
            <footer class="footer container footer-for-username">
            Made by Love <a href="{{url('/')}}"> Pinter.link</a>
            </footer>
            @endif
        </div>
    </body>
</html>

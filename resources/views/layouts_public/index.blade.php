<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>{{ config('app.name') }}</title>
    @include('layouts.css_section')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
</head>
<body class="fix-header">
    <div id="main-wrapper">
        <header class="topheader" id="top">
            <div class="fix-width">
                <nav class="navbar navbar-expand-md navbar-light p-l-0">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <!-- Logo will be here -->
                    <a class="navbar-brand" href="index.html"><img src="images/logo-icon.png" alt="logo" /> <img src="images/logo-text.png" alt="logo" /></a>
                    <!-- This is the navigation menu -->
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto stylish-nav">
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Demos</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/main/index.html" target="_blank">Main</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/minisidebar/index.html" target="_blank">MiniSidebar</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/dark/index.html" target="_blank">Dark</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/horizontal/index.html" target="_blank">Horizontal</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/stylish-menu/index.html" target="_blank">Stylish Menu</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/minimal/index.html" target="_blank">Minimal</a>
                                    <a class="dropdown-item" href="https://wrappixel.com/demos/admin-templates/admin-pro/rtl/index.html" target="_blank">RTL</a>
                                </div>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="../Documentation/document.html" target="_blank">Documentation</a> </li>
                            <li class="nav-item"> <a class="m-t-5 btn btn-info font-13" href="https://wrappixel.com/templates/adminpro/" style="width:120px;">BUY NOW</a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.js_section')
        <footer class="footer"> © 2019 {{ config('app.name') }} </footer>
    </div>
</body>
</html>

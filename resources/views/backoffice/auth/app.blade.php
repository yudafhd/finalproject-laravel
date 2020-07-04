<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <title>
    {{ config('app.name', 'Laravel') }}
    </title>
    <link
      href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
    <link href="{{ asset('assets/css/pages/login-register-lock.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/colors/default-dark.css') }}" id="theme" rel="stylesheet" />    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <div id="app">
            @yield('content')
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
      $(function() {
        $(".preloader").fadeOut();
      });
      $(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
      $("#to-recover").on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
      });
    </script>
</body>
</html>

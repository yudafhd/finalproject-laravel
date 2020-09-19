@extends('general_layout.index')
@section('content')
<div class="row page-titles m-t-40">
    <div class="col-sm col-md d-flex align-items-center text-center">
        <div>
            <h1 class="text-themecolor welcome-text">Mau Link Bio Keren ?</h1>
            <form method="GET" action="{{ Route('register') }}">
                <button class="btn btn-success m-t-20" style="padding:10px !important"
                    href="https://wrappixel.com/templates/adminpro/">
                    BUAT GRATIS SEKARANG</button>
            </form><br />
            Sudah punya akun ? <a href="{{ Route('login') }}">Masuk</a>
        </div>
    </div>
    <div class="col-sm col-md d-flex m-t-20">
        {{-- <ul id="lightSlider">
            <li style="text-align: center;">
                <img width="400" src="{{ asset('assets/images/home_phone1.jpg') }}" />
            </li>
            <li style="text-align: center;">
                <img width="400" src="{{ asset('assets/images/home_phone2.jpg') }}" />
            </li>
            <li style="text-align: center;">
                <img width="400" src="{{ asset('assets/images/home_phone3.jpg') }}" />
            </li>
        </ul> --}}
        <img width="400" class="m-auto" src="{{ asset('assets/images/home_phone1.jpg') }}" />
    </div>
</div>
<div id="float-wa" style="z-index: 100;"></div>
@endsection
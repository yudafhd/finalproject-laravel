@extends('layout_general.index')
@section('content')
<div class="row page-titles m-t-40">
    <div class="col-sm col-md d-flex align-items-center text-center">
        <div>
            <h1 class="text-themecolor">MAU LINK BIO KEREN</h3>
                <h2 class="text-themecolor">KAYAK GINI ? (👍≖‿‿≖)👉</h3>
                    <form method="GET" action="{{ Route('register') }}">
                        <button class="btn btn-success m-t-20 m-b-20" href="https://wrappixel.com/templates/adminpro/">BUAT
                            GRATIS SEKARANG</button>
                    </form><br />
                    Sudah punya akun ? <a href="{{ Route('login') }}">Masuk</a>
        </div>
    </div>
    <div class="col-sm col-md d-flex align-items-center text-center">
        <img style="width: 85%" src="{{ asset('assets/images/home_phone.jpg') }}" />
    </div>
</div>
@endsection

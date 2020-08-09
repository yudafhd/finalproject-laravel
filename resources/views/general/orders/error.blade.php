@extends('general_layout.index_general') @section('content')

<div class="row m-t-40">
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body" style="text-align:center">
               <h2 class="text-danger">
                <i id="email" class="mdi mdi-close"></i> Pesanan Anda Gagal
               </h2>
               <a class="btn btn-light" href="{{ Route('general') }}">
                tekan saya untuk kembali
               </a>  
            </div>
        </div>
    </div>
</div>

@endsection

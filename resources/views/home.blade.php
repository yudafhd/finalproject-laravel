@extends('layouts_home.index')

@section('content')
<div class="container m-t-20 p-10" style="background:#1b6f6c;text-align:center">
    <span>
        <h3 style="color: white;">
            Daftar dan detail Acara 
        </h3>
    </span>
</div>
<div class="container m-t-40">
    <div class="row">
        @foreach ($kegiatans as $kegiatan )
        <div class="col-md-4">
            <div class="card">
            <div style="height:200px; background:#f3f1f1;
              background-position: center;
            background-size: 400px auto;
             background-image: url('{{ asset('storage/kegiatan/photo/'.$kegiatan->foto) }}');"></div>
            <div class="card-header" style="background-color: white !important;min-height: 150px;">
                <h3>
                   <a style="font-weight: bold; color:#67757c" href="{{ Route('detail', $kegiatan->id) }}">{{$kegiatan->judul}}</a>
                </h3>
                <span style="font-size:15px">
                    by :  
                   </span>
                    <span>
                             <a href="{{ Route('detailokp', $kegiatan->okp->id) }}"  style="font-weight:bold; font-size:14px;color:#1b6f6c"> {{$kegiatan->okp->nama}}</a>
                    </span>
            </div>
                <div class="card-body" style="min-height: 100px;">
                   {{$kegiatan->detail_kegiatan}}
                   <br />
                </div>
                  <div class="card-footer" style="font-size:14px; background:#f3f1f1; padding:10px">
                      <i class="mdi mdi-pin"></i> {{$kegiatan->tempat}}
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts_home.index')

@section('content')
<div class="container m-t-40">
        <h1>{{ $kegiatans->judul }}</h1>
        <i class="mdi mdi-pin"></i> <span>{{ $kegiatans->tempat }}</span>
        <br>
        <br>
        <br>
        <span style="font-weight:bold">Detail kegiatan :</span> <p>{{ $kegiatans->detail_kegiatan }}</p>
        <span style="font-weight:bold">Detail anggaran :</span> <p>{{ $kegiatans->detail_anggaran }}</p>
        <span style="font-weight:bold">Tujuan :</span> <p>{{ $kegiatans->sasaran }} , {{ $kegiatans->tujuan }}</p>
        <span style="font-weight:bold">Hasil :</span> <p>{{ $kegiatans->hasil }}</p>
            @if ($kegiatans->foto_acara1)
              <img src="{{asset('storage/kegiatan/acara/'.$kegiatans->foto_acara1)}}"
                                            style="width: 350px;margin-bottom: 30px;" /><br>  
            @endif
            @if ($kegiatans->foto_acara2)
              <img src="{{asset('storage/kegiatan/acara/'.$kegiatans->foto_acara2)}}"
                                            style="width: 350px;margin-bottom: 30px;" /><br>  
            @endif
            @if ($kegiatans->foto_acara3)
              <img src="{{asset('storage/kegiatan/acara/'.$kegiatans->foto_acara3)}}"
                                            style="width: 350px;margin-bottom: 30px;" /><br>  
            @endif
</div>
@endsection

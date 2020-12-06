@extends('layouts_home.index')

@section('content')
<div class="container m-t-20 p-10" style="background:#1b6f6c;text-align:center">
    <span>
        <h3 style="color: white;">
            {{$okp->nama}}
        </h3>
    </span>
</div>
<div class="container m-t-40">
    <div class="row">
        <div class="col-md-12">
            <?php // var_dump($okp) 
            ?>
            <!-- <div class="card-body"> -->
            <div class="row">
                <div class="col-md-3">
                    Tanggal Daftar <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->tanggal_daftar}}
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    No. OKP <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->no_okp}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Tanggal Berdiri <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->tanggal_berdiri}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Pendiri <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->pendiri}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Bidang <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->bidang}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Latar Belakang <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->latar_belakang}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Visi <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->visi}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Alamat <span class="float-right">:</span>
                </div>
                <div class="col-md-9" style="font-weight:bold;color:#1b6f6c">
                    {{$okp->alamat}}
                </div>
            </div>
        </div>
    </div>
    <div class="container m-t-20 m-b-20 p-10" style="background:#1b6f6c;text-align:center">
        <span>
            <h3 style="color: white;">
                Daftar Kegiatan
            </h3>
        </span>
    </div>
    <div class="row">
        @foreach ($kegiatans as $kegiatan )
        <div class="col-md-4">
            <div class="card">
                <div style="height:200px; background:#f3f1f1;
              background-position: center;
            background-size: 400px auto;
             background-image: url('{{ asset('storage/okp/photo/'.$kegiatan->foto) }}');"></div>
                <div class="card-header" style="background-color: white !important">
                    <h3>
                        <a style="font-weight: bold; color:#67757c" href="{{ Route('detail', $kegiatan->id) }}">{{$kegiatan->judul}}</a>
                    </h3>
                    <span style="font-size:15px">
                        by :
                    </span>
                    <span style="font-weight:bold; font-size:12px;color:#1b6f6c">
                        {{$kegiatan->okp->nama}}
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
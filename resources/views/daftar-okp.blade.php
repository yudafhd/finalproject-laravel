@extends('layouts_home.index')

@section('content')
<div class="container m-t-20 p-10" style="background:#1b6f6c;text-align:center">
    <span>
        <h3 style="color: white;">
            Daftar Organisasi Kepemudaan
        </h3>
    </span>
</div>
<div class="container m-t-40">
    <div class="row">
        @foreach ($okps as $okp )
        <div class="col-md-4">
            <div class="card">
                <a style="font-weight: bold; color:#67757c" href="{{ Route('detailokp', $okp->id) }}">
                    <div style="height:200px; background:#f3f1f1;
              background-position: center;
            background-size: 400px auto;
             background-image: url('{{ asset('storage/okp/file/'.$okp->foto) }}');"></div>
                    <div class="card-header" style="background-color: white !important; min-height: 150px!important">
                        <h4>
                            {{$okp->nama}}
                </a>
                </h4>
                <i class="mdi mdi-pin"></i> {{$okp->alamat}}
                <br />
                visi : {{ $okp->visi }}
                <br />
                misi : {{ $okp->misi }}
            </div>
            <div class="card-footer" style="font-size:14px; background:#f3f1f1; padding:10px">
                bidang {{$okp->bidang}}
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection
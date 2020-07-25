@extends('layouts_home.index')

@section('content')
<div class="container m-t-40">
    <div class="row">
        @foreach ($kegiatans as $kegiatan )
        <div class="col-md-4">
            <div class="card">
            <div style="height:200px; background:#f3f1f1;
              background-position: center;
            background-size: 400px auto;
             background-image: url('{{ asset('storage/kegiatan/photo/'.$kegiatan->foto) }}');"></div>
            <div class="card-header">
                <h3>
                   <a href="{{ Route('detail', $kegiatan->id) }}">{{$kegiatan->judul}}</a>
                </h3>
            </div>
                <div class="card-body">
                    <div style="font-weight: bold">
                              {{$kegiatan->okp->nama}}
                    </div>
                    <br />
                   {{$kegiatan->detail_kegiatan}}
                   <br />
                   <br />
                   <br />
                </div>
                  <div class="card-footer" style="font-size:14px; background:#f3f1f1; padding:20px">
                      <i class="mdi mdi-pin"></i> {{$kegiatan->tempat}}
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

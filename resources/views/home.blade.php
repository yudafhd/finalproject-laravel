@extends('layouts_home.index')

@section('content')
<div class="container m-t-40">
    <div class="row">
        @foreach ($kegiatans as $kegiatan )
        <div class="col-md-4">
            <div class="card">
            <img class="card-img-top" src="{{asset('storage/kegiatan/photo/'.$kegiatan->foto)}}" alt="Card image cap">
            <div class="card-header">
                <h3>
                    {{$kegiatan->okp->nama}}
                </h3>
            </div>
                <div class="card-body">
                    <div style="font-weight: bold">
                        {{$kegiatan->judul}}       
                    </div>
                    <br />
                   {{$kegiatan->detail_anggaran}}
                   <br />
                   <br />
                   <br />
                   <div style="font-size:14px;">
                    {{$kegiatan->tempat}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

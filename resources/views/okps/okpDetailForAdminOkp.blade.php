@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">okp</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body little-profile text-center">
                <div class="pro-img m-t-20">
                    @if($okps->foto)
                    <img src="{{asset('storage/okp/photo/'.$okps->foto)}}" alt="user">
                    @else
                    <img src="{{asset('assets/images/users/user.png')}}" alt="user">   
                    @endif
                    
                </div>
                <h3 class="m-b-0">{{$okps->nama}}</h3>
                <h6 class="text-muted">{{$okps->alamat}}</h6>
                <div class="list-inline soc-pro m-t-10">
                    <h6 class="text-muted"> Berdiri sejak {{$okps->tanggal_berdiri}}</h6>
                </div>
            </div>
            <div class="text-center bg-light">
                <div class="row">
                    <div class="col-6  p-20 b-r">
                    <h4 class="m-b-0 font-medium">{{count($okps->anggota)}}</h4><small>Anggota</small></div>
                    <div class="col-6  p-20">
                        <h4 class="m-b-0 font-medium">{{count($okps->kegiatan)}}</h4><small>Kegiatan</small></div>
                </div>
            </div>
            <div class="card-body text-center">
               Visi : {{$okps->visi}} Misi : {{$okps->misi}}<br>
            <span>{{$okps->latar_belakang}}</span>
            </div>
        </div>
    </div>
</div>

@endsection

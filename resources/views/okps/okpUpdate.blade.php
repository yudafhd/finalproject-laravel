@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT OKP</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">OKP</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('okp.update', $okp->id) }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{$okp->nama}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Bidang</label>
                                    <select class="form-control" name="bidang" custom-select">
                                        @foreach ($bidangs as $bidang)
                                        <option value="{{$bidang->nama}}">{{$bidang->nama}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="{{$okp->alamat}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nomer OKP</label>
                                    <input type="number" name="no_okp" class="form-control" value="{{$okp->no_okp}}">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                      <select class="form-control" name="status" custom-select">
                                        <option value="ACTIVE" {{$okp->status == 'ACTIVE' ? 'selected':null}}>ACTIVE</option>
                                        <option value="DISABLED" {{$okp->status == 'DISABLED' ? 'selected':null}}>DISABLED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Daftar</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                        value="{{$okp->tanggal_daftar}}" name="tanggal_daftar" id="mdatepicker2" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                             {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Telephone</label>
                                    <input type="text" name="telephone" class="form-control" value="{{$okp->telephone}}">
                                </div>
                            </div> --}}
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Profile</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Visi</label>
                                    <input type="text" name="visi" class="form-control" value="{{$okp->visi}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Misi</label>
                                    <input type="text" name="misi" class="form-control" value="{{$okp->misi}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Berdiri</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                        value="{{$okp->tanggal_berdiri}}" name="tanggal_berdiri" id="mdatepicker" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pendiri</label>
                                    <input type="text" name="pendiri" class="form-control" value="{{$okp->pendiri}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Latar Belakang</label>
                                    <textarea name="latar_belakang"
                                        class="form-control">{{$okp->latar_belakang}}</textarea>
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold">Okp Admin</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <small class="text-muted">Nama </small>
                                <h4>{{$okp->user->name}}</h4>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Email </small>
                                <h4>{{$okp->user->email}}</h4>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Level </small>
                                <h4>{{$okp->user->level}}</h4>
                            </div>
                        </div>
                        <!-- <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Maps</h3>
                        <hr>
                        <div class="row" style="margin-bottom:20px">
                            <div class="col-3">
                                <input type="text" placeholder="langitude" class="form-control" name="langitude"
                                    value="{{$okp->lat}}" id="langitude">
                            </div>
                            <div class="col-3">

                                <input type="text" placeholder="longitude" class="form-control" name="longitude"
                                    value="{{$okp->long}}" id="longitude">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="pac-input" class="controls" type="text" placeholder="Cari Alamat">
                                <div id="mapGoogle" style="height: 500px;"></div>
                            </div>
                        </div> -->
                        <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Foto</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="margin-top:-20px">
                                            <div style="width: 100%;">
                                                <label><small>Foto terbaru</small></label>
                                            </div>
                                            <img src="{{asset('storage/okp/file/'.$okp->foto)}}"
                                                style="width: 250px;float: left;margin-bottom: 30px;" />
                                            <input type="file" name="foto" id="input-file-now" class="dropify" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Berkas</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                    <span  style="margin-bottom:20px">
                                    <a href="{{ asset('storage/okp/file/'.$okp->berkas) }}">{{ $okp->berkas }}</a><br><br>
                                    </span>
                                        <input type="file" name="berkas" />
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-actions" style="margin-top:20px">
                        </div> <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/okp')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .dropify-wrapper .dropify-message p {
        text-align: center;
    }

</style>
@endsection

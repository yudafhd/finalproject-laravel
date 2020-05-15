@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT KEGIATAN</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Kegiatan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('kegiatan.store') }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Sasaran</label>
                                    <input type="text" name="sasaran" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tempat</label>
                                    <input type="text" name="tempat" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tujuan</label>
                                    <input type="text" name="tujuan" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Hasil</label>
                                    <input type="text" name="hasil" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Terlaksana</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                        name="tanggal_terlaksana" id="mdatepicker2" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            @if ($is_not_okp_admin)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">OKP</label>
                                    <select class="form-control" name="okp_id" custom-select">
                                        @foreach ($okps as $okp)
                                        <option value="{{$okp->id}}">{{$okp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Detail Kegiatan</label>
                                    <textarea name="detail_kegiatan" class="form-control"></textarea>
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Detail Anggaran</label>
                                    <textarea name="detail_anggaran" class="form-control"></textarea>
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title" style="font-weight: bold; margin-top: 20px;">Foto</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="card">
                                    <div class="card-body" style="text-align: center !important;">
                                        <input type="file" name="foto" id="input-file-now" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top:20px">
                        </div> <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/kegiatan')}}" class="btn btn-inverse">Cancel</a>
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

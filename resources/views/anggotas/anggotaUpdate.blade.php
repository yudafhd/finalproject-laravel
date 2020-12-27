@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT ANGGOTA</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Anggota</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('anggota.update', $anggota->id) }}" enctype="multipart/form-data"
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
                                <input type="text" name="nama" class="form-control" value="{{$anggota->nama}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Jabatan</label>
                                    <select class="form-control" name="jabatan" data-jabatan="{{$jabatans}}" custom-select>
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($jabatans as $jabatan)
                                            @if($jabatan->okp_id == Auth::user()->okp->id)
                                                <option 
                                                {{$anggota->jabatan == $jabatan->nama ? 'selected' :''}}
                                                value="{{$jabatan->nama}}" data-okp="{{$jabatan->okp_id}}">{{$jabatan->nama}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="jabatan" class="form-control" value="{{$anggota->jabatan}}"> -->
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="{{$anggota->alamat}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Masuk</label>
                                    <input type="date" class="form-control" placeholder="2017-06-04"
                                        name="tanggal_masuk" value="{{$anggota->tanggal_masuk}}" />
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            @if ($is_not_okp_admin)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">OKP</label>
                                    <select class="form-control" name="okp_id" custom-select">
                                        <option value="">Pilih OKP</option>
                                        @foreach ($okps as $okp)
                                        <option value="{{$okp->id}}"
                                            {{$anggota->okp_id == $okp->id ? 'selected' :''}} >{{$okp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status" custom-select">
                                       <option value="ACTIVE" {{ $anggota->status == 'ACTIVE' ? 'selected':null }}>ACTIVE</option>
                                       <option value="DISABLED" {{ $anggota->status == 'DISABLED' ? 'selected':null }}>DISABLED</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-right: 5px">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/anggota')}}" class="btn btn-inverse">Cancel</a>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

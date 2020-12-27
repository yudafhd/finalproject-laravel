@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">EDIT JABATAN</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Jabatan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('jabatan.update', $jabatan->id) }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Jabatan</label>
                                    <input type="text" name="nama" class="form-control" value="{{$jabatan->nama}}">
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
                        <button type="submit" class="btn btn-success" style="margin-right: 5px">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/jabatan')}}" class="btn btn-inverse">Cancel</a>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

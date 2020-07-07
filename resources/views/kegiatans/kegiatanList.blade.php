@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">KEGIATAN</h3>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if ($success_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$success_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif

                <span>
                    Total Kegiatan
                    <span class="label label-success label-rounded">{{count($kegiatans)}}</span>
                </span>
                <a href="{{Route('kegiatan.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    Buat Kegiatan
                </a>
                <a href="{{Route('kegiatan.report')}}" class="btn btn-success waves-effect waves-light m-b-20 m-r-20 float-right">
                    <i class="mdi mdi-chart"></i>
                    Download Reports
                </a>
                @if(count($kegiatans) > 0)
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tujuan</th>
                                <th>Hasil</th>
                                <th>Tempat</th>
                                <th>Tanggal Terlaksana</th>
                                <th>Nama OKP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatans as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan->judul }}</td>
                                <td>{{ $kegiatan->tujuan }}</td>
                                <td>{{ $kegiatan->hasil }}</td>
                                <td>{{ $kegiatan->tempat }}</td>
                                <td>{{ $kegiatan->tanggal_terlaksana }}</td>
                                <td>{{ $kegiatan->okp->nama }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                             <a class="dropdown-item"
                                                href="{{Route('kegiatan.edit', $kegiatan->id)}}">Lihat Detail / Update</a>
                                                <form method="POST" action="{{Route('kegiatan.destroy', $kegiatan->id)}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn"> Delete </button>
                                                </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="table-responsive m-t-10">
                    Data belum ada
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

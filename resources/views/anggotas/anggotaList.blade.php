@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">ANGGOTA</h3>
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
                    Total Anggota
                    <span class="label label-success label-rounded">{{count($anggotas)}}</span>
                </span>
                <a href="{{Route('anggota.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    Buat Anggota
                </a>
                {{-- <a href="{{Route('anggota.report')}}" class="btn btn-success waves-effect waves-light m-b-20 m-r-20 float-right">
                    <i class="mdi mdi-chart"></i>
                    Download Reports
                </a> --}}
                @if(count($anggotas) > 0)
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Tanggal Masuk</th>
                                <th>Alamat</th>
                                <th>Telephone</th>
                                <th>Nama OKP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotas as $anggota)
                            <tr>
                                <td>{{ $anggota->nama }}</td>
                                <td>{{ $anggota->jabatan }}</td>
                                <td>{{ $anggota->tanggal_masuk }}</td>
                                <td>{{ $anggota->alamat }}</td>
                                <td>{{ $anggota->phone }}</td>
                                <td>{{ $anggota->okp->nama }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                             <a class="dropdown-item"
                                                href="{{Route('anggota.edit', $anggota->id)}}">Lihat Detail / Update</a>
                                                <form method="POST" action="{{Route('anggota.destroy', $anggota->id)}}">
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

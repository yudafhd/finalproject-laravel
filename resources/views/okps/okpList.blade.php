@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">OKP</h3>
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
                    Total OKP
                    <span class="label label-success label-rounded">{{count($okps)}}</span>
                </span>
                <a href="{{Route('okp.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    Buat OKP
                </a>
                @if(count($okps) > 0)
                <div class="table-responsive m-t-10">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bidang</th>
                                <th>ALamat</th>
                                <th>Pendiri</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($okps as $okp)
                            <tr>
                                <td>{{ $okp->no_okp }}</td>
                                <td>{{ $okp->nama }}</td>
                                <td>{{ $okp->bidang }}</td>
                                <td>{{ $okp->alamat }}</td>
                                <td>{{ $okp->pendiri }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                             <a class="dropdown-item"
                                                href="{{Route('okp.edit', $okp->id)}}">Lihat Detail / Update</a>
                                                <form method="POST" action="{{Route('okp.destroy', $okp->id)}}">
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

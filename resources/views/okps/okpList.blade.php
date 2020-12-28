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
                {{-- <a href="{{Route('okp.report')}}"
                    class="btn btn-success waves-effect waves-light m-b-20 m-r-20 float-right">
                    <i class="mdi mdi-chart"></i>
                    Download Reports
                </a> --}}
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
                            @foreach ($okps as $key => $okp)
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
                                            <a class="btn" data-toggle="modal"
                                                data-target="#exampleModal{{ $key }}">Lihat Detail</a>
                                            <a class="dropdown-item" href="{{Route('okp.edit', $okp->id)}}"> Update</a>
                                            <form method="POST" action="{{Route('okp.destroy', $okp->id)}}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn"> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 40vw;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail {{ $okp->nama }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6 m-b-15" style="font-weight: bold;">No</div>
                                                <div class="col-6">{{ $okp->no_okp }}</div>
                                                <div class="col-6  m-b-15" style="font-weight: bold;">Bidang</div>
                                                <div class="col-6">{{$okp->bidang }}</div>
                                                <div class="col-6 m-b-15" style="font-weight: bold;">ALamat</div>
                                                <div class="col-6">{{ $okp->alamat }}</div>
                                                <div class="col-6 m-b-15" style="font-weight: bold;">Pendiri</div>
                                                <div class="col-6">{{ $okp->pendiri }}</div>
                                                <div class="col-6 m-b-15" style="font-weight: bold;">Telephone</div>
                                                <div class="col-6">{{ $okp->telephone }}</div>
                                                <div class="col-6 m-b-15" style="font-weight: bold;">Email Admin</div>
                                                <div class="col-6">{{ $okp->user->email }}</div>
                                                <div class="col-6 m-b-15" style="font-weight: bold;">Foto</div>
                                                <div class="col-6"><img src="{{asset('storage/okp/file/'.$okp->foto)}}"
                                                        style="width: 250px;float: left;margin-bottom: 30px;" /></div>
                                                {{-- <div class="col-6 m-b-15" style="font-weight: bold;">Berkas</div>
                                                <div class="col-6"> <span style="margin-bottom:20px">
                                                        <a
                                                            href="{{ asset('storage/okp/file/'.$okp->berkas) }}">{{ $okp->berkas }}</a><br><br>
                                                    </span></div> --}}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<!-- Link to open the modal -->

@endsection
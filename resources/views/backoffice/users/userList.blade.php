@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">USER</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('alert-success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session('alert-error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('alert-error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <span>
                    Total User
                    <span class="label label-success label-rounded">{{count($userList)}}</span>
                </span>
                <a href="{{Route('user.create')}}"
                    class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-account-plus"></i>
                    Buat
                </a>
                @if(count($userList) > 0)
                <div class="table-responsive m-t-10">
                    <table id="userTable" class="table table-sm table-striped table-borderless ">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @if ($type == "siswa")
                                <th>Nama Keluarga</th>
                                @endif
                                <th>Nomer Telepon</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Access</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                @if ($type == "siswa")
                                <td>{{ $user->parent_name }}</td>
                                @endif
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('user.update', $user->id)}}">Update & Detail</a>
                                            <a class="dropdown-item" data-toggle="modal"
                                                data-target="#exampleModalCenter"
                                                onclick="insertModalInfo({url:'{{Route('user.delete', $user->id)}}', info:'Nama : {{$user->name}} Tipe: {{$user->access_type}}'})">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div style="text-align: center;padding:20px">Belum ada data</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin akan menghapus user ini ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="delete-user" href="" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection
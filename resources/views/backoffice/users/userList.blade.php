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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-import"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Import Data</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-download"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Download Data</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                @if ($type == "guru")
                                                <th>NIP</th>
                                                @endif
                                                @if ($type == "siswa")
                                                <th>NIS</th>
                                                @endif
                                                <th>Nama</th>
                                                @if ($type == "siswa")
                                                <th>Kelas</th>
                                                <th>Nama Orang Tua</th>
                                                @endif
                                                <th>Nomer Telepon</th>
                                                <th>Address</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userList as $user)
                                            <tr>
                                                @if ($type == "guru")
                                                <td>{{ $user->nip }}</td>
                                                @endif
                                                @if ($type == "siswa")
                                                <td>{{ $user->nis }}</td>
                                                @endif
                                                <td>{{ $user->name }}</td>
                                                @if ($type == "siswa")
                                                <td>{{ $user->kelas->grade }} - {{ $user->kelas->majors }} {{
                                                    $user->kelas->number }}</td>
                                                <td>{{ $user->parent_name }}</td>
                                                @endif
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>
                                                    <div class="dropdown" style="float: right">
                                                        <button
                                                            class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            aksi
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{Route('user.update', $user->id)}}">Update &
                                                                Detail</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#exampleModalCenter"
                                                                onclick="insertModalInfo({url:'{{Route('user.delete', $user->id)}}', info:'Nama : {{$user->name}} Tipe: {{$user->type}}'})">Delete</a>
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
                    <div class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <form class="form" method="POST" action="{{ Route('user.import') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                       @if($type=='siswa')
                                       <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Kelas</label>
                                            <select class="selectize_custom" name="kelas_id">
                                                <option value="">Pilih kelas</option>
                                                @foreach ($classes as $class)
                                                <option value="{{$class->id}}">{{$class->grade}} -
                                                    {{$class->majors}} {{$class->number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                       @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">File</label>
                                                <input type="file" name="file_excel" class="form-control-file" />
                                                <input type="hidden" name="type" value="{{ $type }}" />
                                                <small> Mohon mempersiapkan file seperti yang sudah ditentukan oleh
                                                    operator / developer </small>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-download" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ Route('user.export', ['type'=>$type]) }}" class="btn btn-primary">Download
                                    Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
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
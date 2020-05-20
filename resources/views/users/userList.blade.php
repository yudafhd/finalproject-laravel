@extends('layouts.index') @section('content')
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
                @if ($success_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$success_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                <a href="{{Route('user.create')}}" class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-account-plus"></i>
                    Buat
                </a>
                @if(count($userList) > 0)
                <div class="table-responsive m-t-10">
                    <table
                        id="myTable"
                        class="table"
                    >
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{Route('user.update', $user->id)}}">Update</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" 
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
                <div style="text-align: center;padding:20px">Belum ada data user</div>
                @endif
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

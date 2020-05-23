@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">PERMISSIONS</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Permissions</li>
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
                    Total Permissions
                    <span class="label label-success label-rounded">{{count($permissions)}}</span>
                </span>
                <a href="{{Route('permission.create')}}"
                    class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-account-plus"></i>
                    Buat
                </a>
                @if(count($permissions) > 0)
                <div class="table-responsive m-t-10">
                    <table id="treetable" class="table">
                        <thead>
                            <tr>
                                <th>Nama Permission</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            @if ($permission->parent_id == NULL)
                            <tr data-tt-id="{{$permission->id}}">
                                @else
                                <tr data-tt-id="{{$permission->id}}" data-tt-parent-id="{{$permission->parent_id}}">
                            @endif
                                    @if ($permission->parent_id == NULL)
                                    <td style="font-weight: bold">{{ $permission->name }}</td>
                                    @else
                                    <td>{{ $permission->name }}</td>
                                    @endif
                                <td>
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{Route('permission.delete', $permission->name)}}">Delete</a>
                                            <a class="dropdown-item"
                                                href="{{Route('permission.update', $permission->id)}}">Update</a>
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
                    Permission belum ada
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

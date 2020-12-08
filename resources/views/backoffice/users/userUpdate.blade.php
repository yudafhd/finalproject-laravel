@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">USER UPDATE</h3>
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
@if($isHasGeneral)
<form method="POST" action="{{ Route('user.store.update') }}" enctype="multipart/form-data">
    @endif
    @if(!$isHasGeneral)
    <form method="POST" action="{{ Route('user.store.update') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            @if($userDetail->photo)
                            <img class="img-fluid rounded-circle"
                                src="{{ Url('storage/user/profile/'. $userDetail->photo) }}" />
                            @else
                            <img src="{{ asset('assets/images/users/user.png') }}" class="img-circle" width="150">
                            @endif
                            <h4 class="card-title m-t-10">{{ $userDetail->name }} ({{ $userDetail->type }})</h4>
                            <h6 class="card-subtitle">{{'@' . $userDetail->username }}</h6>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Email </small>
                        <h6>{{ $userDetail->email }}</h6>
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6> {{ $userDetail->phone_number }}</h6>
                        <br>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                    </div>
                </div>
            </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control" value="{{$userDetail->id}}">
                            <div class="form-body">
                                <h3 class="card-title" style="font-weight: bold">Personal Info</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{$userDetail->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="email" class="form-control"
                                                value="{{$userDetail->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{$userDetail->username}}">
                                        </div>
                                    </div>
                                    @if ($userDetail->type == "guru")
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nip</label>
                                            <input type="text" name="nip" class="form-control"
                                                value="{{$userDetail->nip}}">
                                        </div>
                                    </div>
                                    @endif
                                    @if ($userDetail->type == "siswa")
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nis</label>
                                            <input type="text" name="nis" class="form-control"
                                                value="{{$userDetail->nis}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Nama Keluarga</label>
                                            <input type="text" name="parent_name" class="form-control"
                                                value="{{$userDetail->parent_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Kelas</label>
                                            <select class="form-control" name="kelas_id" custom-select">
                                                @foreach ($kelas as $class)
                                                <option value="{{$class->id}}"
                                                    {{$userDetail->kelas_id == $class->id ? 'selected': ''}}
                                                    >{{$class->grade}} - {{$class->majors}} {{$class->number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{$userDetail->phone_number}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <input id="mdatepicker" name="dob" class="form-control" 
                                            value="{{ $userDetail->dob }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Alamat</label>
                                            <textarea id="mdatepicker" name="address" class="form-control">{{ $userDetail->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Info Singkat</label>
                                            <textarea id="mdatepicker" name="short_info" class="form-control">{{ $userDetail->short_info }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Type
                                                <small class="form-control-feedback"> user ini sekarang
                                                    <strong>
                                                        {{$userDetail->type}}
                                                    </strong>
                                                </small>
                                            </label>
                                            <select class="form-control" name="type" custom-select">
                                                @foreach ($roles as $role)
                                                <option value="{{$role->name}}"
                                                    {{$userDetail->type == $role->name ? 'selected' :''}}>
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Password </label>
                                            <input type="text" name="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">FCM </label>
                                            {{ $userDetail->notification_token }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width:100%;text-align:right;margin-right:1rem">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    <button onclick="goBack()" class="btn btn-info text-white m-l-10">Cancel</button>
                </div>
                
        </div>
        </form>
    @endsection
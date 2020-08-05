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
<form method="POST" action="{{ Route('admin.user.general.store.update') }}" enctype="multipart/form-data">
    @endif
    @if(!$isHasGeneral)
    <form method="POST" action="{{ Route('admin.user.store.update') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="row">
            @if(!$isHasGeneral)
            <div class="col-lg-12">
                @else
                <div class="col-lg-6">
                    @endif
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{$userDetail->phone_number}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Type
                                                <small class="form-control-feedback"> user ini sekarang
                                                    <strong>
                                                        {{$userDetail->access_type}}
                                                    </strong>
                                                </small>
                                            </label>
                                            @if(!$isHasGeneral)
                                            <select class="form-control" name="access_type" custom-select">
                                                @foreach ($roles as $role)
                                                <option value="{{$role->name}}"
                                                    {{$userDetail->access_type == $role->name ? 'selected' :''}}>
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Password </label>
                                            <input type="text" name="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    @if(!$isHasGeneral)
                                    <div class="col-lg-12 col-md-12 m-b-20">
                                        <input type="file" name="foto" id="input-file-now" class="dropify" />
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        @if(!$isHasGeneral)
                                        @if($userDetail->photo)
                                        <img class="img-fluid"
                                            src="{{ Url('storage/admin/profile/'. $userDetail->photo) }}" />
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($isHasGeneral)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30">
                                @if($userDetail->general->photo)
                                <img class="img-fluid rounded-circle"
                                    src="{{ Url('storage/user/profile/'. $userDetail->general->photo) }}" />
                                @else
                                <img src="{{ asset('assets/images/users/user.png') }}" class="img-circle" width="150">
                                @endif
                                <h4 class="card-title m-t-10">{{ $userDetail->name }}</h4>
                                <h6 class="card-subtitle">{{'@' . $userDetail->username }}</h6>
                                <!-- <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                        <font class="font-medium">254</font>
                                    </a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                            class="icon-picture"></i>
                                        <font class="font-medium">54</font>
                                    </a></div>
                            </div> -->
                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <small class="text-muted">Membership </small>
                            <h6>hannagover@gmail.com</h6>
                            <small class="text-muted p-t-30 db">Phone</small>
                            <h6>+91 654 784 547</h6>
                            <br>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-actions m-l-15">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                </div>
    </form>
                    <button onclick="goBack()" class="btn btn-info text-white m-l-10">Cancel</button>

    @endsection
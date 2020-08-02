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
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> 
                    @if (auth()->user()->image_url)
                    <img src="{{Url('user/profile/'.auth()->user()->image_url)}}"
                    class="img-circle" width="150" />
                    @else                        
                    <img src="{{Url('assets/images/users/user.png')}}" class="img-circle" width="150" />
                    @endif
                <h4 class="card-title m-t-10">{{auth()->user()->name}}</h4>
                    <h6 class="card-subtitle">{{auth()->user()->access_type}}</h6>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <small class="text-muted">Tanggal Daftar </small>
                <h6>{{auth()->user()->date_register}}</h6> 
                <small class="text-muted">Email address </small>
                <h6>{{auth()->user()->email}}</h6> 
                <small class="text-muted">Address</small>
                <h6>{{auth()->user()->address}}</h6>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="settings" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="POST" enctype="multipart/form-data"
                        action="{{ Route('user.store.update.profile') }}">
                                @csrf
                            <input type="hidden" name="id" value="{{auth()->user()->id}}">
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                <input name="name" type="text" value="{{auth()->user()->name}}" placeholder="Johnathan Doe" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input name="email" type="email" value="{{auth()->user()->email}}" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input name="password" type="password" value="" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <input name="address" type="text" value="{{auth()->user()->address}}" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Profile Image</label>
                                <div class="col-md-12">
                                    <input type="file" name="foto"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

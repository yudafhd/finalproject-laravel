@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">USER EDIT</h3>
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
    <div class="col-lg-12">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Other Sample form</h4>
            </div> --}}
            <div class="card-body">
                <form method="POST" action="{{ Route('user.store.update') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{$userDetail->id}}">
                    <div class="form-body">
                        <h3 class="card-title">Person Info</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$userDetail->name}}" placeholder="Anggi Kinata">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{$userDetail->email}}"
                                        placeholder="@gmail.com">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label">Type <small class="form-control-feedback"> user ini sekarang <strong>{{$userDetail->type}}</strong></small></label>
                                    @if($userDetail->type=='admin_default')
                                    <br /> <small class="form-control-feedback">Kamu tidak dapat mengganti tipe <strong>admin_default</strong> </small> </div>
                                    @else
                                    <select class="form-control" name="type_user" custom-select">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label class="control-label">Date of Birth</label>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy">
                                </div> --}}
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select class="form-control custom-select" data-placeholder="Choose a Category"
                                        tabindex="1">
                                        <option value="Category 1">Category 1</option>
                                        <option value="Category 2">Category 2</option>
                                        <option value="Category 3">Category 5</option>
                                        <option value="Category 4">Category 4</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Membership</label>
                                    <div class="m-b-10">
                                        <label class="custom-control custom-radio">
                                            <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                            <span class="custom-control-label">Free</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                            <span class="custom-control-label">Paid</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div> --}}
                        <!--/row-->
                        {{-- <h3 class="box-title m-t-40">Address</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                        </div> --}}
                        <!--/row-->
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Post Code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control custom-select">
                                        <option>--Select your Country--</option>
                                        <option>India</option>
                                        <option>Sri Lanka</option>
                                        <option>USA</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div> --}}
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    <a href="{{url('/user/admin')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
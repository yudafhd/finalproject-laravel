@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">USER CREATE</h3>
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
            <div class="card-body">
                <form method="POST" action="{{ Route('admin.user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" name="username" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="form-control" name="access_type" custom-select">
                                        @foreach ($roles as $role)
                                        @if($role->name != 'general')
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label p-t-20">Password default: <span
                                            class="badge badge-info">adminadmin</span></label>
                                </div>
                            </div>
                                {{-- <div class="col-lg-6 col-md-6 m-b-20">
                                    <input type="file" name="foto" id="input-file-now" class="dropify" />
                            </div> --}}
                            
                    </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a href="{{Route('admin.user.list', 'admin')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

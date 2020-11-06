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
            <div class="card-body">
                <form method="POST" action="{{ Route('user.store') }}" enctype="multipart/form-data">
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
                                    <select class="form-control custom-select" name="type" id="type-select">
                                        @foreach ($roles as $role)
                                        @if($role->name != 'general')
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 nip" style="display:none;">
                                <div class="form-group">
                                    <label class="control-label">Nip</label>
                                    <input type="number" name="nip" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6 nis" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Nis</label>
                                    <input type="number" name="nis" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6 nama-keluarga" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Nama Keluarga</label>
                                    <input type="text" name="parent_name" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input id="mdatepicker" name="dob" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No. Telepon</label>
                                    <input type="number" name="phone_number" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Info Singkat</label>
                                    <textarea name="short_info" class="form-control" ></textarea>
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <textarea name="address" class="form-control" ></textarea>
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label p-t-20">Password default: <span
                                            class="badge badge-info">adminadmin</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a href="{{Route('user.list', 'admin')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $("#type-select").change(function() {
            console.log($(this).val());
            let type_user = $(this).val();
            if(type_user == "admin") {
                $(".nis").hide();
                $(".nip").hide();
                $(".nama-keluarga").hide();
            }
            if(type_user == "siswa") {
                $(".nis").show();
                $(".nip").hide();
                $(".nama-keluarga").show();
            }
            if(type_user == "guru") {
                $(".nis").hide();
                $(".nip").show();
                $(".nama-keluarga").hide();
            }
        });
    });
</script>
@endsection

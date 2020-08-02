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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ Route('user.store.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control" value="{{$userDetail->id}}">
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{$userDetail->name}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$userDetail->email}}">
                                    {{-- <small class="form-control-feedback"> This field has error. </small>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Type <small class="form-control-feedback"> user ini
                                            sekarang <strong> {{$userDetail->access_type == 'rpk' ? 'ewarong' : $userDetail->access_type}}</strong></small></label>
                                    @if($userDetail->type=='admin_default')
                                    <br /> <small class="form-control-feedback">Kamu tidak dapat mengganti tipe
                                        <strong>admin_default</strong> </small>
                                    @else
                                    <select class="form-control" name="access_type" custom-select">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}"
                                            {{$userDetail->access_type == $role->name ? 'selected' :''}}>
                                                 {{$role->name== 'rpk' ? 'ewarong' : $role->name}}
                                                
                                        </option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Daftar</label>
                                    <input type="text" class="form-control" placeholder="2017-06-04" name="date_register"
                                        value="{{$userDetail->date_register}}" id="mdatepicker" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kecamatan</label>
                                    <select class="form-control" name="district_id" custom-select">
                                        @foreach ($districts as $district)
                                        <option value="{{$district->id}}"
                                            {{$userDetail->district_id == $district->id ? 'selected': null}}
                                            >{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Desa</label>
                                    <select class="form-control" name="village_id" custom-select">
                                        @foreach ($villages as $village)
                                        <option value="{{$village->id}}"
                                            {{$userDetail->village_id == $village->id ? 'selected': null}}
                                            >{{$village->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{$userDetail->address}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password </label>
                                    <input type="text" name="password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 m-b-20">
                                <input type="file" name="foto" id="input-file-now" class="dropify" />
                        </div>
                        <div class="col-md-6">
                        <img src="{{Url('user/profile/'.$userDetail->image_url)}}"
                            style="width: 250px;float: left;margin-bottom: 30px;" />
                        </div>
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

@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h2 class="text-themecolor">CREATE ROLES</h2>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Role</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
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

                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('role.store') }}">
                        @csrf
                        <h3 class="card-title">Info</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationServer01">Nama Role</label>
                                <input type="text" name="name" class="form-control" placeholder="example edit user"
                                    required>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="control-label">Guard Name</label>
                                    <select class="form-control" name="guard_name" custom-select">
                                        <option value="web">web</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <h3 class="card-title">Permission</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <ul class="icheck-list" style="list-style-type: none; margin-left:-20px">
                                    @foreach ( $permissions as $key => $permission )
                                    <li>

                                        <input name="permissions_check[]" value="{{$permission->name}}" type="checkbox"
                                            class="check" id="square-checkbox-{{$key}}"
                                            data-checkbox="icheckbox_square-red">
                                        <label for="square-checkbox-{{$key}}">{{$permission->name}}</label>
                                    </li>
                                    @endforeach

                                    {{-- <li>
                                        <input type="checkbox" class="check" id="minimal-checkbox-2" checked>
                                        <label for="minimal-checkbox-2">Checkbox 2</label>
                                    </li> --}}

                                </ul>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a href="{{Route('role.list')}}" class="btn btn-inverse">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
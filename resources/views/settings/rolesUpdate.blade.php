@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h2 class="text-themecolor">UPDATE ROLES</h2>
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

                <div>
                    <a href="{{Route('role.list')}}" class="btn btn-primary waves-effect waves-light m-b-20">
                        <i class="mdi mdi-keyboard-backspace"></i>
                        BACK
                    </a>
                </div>

                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('role.store.update') }}">
                        @csrf
                        <h3 class="card-title">Info</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationServer01">Nama Role</label>
                                <input type="hidden" name="id" value="{{$roles->id}}" />
                                <input type="text" name="name" value="{{$roles->name}}" class="form-control" placeholder="Contoh : edit user"
                                    required>
                                {{-- <div class="valid-feedback">
                                Looks good!
                              </div> --}}
                            </div>
                        </div>
                        <h3 class="card-title">Permissions</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <ul class="icheck-list" style="list-style-type: none; margin-left:-20px">
                                            @foreach ( $permissions as $key => $permission )
                                            <li>
                                            
                                            <input name="permissions_check[]" 
                                            value="{{$permission->name}}" 
                                            type="checkbox" 
                                            class="check" 
                                            id="square-checkbox-{{$key}}" 
                                            data-checkbox="icheckbox_square-red"
                                            {{in_array($permission->name, $rolesPermission) === true ? 'checked' : ''}}
                                            >
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
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.index') @section('content')
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

                <div>
                    <a href="{{Route('role.list')}}" class="btn btn-primary waves-effect waves-light m-b-20">
                        <i class="mdi mdi-keyboard-backspace"></i>
                        BACK
                    </a>
                </div>

                @if ($error_message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$error_message}}
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
                                <input type="text" name="name" class="form-control" placeholder="Contoh : edit user"
                                    required>
                                {{-- <div class="valid-feedback">
                                Looks good!
                              </div> --}}
                            </div>
                        </div>
                        <h3 class="card-title">Permission</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <ul class="icheck-list" style="list-style-type: none; margin-left:-20px">
                                    @foreach ( $permissions as $key => $permission )
                                    <li>
                                    
                                    <input name="permissions_check[]" 
                                    value="{{$permission->name}}" 
                                    type="checkbox" 
                                    class="check" 
                                    id="square-checkbox-{{$key}}" 
                                    data-checkbox="icheckbox_square-red"
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
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

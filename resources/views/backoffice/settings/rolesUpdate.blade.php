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
                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('role.store.update') }}">
                        @csrf
                        <h3 class="card-title">Info</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationServer01">Nama Role</label>
                                <input type="hidden" name="id" value="{{$roles->id}}" />
                                <input type="text" name="name" value="{{$roles->name}}" class="form-control"
                                    placeholder="Contoh : edit user" required>
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
                                        <div class="table-responsive m-t-10">
                                            <table id="treetable" class="table">
                                                @foreach ( $permissions as $key => $permission )
                                                @if ($permission->parent_id == NULL)
                                                <tr data-tt-id="{{$permission->id}}">
                                                    @else
                                                <tr data-tt-id="{{$permission->id}}"
                                                    data-tt-parent-id="{{$permission->parent_id}}">
                                                    @endif
                                                    <td>
                                                        <input name="permissions_check[]" value="{{$permission->name}}"
                                                            type="checkbox" class="check" id="square-checkbox-{{$key}}"
                                                            data-checkbox="icheckbox_square-red"
                                                            {{in_array($permission->name, $rolesPermission) === true ? 'checked' : ''}}>
                                                        <label
                                                            for="square-checkbox-{{$key}}">{{$permission->name}}</label>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

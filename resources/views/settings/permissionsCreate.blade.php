@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h2 class="text-themecolor">BUAT PERMISSION</h2>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Permission</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($error_message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$error_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif


                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('permission.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label>Nama Permission</label>
                                <input type="text" name="name" class="form-control" placeholder="Contoh : melihat data user"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Parent</label>
                                    <select class="form-control" name="parent_id" custom-select">
                                        <option value="">Pilih parent permission</option>
                                        @foreach ($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
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

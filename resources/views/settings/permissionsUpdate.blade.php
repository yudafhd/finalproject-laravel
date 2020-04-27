@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h2 class="text-themecolor">UPDATE PERMISSIONS</h2>
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

                <div class=" m-t-10">
                    <form method="POST" action="{{ Route('permission.store.update') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationServer01">Nama Permission</label>
                                <input type="hidden" name="id" value="{{$permissions->id}}" />
                                <input type="text" name="name" value="{{$permissions->name}}" class="form-control" placeholder="Contoh : admin"
                                    required>
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

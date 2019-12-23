@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">PAKET EDIT</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('package.index') }}">Paket</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form
                        method="POST"
                        action="{{ Route('package.update', $package->id) }}"
                    >
                        @csrf @method('PUT')
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{$package->name}}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input
                            type="text"
                            name="price"
                            class="form-control"
                            value="{{$package->price}}"
                        />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <textarea
                                class="textarea_editor form-control"
                                name="description"
                                placeholder="isi informasi produk"
                            >{{$package->description}}</textarea>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success waves-effect waves-light m-r-10"
                        >
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

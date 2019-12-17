@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">PAKET CREATE</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('package.index') }}">Paket</a>
            </li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{ Route('package.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="ex: PAKET HEMAT"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input
                            type="text"
                            name="price"
                            class="form-control"
                            placeholder="ex: 100.0000"
                        />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <textarea
                                class="form-control"
                                name="description"
                                placeholder="isi informasi produk"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success waves-effect waves-light m-r-10"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

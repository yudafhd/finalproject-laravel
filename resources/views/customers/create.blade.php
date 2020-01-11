@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">CUSTOMERS CREATE</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('customers.index') }}">Customers</a>
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
                    <form method="POST" action="{{ Route('customers.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID customers</label>
                            <input
                                type="text"
                                name="id_customer"
                                class="form-control"
                                id="exampleInputEmail1"
                                placeholder="ex: 784HHDIUU345"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="exampleInputEmail1"
                                placeholder="ex: michael"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea
                                class="form-control"
                                name="address"
                                placeholder="Jln. xxxxxxx"
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. HP</label>
                            <input
                                class="form-control"
                                name="phone"
                                placeholder="ex: 085xxxxxxx"
                            />
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

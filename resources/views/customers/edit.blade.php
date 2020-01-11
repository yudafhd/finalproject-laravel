@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">CUSTOMERS EDIT</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('customers.index') }}">Customers</a>
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
                        action="{{ Route('customers.update', $customer->id) }}"
                    >
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{$customer->name}}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea
                                class="form-control"
                                name="address"
                                placeholder="Jln. xxxxxxx"
                                >{{$customer->address}}</textarea
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Phone</label>
                            <input
                                class="form-control"
                                name="phone"
                                placeholder="ex: 085xxxxxxx"
                                value="{{$customer->phone}}"
                            />
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

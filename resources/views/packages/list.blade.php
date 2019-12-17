@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">PAKET</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Paket</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-10">
                    <table
                        id="myTable"
                        class="table table-bordered table-striped"
                    >
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->description }}</td>
                                <td>
                                    <form
                                        action="{{ route('package.destroy',$package->id) }}"
                                        method="POST"
                                    >
                                        <a
                                            class="btn btn-info"
                                            href="{{ Route('package.edit',$package->id) }}"
                                            >Edit</a
                                        >

                                        @csrf @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">CUSTOMERS</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Customers</li>
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
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customerList as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    <form
                                        action="{{ route('customers.destroy',$customer->id) }}"
                                        method="POST"
                                    >
                                        <a
                                            class="btn btn-info"
                                            href="{{ Route('customers.edit',$customer->id) }}"
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
                            @empty
                            <p>No Customer</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

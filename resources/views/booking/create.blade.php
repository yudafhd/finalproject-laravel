@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BOOKING CREATE</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('booking.index') }}">Booking</a>
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
                    <form method="POST" action="{{ Route('booking.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Tanggal Booking</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                placeholder="2017-06-04"
                                name="booking_date"
                                id="mdate"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jam Mulai</label>
                            <input
                                class="form-control"
                                name="start_time_at"
                                placeholder="Check time"
                                id="timepicker"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Customer</label>
                            <select
                                class="select2 form-control custom-select"
                                style="width: 100%; height: 150px;"
                                name="customer_id"
                            >
                                <option>Select</option>
                                @forelse ($customerList as $customer)
                                <option
                                    value="{{$customer->id}}"
                                    >{{$customer->name}}</option
                                >
                                @empty
                                <p>No Customer</p>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Paket Booking</label
                            >
                            <select
                                class="select2 form-control custom-select"
                                style="width: 100%; height: 150px;"
                                name="booking_package_id"
                            >
                                <option>Select</option>
                                @forelse ($packageList as $package)
                                <option
                                    value="{{$package->id}}"
                                    >{{$package->name}}</option
                                >
                                @empty
                                <p>No Customer</p>
                                @endforelse
                            </select>
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

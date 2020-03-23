@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BOOKING GAGAL</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Booking</li>
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
                                <th>Nama Customer</th>
                                <th>Paket Booking</th>
                                <th>Tanggal Booking</th>
                                <th>Jam mulai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookingList as $booking)
                            <tr>
                                <td>{{ $booking->customer->name }}</td>
                                <td>{{ $booking->bookingPackage->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->start_time_at }}</td>
                                <td>
                                    <form
                                        action="{{ route('booking.destroy',$booking->id) }}"
                                        method="POST"
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

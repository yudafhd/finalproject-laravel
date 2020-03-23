@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BOOKING DETAIl</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Route('booking.index') }}">Booking</a>
            </li>
            <li class="breadcrumb-item active">detail</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <button
                        class="btn btn-success printMe"
                        style="float:right;margin-bottom:1em"
                    >
                        Print
                    </button>
                    <table class="table" id="outPrint">
                        {{--
                        <span
                            style="font-size: 7em;
                        font-weight: bold;
                        opacity: 0.12;
                        position: absolute;
                        top: 35%;
                        left: 10%;"
                            >CANVAS STUDIO</span
                        >
                        --}}
                        <tbody>
                            <tr>
                                <td><strong>Customer</strong></td>
                                <td>
                                    <span
                                        >
                                       {{$bookingDetail->customer->name}} - {{$bookingDetail->customer->id_customer}} 
                                        <br />{{$bookingDetail->customer->address}}
                                        <br />{{$bookingDetail->customer->phone}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Paket</strong></td>
                                <td>
                                    <span
                                        >{{$bookingDetail->bookingPackage->name}}
                                        <br />
                                        {!!
                                        $bookingDetail->bookingPackage->description
                                        !!}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <span>
                                        Rp.{{$bookingDetail->bookingPackage->price}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pembayaran</strong></td>
                                <td>
                                    <span>
                                        @if ($bookingDetail->bookingPackage->price <= $bookingDetail->payment) 
                                        LUNAS 
                                        @else
                                        Rp. {{ $bookingDetail->payment }},  Kurang: Rp. {{ $bookingDetail->bookingPackage->price - $bookingDetail->payment }} 
                                        <form method="POST" action="{{ Route('booking.update',$bookingDetail->id) }}">
                                            <input
                                            type="hidden"
                                    value="{{$bookingDetail->bookingPackage->price}}"
                                            name="payment"
                                        />
                                            @csrf @method('PUT')
                                        <button
                                        type="submit"
                                        class="btn btn-success waves-effect waves-light m-r-10"
                                    >
                                        Tandai Lunas
                                    </button>
                                </form>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Booking</strong></td>
                                <td>
                                    <span
                                        >{{$bookingDetail->booking_date}}</span
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jam Mulai</strong></td>
                                <td>
                                    <span
                                        >{{$bookingDetail->start_time_at}}</span
                                    >
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Admin Penerima</strong></td>
                                <td>
                                    <span
                                        >{{$bookingDetail->admin_booking}}</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ Route('booking.update',$bookingDetail->id) }}">
                        <input
                        type="hidden"
                value="0"
                        name="status"
                    />
                        @csrf @method('PUT')
                    <button
                    type="submit"
                    class="btn btn-warning waves-effect waves-light m-r-10"
                >
                    BATALKAN BOOKING
                </button>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

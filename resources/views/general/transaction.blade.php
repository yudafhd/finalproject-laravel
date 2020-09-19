@extends('general_layout.index_general') @section('content')

<div class="row m-t-40" style="margin-bottom: 20vh">
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <ul class="list-group list-group-flush">
            @foreach ($allTransaction as $transaction )
            <li class="list-group-item list-group-item-light m-b-20">
                <div class="row">
                    <div class="col-sm">
                        <div class="order-name m-b-20" style="font-size:20px; font-weight:bold; color:#000000">
                            {{ $transaction->product->name }}
                            -
                            <span class="badge"> {{ $transaction->transaction->order_id }} </span>
                        </div>
                        <table style="font-size:14px">

                            <tr>
                                <td>
                                    Tanggal transaksi
                                </td>
                                <td>
                                    <div>:
                                        {{ \Carbon\Carbon::parse($transaction->transaction->transaction_time)->format('d-m-Y') }}
                                    </div>
                                </td>
                            </tr>

                            @if ($transaction->product->type == 'subscription')
                            <tr>
                                <td>
                                    Tanggal kadaluarsa
                                </td>
                                <td>
                                    <div>:
                                        {{\Carbon\Carbon::parse($transaction->expired_purchase_at)->format('d-m-Y')  }}
                                    </div>
                                </td>
                            </tr>
                            @endif


                            <tr>
                                <td>
                                    Harga beli
                                </td>
                                <td>
                                    <div>: {{ $transaction->transaction->purchase_price }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Status transaksi
                                </td>
                                <td>
                                    <div>:
                                        @if ($transaction->transaction->status =='settlement')
                                        <span
                                            class="badge badge-success status-order">{{ $transaction->transaction->status }}</span>
                                        @elseif ($transaction->transaction->status =='success')
                                        <span
                                            class="badge badge-success status-order">{{ $transaction->transaction->status }}</span>
                                        @elseif ($transaction->transaction->status =='expire')
                                        <span
                                            class="badge badge-warning status-order">{{ $transaction->transaction->status }}</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm">
                        @if ($transaction->product->type == 'subscription')
                        <span class="badge">
                            @if(\Carbon\Carbon::parse($transaction->expired_purchase_at) >= \Carbon\Carbon::now())
                            Sedang Berjalan
                            @else
                            Masa pembelian telah habis
                            @endif
                            @endif
                        </span>
                    </div>
                </div>
            </li>
            @endforeach
            @if (count($allTransaction) == 0)
                Belum ada transaksi
            @endif
            <!-- <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
            <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
            <li class="list-group-item list-group-item-success">This is a success list group item</li>
            <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
            <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
            <li class="list-group-item list-group-item-info">This is a info list group item</li>
            <li class="list-group-item list-group-item-light">This is a light list group item</li>
            <li class="list-group-item list-group-item-dark">This is a dark list group item</li> -->
        </ul>
    </div>
</div>

<script>
    $(document).ready(function () { });
</script>

@endsection
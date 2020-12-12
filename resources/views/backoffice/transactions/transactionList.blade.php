@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">TRANSACTION</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('alert-success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session('alert-error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('alert-error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <span>
                    Total Transaction
                    <span class="label label-success label-rounded">{{count($transactions)}}</span>
                </span>
                {{-- <a href="{{Route('admin.link.create')}}"
                    class="btn btn-primary waves-effect waves-light m-b-20 float-right">
                    <i class="mdi mdi-plus"></i>
                    create
                </a> --}}
                <nav class="m-t-40">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-settlement-tab" data-toggle="tab"
                            href="#nav-settlement" role="tab" aria-controls="nav-settlement"
                            aria-selected="true">Settlement</a>
                        <a class="nav-item nav-link" id="nav-expire-tab" data-toggle="tab" href="#nav-expire" role="tab"
                            aria-controls="nav-expire" aria-selected="false">Other Status</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-settlement" role="tabpanel"
                        aria-labelledby="nav-settlement-tab">
                        @if(count($transactions) > 0)
                        <div class="table-responsive m-t-10">
                            <table class="table table-striped table-borderless searchTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Harga beli</th>
                                        <th>Payment Type</th>
                                        <th>Bank</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                        @if ($transaction->status == 'settlement' || $transaction->status == 'success')
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $transaction->order_id }}</td>
                                        <td>{{ $transaction->user->username }}</td>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>{{ $transaction->purchase_price }}</td>
                                        <td>{{ $transaction->payment_type }}</td>
                                        <td>{{ $transaction->bank }}</td>
                                        <td>{{ $transaction->transaction_time }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td style="text-align: center">
                                            <div class="dropdown" style="float: right">
                                                <button
                                                    class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{Route('admin.transaction.edit', $transaction->id)}}">Detail</a>
                                                    {{-- <form method="POST"
                                                        action="{{Route('admin.transaction.destroy', $transaction->id)}}">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn"> Delete </button>
                                                    </form> --}}

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="table-responsive m-t-10">
                            belum ada
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-expire" role="tabpanel" aria-labelledby="nav-expire-tab">
                          @if(count($transactions) > 0)
                        <div class="table-responsive m-t-10">
                            <table class="table table-striped table-borderless searchTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Harga beli</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                        @if ($transaction->status != 'settlement' && $transaction->status !='success')
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $transaction->order_id }}</td>
                                        <td>{{ $transaction->user->username }}</td>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>{{ $transaction->purchase_price }}</td>
                                        <td>{{ $transaction->transaction_time }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td style="text-align: center">
                                            <div class="dropdown" style="float: right">
                                                <button
                                                    class="btn btn-success waves-effect waves-light m-r-10 dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{Route('admin.transaction.edit', $transaction->id)}}">Update & Detail</a>
                                                    <form method="POST"
                                                        action="{{Route('admin.transaction.destroy', $transaction->id)}}">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn"> Delete </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="table-responsive m-t-10">
                            belum ada
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@extends('backoffice_layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Pemesanan</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Pemesanan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($success_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$success_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                @if ($alert_error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$alert_error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                @if($pemesanan)
                <div class="table-responsive m-t-10">
                    <h3> Pemesanan <span class="badge badge-info" style="float: right">
                        {{$pemesanan->nomor_pemesanan}}</span></h3>
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Kios Name</th>
                                <th>Qty Total</th>
                                <th>Harga Total</th>
                                <th>Tanggal Pesan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pemesanan->ewarong->nama_kios }}</td>
                                <td>{{ $pemesanan->qty_total }}</td>
                                <td>{{ $pemesanan->harga_total }}</td>
                                <td>{{ $pemesanan->date_pemesanan }}</td>
                                <td>{{ $pemesanan->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3> Detail</h3>
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan->detail as $pemesananDetail)
                            <tr>
                                <td>{{ $pemesananDetail->item->nama }}</td>
                                <td>{{ $pemesananDetail->qty }}</td>
                                <td>{{ $pemesananDetail->harga }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-actions" style="margin-top:20px">
                        <span>
                            @if ($pemesanan->status != 'CONFIRM' && $pemesanan->status != 'REJECTED' )
                            <form style="float:left; margin-right: 10px;" method="POST" 
                            action="{{ Route('pemesanan.update', $pemesanan->id) }}" 
                            onkeydown="return event.key != 'Enter';">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="status" value="CONFIRM" >
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> Konfirmasi</button>
                            </form>
                            @endif
                        </span>
                        <span>
                            @if ($pemesanan->status != 'REJECTED' && $pemesanan->status != 'CONFIRM' )
                            <form method="POST" style="float:left; margin-right: 10px;" action="{{ Route('pemesanan.update', $pemesanan->id) }}" enctype="multipart/form-data"
                                onkeydown="return event.key != 'Enter';">
                                @csrf
                                {{ method_field('PUT') }}
                                <input type="hidden" name="status" value="REJECTED" >
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-cancel"></i> Reject</button>
                            </form>
                            @endif
                        
                        </span>
                        <a href="{{url('/pemesanan/')}}" class="btn btn-inverse">Cancel</a>
                    </div> 
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

@endsection

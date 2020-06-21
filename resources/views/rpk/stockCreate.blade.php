@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT STOCK</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Stock</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if ($error_message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{$error_message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                <form method="POST" action="{{ Route('stock.store') }}" enctype="multipart/form-data"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="form-body">
                        
                        <div class="row">
                            @if (auth()->user()->access_type ==='superadmin')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">RPK Kios</label>
                                    <select class="form-control" name="ewarong_id" custom-select">
                                        @foreach ($rpks as $rpk)
                                        <option value="{{$rpk->id}}">{{$rpk->nama_kios}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                @else
                                <input type="hidden" name="ewarong_id" value="{{$rpks->id}}" />
                                @endif
                            
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Item</label>
                                    <select class="form-control" name="item_id" custom-select">
                                        @foreach ($items as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">QTY</label>
                                    <input type="number" name="qty" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Harga</label>
                                    <input type="number" name="harga" class="form-control" value="">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                         <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/item')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

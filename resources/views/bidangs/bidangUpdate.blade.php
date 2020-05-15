@extends('layouts.index') @section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">BUAT BIDANG</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">BIDANG</li>
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

                <form method="POST" action="{{ Route('bidang.update',  $bidang->id) }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-body">
                        <h3 class="card-title" style="font-weight: bold">Personal</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{$bidang->nama}}">
                                    {{-- <small class="form-control-feedback"> This is inline help </small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top:20px">
                        </div> <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Save</button>
                        <a href="{{url('/okp')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

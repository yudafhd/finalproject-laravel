@extends('general_layout.index')
@section('content')
<div class="row page-titles" style="margin-bottom: 150px;">
    <div class="col-md-6">
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
            <form method="POST" action="{{ Route('contactus.store') }}" onkeydown="return event.key != 'Enter';">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input type="text" name="name" placeholder="nama" value="{{ old('name') }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" name="email" placeholder="email" value="{{ old('email') }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <input type="number" name="phone" placeholder="boleh kosong" value="{{ old('phone') }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Pesan</label>
                                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Kirim</button>
            </form>
        </div>
    </div>
    <div id="float-wa" style="z-index: 100;"></div>
    @endsection
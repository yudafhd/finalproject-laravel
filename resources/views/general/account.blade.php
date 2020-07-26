@extends('layout_general.index_general') @section('content')

<div class="row m-t-40" style="margin-bottom: 20vh">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    @if(auth()->user()->general->photo)
                    <img src="{{ Url('storage/user/profile/'.auth()->user()->general->photo) }}" class="img-circle" width="150" />
                    @else
                    <img src="{{ asset('assets/images/user.svg') }}" class="img-circle" width="150" />
                    @endif
                    <h4 class="card-title m-t-10">{{ '@'.auth()->user()->username }}</h4>
                    @if ($membershipName)
                    <span class="badge badge-light">
                        <i class="mdi mdi-check"></i>
                        {{ $membershipName }}
                    </span>
                    @else
                    <span class="badge badge-light">{{ auth()->user()->general->membership }}</span>
                    @endif
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Tanggal Daftar </small>
                <h6>{{ auth()->user()->created_at }}</h6>
                <small class="text-muted">Email address </small>
                <h6>{{ auth()->user()->email }} <small
                        class="text-muted">{{ auth()->user()->email_verified_at ? '' : 'Belum Verifikasi' }}</small>
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#info" role="tab">Info Umum</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#username" role="tab">Username</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="info" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="POST" enctype="multipart/form-data"
                            action="{{ Route('account.update') }}">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Nama Lengkap</label>
                                <div class="col-md-12">
                                    <input name="name" type="text" value="{{ auth()->user()->name }}" placeholder="nama"
                                        class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Nomer telepon</label>
                                <div class="col-md-12">
                                    <input name="telepon" type="number" value="{{ auth()->user()->phone_number }}"
                                        placeholder="telepon" class="form-control form-control-line">
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-md-12">Username</label>
                                <div class="col-md-12">
                                    @if ($membershipName)
                                    <input name="username" type="text" value="{{ auth()->user()->username }}"
                                        placeholder="username" class="form-control form-control-line">

                                    @else
                                    <div class="email text-muted">
                                        {{ auth()->user()->username }}
                                    </div>
                                    <small class="text-muted">
                                        {{ auth()->user()->general->membership != 'free' ? '' : 'upgrade ke member donasi untuk ganti username sepuasnya' }}
                                    </small>

                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <div class="email text-muted">
                                        {{  auth()->user()->email }}
                                    </div>
                                </div>
                            </div>
                               <div class="form-group">
                                <label class="col-md-12 m-b-10">Foto</label>
                                <div class="col-md-12">
                                    <input type="file" name="foto"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white"
                                    style="width: 100%;"><i class="mdi mdi-content-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="username" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="POST" enctype="multipart/form-data"
                            action="{{ Route('account.update.username') }}">
                            @csrf
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    @if ($membershipName)
                                    <input name="username" type="text" value="{{ auth()->user()->username }}"
                                        placeholder="username" class="form-control form-control-line">

                                    @else
                                    <div class="email text-muted">
                                        {{ auth()->user()->username }}
                                    </div>
                                    <small class="text-muted">
                                        {{ auth()->user()->general->membership != 'free' ? '' : 'upgrade ke member donasi untuk ganti username sepuasnya' }}
                                    </small>

                                    @endif
                                </div>
                            </div>
                       
                            <div class="form-group">
                                <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white"
                                    style="width: 100%;"><i class="mdi mdi-content-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () { 
        @if ($message)
            Swal.fire({
                icon: 'info',
                title: 'Berhasil',
                html: '<div style="font-size: 16px;line-height: 25px;">{!! $message !!}</div>',
            });
        @endif
        @if ($messageError)
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                html: '<div style="font-size: 16px;line-height: 25px;">{!! $messageError !!}</div>',
            });
        @endif
    });

</script>

@endsection
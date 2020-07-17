@extends('layout_general.index_general') @section('content')

<div class="row m-t-40">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    @if(auth()->user()->image_url)
                        <img src="{{ Url('user/profile/'.auth()->user()->image_url) }}"
                            class="img-circle" width="150" />
                    @else
                        <img src="{{ Url('assets/images/users/user.png') }}" class="img-circle"
                            width="150" />
                    @endif
                    <h4 class="card-title m-t-10">{{ '@'.auth()->user()->username }}</h4>
                    <span class="badge badge-light">{{ auth()->user()->general->membership }}</span>
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
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#info" role="tab">Info</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="info" role="tabpanel">
                    <div class="card-body">
                        <button id="pay-button" class="btn btn-instagram m-t-5 m-b-10 text-white"
                        style="width: 100%;">Upgrade ke Akun Membership</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    // For example trigger on button clicked, or any time you need
    payButton.addEventListener('click', function () {
      snap.pay('{{ $snapToken }}'); // Replace it with your transaction token
    });
  </script>

@endsection

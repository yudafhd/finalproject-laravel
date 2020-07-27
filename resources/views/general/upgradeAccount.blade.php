@extends('general_layout.index_general') @section('content')

<div class="row m-t-40" style="margin-bottom: 20vh">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    @if(auth()->user()->image_url)
                    <img src="{{ Url('user/profile/'.auth()->user()->image_url) }}" class="img-circle" width="150" />
                    @else
                    <img src="{{ Url('assets/images/users/user.png') }}" class="img-circle" width="150" />
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
                        <form class="form-horizontal form-material" method="POST" enctype="multipart/form-data"
                            action="{{ Route('account.upgrade.agreement') }}">
                            @csrf

                            @if (!$currentTransaction && !$hasSuscribeTransaction)
                            @foreach ($products as $key => $item )
                            <div class="form-check m-t-20">
                                <input class="form-check-input" type="radio" name="product_id"
                                    id="inlineRadio{{ $key }}" value="{{ $item->id }}">
                                <label class="form-check-label" for="inlineRadio{{ $key }}">
                                    <span class="m-l-20">
                                        {{ $item->name }}
                                    </span>
                                    <span class="m-l-20 badge badge-pill badge-info">
                                        Rp. {{ $item->price }}
                                    </span>
                                </label>
                                <ul class="list-group list-group-flush" style="margin-left: 30px;">
                                    {!! $item->description !!}
                                </ul>
                            </div>
                            @endforeach
                            @endif

                            @if ($hasSuscribeTransaction)
                                <p> Berlangganan : <span class="badge badge-success p-1"> {{ $hasSuscribeTransaction->product->name }} </span></p> 
                                <p> Expired :  <span class="badge badge-danger p-1">{{ $hasSuscribeTransaction->expired_purchase_at }} </span></p> 
                            @endif
                            
                            @if($snapToken)
                            @if ($currentTransaction)
                            <p class="text-muted">Transaksi Anda Terakhir</p>
                            <p class="text-muted">Order ID :
                                {{ $currentTransaction->transaction->order_id }}</p>
                            <p class="text-muted" >Order Name :
                                {{ $currentTransaction->product->name }}</p>
                            <p class="text-muted" >Harga Beli :
                                {{ $currentTransaction->transaction->purchase_price }}</p>
                            <p class="text-muted" >Status : {{ $currentTransaction->transaction->status }}
                            </p>
                            <p class="text-muted" style="text-align: center; font-size:12px">Transaksi otomatis hangus setelah 1 jam</p>
                            @endif
                            @endif
                            @if(!$snapToken && !$currentTransaction && !$hasSuscribeTransaction)
                             <button type="submit" id="pay-button" class="btn btn-instagram m-t-10 m-b-10 text-white"
                                style="width: 100%;">Upgrade ke Akun Membership</button>
                            @endif
                        </form>
                            @if ($snapToken)
                                <button id="pay-button" class="btn btn-youtube m-t-10 m-b-10 text-white"
                            style="width: 100%;">Lakukan Pembayaran Sekarang</button>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ $message }}
<script type="text/javascript">

    $(document).ready(function () {
        @if ($message)
            Swal.fire({
                icon: 'info',
                title: 'Error',
                html: '<div style="font-size: 16px;line-height: 25px;">{!! $message !!}</div>',
            });
        @endif
        @if ($snapToken)
            const payButton = $('#pay-button');
        const finish = `{{ Route('account.upgrade') }}`;
        const error = `{{ Route('order.error') }}`;
        payButton.on('click', function () {
            snap.pay('{{ $snapToken }}', {
                language: 'id',
                onSuccess: function (result) { $(location).attr('href', finish); },
                onPending: function () { $(location).attr('href', finish); },
                onClose: function () { $(location).attr('href', finish); },
                onError: function () { console.log(result); $(location).attr('href', error); }
            });
        });
        @endif
    })
</script>

@endsection
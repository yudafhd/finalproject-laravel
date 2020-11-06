@extends('general_layout.index')
@section('content')

<section  class="section-wrapper"
>
<div class="card shadow-none login-register">
    <div class="card-body">
        <a href="{{Url('')}}" style="font-size: 35px; text-decoration:none">
            Pinterlink
        </a>
        <form class="form-horizontal form-material"
         method="POST" 
         action="{{ route('login') }}">
            @csrf
            <div class="form-group m-t-40">
                <div class="col-xs-12">
                    <input id="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="superadmin@gmail.com" required autocomplete="email" autofocus />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span>
                       Jika error tidak muncul warning ketika pakai username
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                         placeholder="Password" required autocomplete="current-password" value="adminadmin" />

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row m-t-40">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-info float-left">
                            <input id="checkbox-signup" type="checkbox" class="filled-in chk-col-light-blue">
                            <label for="checkbox-signup"> Remember me </label>
                        </div> 
                        {{-- <a href="javascript:void(0)" class="text-muted float-right"><i
                                class="fa fa-lock m-r-5"></i> Forgot pwd?</a> --}}
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-lg btn-info" type="submit">Masuk</button>
                    </div>
                </div>
                {{-- <div class="row m-t-0">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"
                                title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"
                                title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Tidak punya akun? <a class="text-info m-l-5">
                            <b>
                                <a href="{{Route('register')}}">    
                                    Daftar
                                </a> 
                            </b>
                    </div>
                    <div class="col-sm-12 text-center">
                        Lupa Password ? <a class="text-info m-l-5">
                            <b>
                                <a href="{{Route('password.request')}}">    
                                    Klik
                                </a> 
                            </b>
                    </div>
                </div>
        </form>
    </div>
</div>
</section>

@endsection

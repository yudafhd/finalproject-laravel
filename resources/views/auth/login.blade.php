@extends('general_layout.index')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 login-section-wrapper">
        <div class="brand-wrapper">
          {{-- <img src="assets/images/logo.svg" alt="logo" class="logo"> --}}
        </div>
        <div class="login-wrapper my-auto">
          <h1 class="login-title">SMKN 1 Absensi</h1>
          <form class="form-horizontal form-material"
          method="POST" 
          action="{{ route('login') }}">
          @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" placeholder="Email"
              class="form-control @error('email') is-invalid @enderror" name="email"
              value="superadmin@gmail.com" required autocomplete="email" autofocus />
          @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
            </div>
            <div class="form-group mb-4">
              <label for="password">Password</label>
              <input id="password" type="password"
              class="form-control @error('password') is-invalid @enderror" name="password"
               placeholder="Password" required autocomplete="current-password" value="adminadmin" />

          @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
            </div>
            <button class="btn btn-block btn-lg btn-success" type="submit">Masuk</button>
          </form>
          <br />
          <a href="{{Route('password.request')}}" class="forgot-password-link">Forgot password?</a>
          {{-- <p class="login-wrapper-footer-text">Don't have an account? <a  href="{{Route('register')}}" class="text-reset">Register here</a></p> --}}
        </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="assets/images/login.jpg" alt="login image" class="login-img">
      </div>
    </div>
  </div>
@endsection

{{-- 
<section  class="section-wrapper">
    <div class="card shadow-none login-register">
        <div class="card-body">
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
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <button class="btn btn-block btn-lg btn-info" type="submit">Masuk</button>
                        </div>
                    </div>
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
    </section> --}}
@extends('general_layout.index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 login-section-wrapper">
            <div class="brand-wrapper">
            </div>
            <div class="login-wrapper my-auto">
                <h1 class="login-title">SMKN 1 Absensi</h1>
                <form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" placeholder="Masukan email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
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
                            placeholder="masukan password" required autocomplete="current-password" />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button class="btn btn-block btn-lg btn-success" 
                    style="background: linear-gradient(45deg, rgb(33, 150, 243) 30%, rgb(33, 203, 243) 90%);"
                    type="submit">
                        Masuk
                    </button>
                </form>
                <br />
                <a href="{{Route('password.request')}}" class="forgot-password-link">Forgot password?</a>
            </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img src="assets/images/login.jpg" alt="login image" class="login-img">
        </div>
    </div>
</div>
@endsection
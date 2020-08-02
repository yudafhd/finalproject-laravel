@extends('general_layout.index')
@section('content')

<section  class="section-wrapper"
>
<div class="card shadow-none login-register">
    <div class="card-body">
        <form class="form-horizontal form-material"
         method="POST" 
         action="{{ route('admin.login.auth') }}">
            @csrf
            <div class="form-group m-t-40">
                <div class="col-xs-12">
                    <input id="username" type="text" placeholder="username"
                        class="form-control @error('username') is-invalid @enderror" name="username"
                        value="{{ old('username') }}" required autocomplete="username" autofocus />

                    @error('username')
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
                         placeholder="Password" required autocomplete="current-password" />

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
        </form>
    </div>
</div>
</section>

@endsection

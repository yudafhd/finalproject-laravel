@extends('layout_general.index') 
@section('content')

<section  class="section-wrapper"
>
    <div class="card shadow-none login-register mt-20-xs">
        <div class="card-body">
        <a href="{{Route('home')}}" style="font-size: 35px; text-decoration:none">
            Pinterlink
            </a>
            <form
                class="form-horizontal form-material"
                method="POST"
                action="{{ route('register') }}"
            >
                @csrf
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input
                            id="name"
                            type="text"
                            placeholder="{{ __('Name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                        />

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input
                            id="name"
                            type="text"
                            placeholder="{{ __('Username') }}"
                            class="form-control @error('username') is-invalid @enderror"
                            name="username"
                            value="{{ old('username') }}"
                            required
                        />

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input
                            id="email"
                            type="email"
                            placeholder="{{ __('E-Mail Address') }}"
                            class="form-control
                            @error('email') 
                            is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        />

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input
                            id="password"
                            type="password"
                            placeholder="{{ __('Password') }}"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="new-password"
                        />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input
                            id="password-confirm"
                            type="password"
                            placeholder="{{ __('Confirm Password') }}"
                            class="form-control"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                    </div>
                </div>

                <div class="form-group row">
                <div class="col-md-12">
                        <div class="checkbox checkbox-primary float-left p-t-0">
                            <input
                                id="checkbox-signup"
                                type="checkbox"
                                class="filled-in chk-col-light-blue"
                            />
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        {{-- <a
                            href="javascript:void(0)"
                            id="to-recover"
                            class="text-muted float-right"
                            ><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a
                        > --}}
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button
                            class="btn btn-info btn-lg btn-block text-uppercase "
                            type="submit"
                        >
                            {{ __("Daftar") }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    {{-- <div
                        class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center"
                    >
                        <div class="social">
                            <a
                                href="javascript:void(0)"
                                class="btn  btn-facebook"
                                data-toggle="tooltip"
                                title="Login with Facebook"
                            >
                                <i
                                    aria-hidden="true"
                                    class="fab fa-facebook-f"
                                ></i>
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="btn btn-googleplus"
                                data-toggle="tooltip"
                                title="Login with Google"
                            >
                                <i
                                    aria-hidden="true"
                                    class="fab fa-google-plus-g"
                                ></i>
                            </a>
                        </div>
                    </div> --}}
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Sudah punya akun?
                        <a href="login" class="text-primary m-l-5"
                            ><b>Masuk</b></a
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection 


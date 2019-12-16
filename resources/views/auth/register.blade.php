@extends('auth.app') @section('content2')
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Admin Pro</p>
    </div>
</div>
<section
    id="wrapper"
    class="login-register login-sidebar"
    style="background-image:url(../assets/images/background/login-register.jpg);"
>
    <div class="login-box card">
        <div class="card-body">
            <form
                class="form-horizontal form-material"
                method="POST"
                action="{{ route('register') }}"
            >
                @csrf
                
                <a href="" class="text-center db">
                    Canvas Studio
                </a>
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
                    <!-- <div class="col-md-12">
                        <div class="checkbox checkbox-primary float-left p-t-0">
                            <input
                                id="checkbox-signup"
                                type="checkbox"
                                class="filled-in chk-col-light-blue"
                            />
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a
                            href="javascript:void(0)"
                            id="to-recover"
                            class="text-muted float-right"
                            ><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a
                        >
                    </div> -->
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button
                            class="btn btn-info btn-lg btn-block text-uppercase btn-rounded"
                            type="submit"
                        >
                            {{ __("Register") }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <!-- <div
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
                    </div> -->
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        have an account?
                        <a href="login" class="text-primary m-l-5"
                            ><b>Sign In</b></a
                        >
                    </div>
                </div>
            </form>
            <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">
                            Enter your Email and instructions will be sent to
                            you!
                        </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input
                            class="form-control"
                            type="text"
                            required=""
                            placeholder="Email"
                        />
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button
                            class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                            type="submit"
                        >
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Register") }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label
                                for="name"
                                class="col-md-4 col-form-label text-md-right"
                                >{{ __("Name") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="name"
                                    type="text"
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

                        <div class="form-group row">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-right"
                                >{{ __("E-Mail Address") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
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

                        <div class="form-group row">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-right"
                                >{{ __("Password") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
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

                        <div class="form-group row">
                            <label
                                for="password-confirm"
                                class="col-md-4 col-form-label text-md-right"
                                >{{ __("Confirm Password") }}</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Register") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

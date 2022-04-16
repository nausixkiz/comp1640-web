@extends('layouts.auth-layout')
@section('title', __('Reset Password'))

@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="">
                                <h4 class="font-size-18 text-muted mt-2 text-center">Reset Password</h4>
                                <p class="mb-5 text-center">Reset your Password
                                    with {{ \Illuminate\Support\Facades\Config::get('app.name') }}.</p>
                                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (session('status'))
                                                <div class="alert alert-warning alert-dismissible">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="mt-4">
                                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="d-grid mt-4">
                                                <button class="btn btn-primary waves-effect waves-light"
                                                        type="submit"> {{ __('Send Password Reset Link') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (\Illuminate\Support\Facades\Route::has('register'))
                        <div class="mt-5 text-center">
                            <p class="text-white-50">Don't have an account ? <a href="{{ route('register') }}"
                                                                                class="fw-medium text-primary">
                                    Register </a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

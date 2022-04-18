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
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-4">
                                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email', $email) }}" required
                                                       autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required
                                                       autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <label for="password-confirm"
                                                       class="form-label">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="d-grid mt-4">
                                                <button class="btn btn-primary waves-effect waves-light"
                                                        type="submit"> {{ __('Reset Password') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.auth-layout')
@section('title', __('Confirm Password'))

@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="">
                                <p class="mb-5 text-center"> {{ __('Please confirm your password before continuing.') }}</p>
                                <form class="form-horizontal" method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mt-4">
                                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
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
                                                        type="submit">  {{ __('Confirm Password') }}</button>
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

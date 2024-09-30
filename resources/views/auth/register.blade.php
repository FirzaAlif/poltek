@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Card Register -->
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #2c2c2c;">
                <div class="card-header text-center text-white" style="background-color: #1a1a1a;">
                    <h3 class="font-weight-light my-4">{{ __('Register') }}</h3>
                </div>
                <div class="card-body text-white">
                    <!-- Form Register -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus
                                style="background-color: #3a3a3a; color: #ffffff;">
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="color: #ff4444;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="nim" class="form-label">{{ __('Nim') }}</label>
                            <input id="nim" type="text"
                                class="form-control @error('nim') is-invalid @enderror"
                                name="nim" value="{{ old('nim') }}"
                                required autocomplete="name" autofocus
                                style="background-color: #3a3a3a; color: #ffffff;">
                            @error('nim')
                            <span class="invalid-feedback" role="alert" style="color: #ff4444;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                required autocomplete="email"
                                style="background-color: #3a3a3a; color: #ffffff;">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color: #ff4444;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password"
                                style="background-color: #3a3a3a; color: #ffffff;">
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="color: #ff4444;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password"
                                class="form-control" name="password_confirmation"
                                required autocomplete="new-password"
                                style="background-color: #3a3a3a; color: #ffffff;">
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: #1a1a1a; border: none;">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3" style="background-color: #1a1a1a;">
                    <div class="small"><a href="{{ route('login') }}" style="color: #ffffff;">{{ __("Already have an account? Login!") }}</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
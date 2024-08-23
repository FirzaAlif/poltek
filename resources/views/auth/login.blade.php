@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Card Login -->
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #2c2c2c;">
                <div class="card-header text-center text-white" style="background-color: #1a1a1a;">
                    <h3 class="font-weight-light my-4">{{ __('Login') }}</h3>
                </div>
                <div class="card-body text-white">
                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Field -->
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus 
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
                                   name="password" required autocomplete="current-password"
                                   style="background-color: #3a3a3a; color: #ffffff;">
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="color: #ff4444;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Remember Me Checkbox -->
                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                       {{ old('remember') ? 'checked' : '' }} style="background-color: #3a3a3a; color: #ffffff;">
                                <label class="form-check-label" for="remember" style="color: #ffffff;">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Login Button and Forgot Password Link -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: #1a1a1a; border: none;">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-center" href="{{ route('password.request') }}" style="color: #ffffff;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3" style="background-color: #1a1a1a;">
                    <div class="small"><a href="{{ route('register') }}" style="color: #ffffff;">{{ __("Don't have an account? Register!") }}</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

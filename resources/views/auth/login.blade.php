@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Login</span>
            </nav> 
          </div>
        </div>
      </section>
<section class="login-section py-5 ">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-8 col-12">

                <div class="login-card">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="contact-panel contact-form reveal-up is-visible">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address">
                            @error('email')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Enter your password">
                            @error('password')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-green w-100">
                            LOGIN
                        </button>

                        <p class="text-center mt-4 mb-0">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="forgot-link">Register Now</a>
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection

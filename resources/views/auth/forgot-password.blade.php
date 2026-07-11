@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Forgot Password</span>
            </nav> 
          </div>
        </div>
      </section>
<section class="login-section py-5 ">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-8 col-12">

                <div class="login-card">

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="contact-panel contact-form reveal-up is-visible">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Enter your email address">
                            @error('email')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-green w-100">
                            Email Password Reset Link
                        </button>

                        <p class="text-center mt-4 mb-0">
                            Remember your password?
                            <a href="{{ route('login') }}" class="forgot-link">Login Here</a>
                        </p>
                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection

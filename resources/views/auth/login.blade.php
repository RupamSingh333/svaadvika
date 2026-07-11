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
            <h1>Welcome <span>Back!</span></h1>
            <p>Sign in to your account to continue.</p>
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
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address">
                            @error('email')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password <span>*</span></label>
                            <div style="position: relative;">
                                <input type="password" name="password" id="login-password" required autocomplete="current-password" placeholder="Enter your password" style="padding-right: 45px;">
                                <button type="button" onclick="togglePassword('login-password', this)" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0; color: #888;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-4 align-items-center">
                            <label for="remember_me" class="d-flex align-items-center m-0" style="cursor: pointer;">
                                <input id="remember_me" type="checkbox" name="remember" style="width: auto; margin-right: 8px; cursor: pointer;">
                                <span style="font-size: 0.9rem; color: inherit;">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link" style="font-size: 0.9rem; color: var(--brand-gold, #c89b23); text-decoration: none;">Forgot Password?</a>
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
<script>
    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection

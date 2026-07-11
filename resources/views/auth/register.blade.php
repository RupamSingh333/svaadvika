@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Register Now</span>
            </nav> 
            <h1>Create an <span>Account</span></h1>
            <p>Join Svaadvika to enjoy seamless shopping and exclusive offers.</p>
          </div>
        </div>
      </section>
 <section class="register-section py-5">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8 col-xl-7">

                <div class="login-card">

                    <form method="POST" action="{{ route('register') }}" class="contact-panel contact-form reveal-up is-visible">
                        @csrf
                        
                        @if(session('success'))
                            <div class="alert alert-success mb-4 text-center">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label class="form-label">First Name <span>*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" placeholder="First Name">
                                @error('first_name')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name <span>*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" placeholder="Last Name">
                                @error('last_name')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email address">
                                @error('email')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Password <span>*</span></label>
                                <div style="position: relative;">
                                    <input type="password" name="password" id="reg-password" required autocomplete="new-password" placeholder="Enter Password" style="padding-right: 45px;">
                                    <button type="button" onclick="togglePassword('reg-password', this)" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0; color: #888;">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Confirm Password <span>*</span></label>
                                <div style="position: relative;">
                                    <input type="password" name="password_confirmation" id="reg-password-confirm" required autocomplete="new-password" placeholder="Confirm Password" style="padding-right: 45px;">
                                    <button type="button" onclick="togglePassword('reg-password-confirm', this)" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0; color: #888;">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-green px-5">
                                    Register
                                </button>
                            </div>

                            <div class="col-12 text-center mt-2">
                                <p class="mb-0 login-text">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="forgot-link">Login Here</a>
                                </p>
                            </div>

                        </div>

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

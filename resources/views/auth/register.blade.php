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

                        <div class="row g-4">

                            <div class="col-12">
                                <label class="form-label">Full Name <span>*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter Full Name">
                                @error('name')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email address">
                                @error('email')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control" required autocomplete="new-password" placeholder="Enter Password">
                                @error('password')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Confirm Password <span>*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirm Password">
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
@endsection

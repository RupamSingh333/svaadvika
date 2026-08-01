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

                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="contact-panel contact-form reveal-up is-visible">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Enter your email address">
                            @error('email')
                            <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-green w-100">
                            Send Reset Link
                        </button>

                        <p class="text-center mt-4 mb-0">
                            Remember your password?
                            <a href="{{ route('login') }}" class="forgot-link">Login Here</a>
                        </p>
                        <p class="text-center mt-4 mb-0">
                            New here?
                            <a href="{{ route('register') }}" class="forgot-link">Create an account</a>
                        </p>
                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection
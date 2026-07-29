@extends('frontend.layouts.master')

@section('title', 'Reset Password | Svaadvika')

@section('content')
<section class="contactmain-contact-hero">
    <div class="container-xl">
        <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Reset Password</span>
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
                        {{ __('Please enter your new password below.') }}
                    </div>

                    <form method="POST" action="{{ route('password.store') }}" class="contact-panel contact-form reveal-up is-visible">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus readonly>
                            @error('email')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label">New Password <span>*</span></label>
                            <input type="password" name="password" class="form-control" required autocomplete="new-password" placeholder="Enter new password">
                            @error('password')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label">Confirm Password <span>*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-green w-100">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

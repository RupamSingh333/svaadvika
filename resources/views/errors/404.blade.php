@extends('frontend.layouts.master')

@section('title', 'Page Not Found - Svaadvika')

@section('content')
<section class="contactmain-contact-hero py-5 text-center" style="min-height: 80vh; display: flex; align-items: center; padding-top: 150px !important;">
    <div class="container-xl" style="margin-top: 50px;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8 col-md-10 text-center mx-auto">
                <img src="https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif" alt="404 Not Found" class="img-fluid mb-4 mx-auto d-block" style="max-height: 350px; border-radius: 20px;">
                <h2 class="mb-3 fw-bold">Oops! Page Not Found</h2>
                <p class="text-muted mb-4" style="font-size: 1.1rem;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                <a href="{{ route('home') }}" class="btn btn-green px-5 py-3 rounded-pill fw-bold" style="text-transform: uppercase; letter-spacing: 1px;">
                    <i class="bi bi-arrow-left me-2"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

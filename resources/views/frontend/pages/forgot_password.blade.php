@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="index.html">Home</a>
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

                    <form class="contact-panel contact-form reveal-up is-visible" id="contactForm" novalidate>

                        <div class="mb-4">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" class="" placeholder="Enter your email address">
                        </div>
 

                        <div class="d-flex justify-content-end mb-4">
                            <a href="#" class="forgot-link">Register Now</a>
                        </div>

                        <button type="submit" class="btn btn-green w-100">
                            Forgot Password
                        </button>

                        <p class="text-center mt-4 mb-0">
                            Remember your password?
                            <a href="#" class="forgot-link">Login Here</a>
                        </p>
 <p class="text-center mt-4 mb-0">
                            New here?
                            <a href="#" class="forgot-link">Create an account</a>
                        </p>
                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection
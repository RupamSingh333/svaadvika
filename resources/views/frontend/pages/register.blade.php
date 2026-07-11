@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="index.html">Home</a>
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

                    <form  class="contact-panel contact-form reveal-up is-visible" id="contactForm" novalidate>

                        <div class="row g-4">

                            <div class="col-lg-6">
                                <label class="form-label">First Name <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter First Name">
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Last Name <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Last Name">
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" class="form-control" placeholder="Enter your email address">
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Phone Number <span>*</span></label>
                                <input type="tel" class="form-control" placeholder="Enter Phone Number">
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Password <span>*</span></label>
                                <input type="password" class="form-control" placeholder="Enter Password">
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control" placeholder="Confirm Password">
                            </div>

                            <div class="col-12 text-center mt-4">

                                <button type="submit" class="btn btn-green px-5">
                                    Register
                                </button>

                            </div>

                            <div class="col-12 text-center mt-2">

                                <p class="mb-0 login-text">
                                    Already have an account?
                                    <a href="#" class="forgot-link">Login Here</a>
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
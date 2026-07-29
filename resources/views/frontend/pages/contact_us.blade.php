@extends('frontend.layouts.master')

@section('title', 'Contact Svaadvika | Order Support, Wholesale & Franchise Enquiries')
@section('meta_description', 'Get in touch with Svaadvika for order support, bulk/wholesale enquiries, or franchise opportunities. We reply within 24 hours. ISO & FSSAI certified food brand.')
@section('meta_robots', 'index, follow')
@section('canonical_url', url('/contact'))

@push('seo_tags')
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/contact') }}">
<meta property="og:title" content="Contact Svaadvika | Order Support & Enquiries">
<meta property="og:description" content="Order support, wholesale enquiries, or franchise interest — reach Svaadvika directly. We reply within 24 hours.">
<meta property="og:image" content="{{ asset('assets/images/og/contact-og.jpg') }}">
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Contact Svaadvika">
<meta name="twitter:description" content="Order support, wholesale enquiries, or franchise interest — reach us directly.">
    <meta name="twitter:image" content="{{ asset('assets/images/og/contact-og.jpg') }}">

    <!-- Schema Markup -->
    <script type="application/ld+json">
    @verbatim
    {
      "@context": "https://schema.org",
      "@type": "ContactPage",
      "mainEntity": {
        "@type": "Organization",
        "name": "Svaadvika",
        "url": "https://www.svaadvika.com",
        "logo": "https://www.svaadvika.com/assets/images/logo.png",
        "contactPoint": [
          {
            "@type": "ContactPoint",
            "telephone": "+91-9999999999",
            "contactType": "customer service",
            "email": "support@svaadvika.com",
            "availableLanguage": ["English", "Hindi"]
          },
          {
            "@type": "ContactPoint",
            "telephone": "+91-9999999999",
            "contactType": "sales",
            "email": "wholesale@svaadvika.com",
            "availableLanguage": ["English", "Hindi"]
          }
        ]
      }
    }
    @endverbatim
    </script>
@endpush

@section('content')

<section class="contactmain-contact-hero">
  <div class="container-xl">
    <div class="contact-hero-copy reveal-up">
      <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <span>Contact</span>
      </nav>
      <h1>Questions? We're <span>Actually Reading These.</span></h1>
      <p>Order issue, bulk order, franchise interest, or just want to tell us how the biryani turned out — we read every message ourselves. No call centre, no runaround.</p>
      <div class="contact-benefits">
        <article><i class="bi bi-headset"></i><strong>Quick Support</strong><small>Real replies, not a bot </small></article>
        <article><i class="bi bi-clock"></i><strong>Timely Response</strong><small>Within 24 hours, every time</small></article>
        <article><i class="bi bi-gift"></i><strong>Order Assistance</strong><small>Stuck on an order? We'll sort it</small></article>
        <article><i class="bi bi-heart"></i><strong>We Care</strong><small>Your happiness is genuinely the whole point</small></article>
      </div>
    </div>
  </div>
</section>

<section class="contact-main-section">
  <div class="container-xl">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-7">
        <form class="contact-panel contact-form reveal-up" id="contactForm" method="POST" action="{{ route('contact.store') }}" novalidate>
          @csrf
          <div class="contact-panel-head">
            <h2>Send Us a Message</h2>
          </div>

          @if(session('success'))
          <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
          </div>
          @endif

          <div class="row g-4">
            <div class="col-md-6">
              <label for="fullName">Full Name <span>*</span></label>
              <input id="fullName" name="fullName" type="text" placeholder="Enter your full name" value="{{ old('fullName') }}" required>
              @error('fullName')<div class="text-danger mt-1"><small>{{ $message }}</small></div>@enderror
            </div>
            <div class="col-md-6">
              <label for="contactEmail">Email Address <span>*</span></label>
              <input id="contactEmail" name="contactEmail" type="email" placeholder="Enter your email" value="{{ old('contactEmail') }}" required>
              @error('contactEmail')<div class="text-danger mt-1"><small>{{ $message }}</small></div>@enderror
            </div>
            <div class="col-12">
              <label for="phoneNumber">Phone Number</label>
              <input id="phoneNumber" name="phoneNumber" type="tel" placeholder="Enter your phone number" value="{{ old('phoneNumber') }}" pattern="[0-9 +()-]{8,}">
              @error('phoneNumber')<div class="text-danger mt-1"><small>{{ $message }}</small></div>@enderror
            </div>
            <div class="col-12">
              <label for="subject">Subject <span>*</span></label>
              <select id="subject" name="subject" required>
                <option value="">Select a subject</option>
                <option @if(old('subject')=='Order Support' ) selected @endif>Order Support</option>
                <option @if(old('subject')=='Product Enquiry' ) selected @endif>Product Enquiry</option>
                <option @if(old('subject')=='Wholesale Enquiry' ) selected @endif>Wholesale Enquiry</option>
                <option @if(old('subject')=='Feedback' ) selected @endif>Feedback</option>
              </select>
              @error('subject')<div class="text-danger mt-1"><small>{{ $message }}</small></div>@enderror
            </div>
            <div class="col-12">
              <label for="message">Your Message <span>*</span></label>
              <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required>{{ old('message') }}</textarea>
              @error('message')<div class="text-danger mt-1"><small>{{ $message }}</small></div>@enderror
            </div>
          </div>
          <button class="btn btn-green w-100" type="submit"><i class="bi bi-send"></i> Send Message</button>
          <small class="contact-form-message" role="status"><i class="bi bi-lock"></i> Your information is safe with us. We never share your details.</small>
        </form>
      </div>
      <div class="col-lg-5">
        <aside class="contact-panel contact-details reveal-right">
          <div class="contact-panel-head">
            <h2>Get in Touch</h2>
          </div>
          <article>
            <span class="contact-icon call"><i class="bi bi-telephone"></i></span>
            <div>
              <h3>Call Us</h3><a href="tel:{{ $settings['contact_phone'] ?? '+919999999999' }}">{{ $settings['contact_phone'] ?? '+91 99999 99999' }}</a><small>Mon - Sat: 9:00 AM - 7:00 PM</small>
            </div>
          </article>
          <article>
            <span class="contact-icon mail"><i class="bi bi-envelope"></i></span>
            <div>
              <h3>Email Us</h3><a href="mailto:{{ $settings['contact_email'] ?? 'hello@svaadvika.com' }}">{{ $settings['contact_email'] ?? 'hello@svaadvika.com' }}</a><small>We reply within 24 hours</small>
            </div>
          </article>
          <article>
            <span class="contact-icon whatsapp"><i class="bi bi-whatsapp"></i></span>
            <div>
              <h3>WhatsApp Us</h3><a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}">+{{ $settings['whatsapp_number'] ?? '91 99999 99999' }}</a><small>Chat with us on WhatsApp</small>
            </div>
          </article>
          <article>
            <span class="contact-icon location"><i class="bi bi-geo-alt"></i></span>
            <div>
              <h3>Our Office</h3>
              <p>{{ $settings['address'] ?? 'New Delhi, India' }}</p>
            </div>
          </article>
        </aside>
      </div>
    </div>
  </div>
</section>

<!-- <section class="contact-location-section">
        <div class="container-xl">
          <div class="contact-panel reveal-up">
            <div class="map-head">
              <div>
                <h2>We&rsquo;re Here for You</h2>
                <p>Visit our office or connect with our team. We&rsquo;re always happy to help!</p>
              </div>
            </div>
            
            @if(isset($settings['google_map_url']) && $settings['google_map_url'])
            <div class="ratio ratio-21x9 mt-4 mb-4" style="border-radius: var(--radius-xl); overflow: hidden;">
                <iframe src="{{ $settings['google_map_url'] }}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif
            <div class="office-grid">
              <article><i class="bi bi-buildings"></i><h3>Head Office</h3><p>123, Flavour Street, Andheri (E), Mumbai, Maharashtra 400069</p><span>Mon - Sat: 9 AM - 7 PM</span></article>
              <article><i class="bi bi-shop"></i><h3>Experience Store</h3><p>Unit No. 5, Phoenix Marketcity, Kurla West, Mumbai, Maharashtra 400070</p><span>Mon - Sun: 10 AM - 9 PM</span></article>
              <article><i class="bi bi-house-check"></i><h3>Warehouse</h3><p>Gat No. 45, Village Vadavali, Taluka Bhiwandi, Thane, Maharashtra 421302</p><span>Mon - Sat: 9 AM - 6 PM</span></article>
              <article><i class="bi bi-handshake"></i><h3>Business Inquiries</h3><p>For partnerships, wholesale or corporate orders.</p><a href="mailto:hello@svaadvika.com">Email Us</a></article>
            </div>
          </div>
        </div>
      </section> -->

<section class="contact-faq-section" id="faq">
  <div class="container-xl">
    <div class="contact-panel reveal-up">

      <div class="section-head contact-faq-head">
        <div>
          <h2>Frequently Asked Questions</h2>
        </div>
        <!-- <a class="text-link" href="#faq">
          View All FAQs <i class="bi bi-arrow-right"></i>
        </a> -->
      </div>

      <div class="accordion" id="faqAccordion">

        <!-- FAQ 1 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne">
              How long does it take to get a response?
            </button>
          </h2>

          <div id="collapseOne"
            class="accordion-collapse collapse show"
            aria-labelledby="headingOne"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              We typically respond within 24 hours on business days.
            </div>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo">
              Can I change or cancel my order?
            </button>
          </h2>

          <div id="collapseTwo"
            class="accordion-collapse collapse"
            aria-labelledby="headingTwo"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Contact us as soon as possible after placing your order, and we'll do our best to help before it ships.
            </div>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree">
              Do you offer bulk or corporate orders?
            </button>
          </h2>

          <div id="collapseThree"
            class="accordion-collapse collapse"
            aria-labelledby="headingThree"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Yes — reach out through the Business Inquiries email above for wholesale pricing and support.
            </div>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseFour"
              aria-expanded="false"
              aria-controls="collapseFour">
              Where do you deliver?
            </button>
          </h2>

          <div id="collapseFour"
            class="accordion-collapse collapse"
            aria-labelledby="headingFour"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              We deliver across India. Check our shipping policy for more details.
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>
@endsection
@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Contact</span>
            </nav>
            <h1>We&rsquo;d Love to <span>Hear From You!</span></h1>
            <p>Have a question, feedback, or need help with your order? We&rsquo;re here for you.</p>
            <div class="contact-benefits">
              <article><i class="bi bi-headset"></i><strong>Quick Support</strong><small>We&rsquo;re here to help</small></article>
              <article><i class="bi bi-clock"></i><strong>Timely Response</strong><small>We reply within 24 hours</small></article>
              <article><i class="bi bi-gift"></i><strong>Order Assistance</strong><small>Get help with your orders</small></article>
              <article><i class="bi bi-heart"></i><strong>We Care</strong><small>Your satisfaction is our priority</small></article>
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
                      <option @if(old('subject') == 'Order Support') selected @endif>Order Support</option>
                      <option @if(old('subject') == 'Product Enquiry') selected @endif>Product Enquiry</option>
                      <option @if(old('subject') == 'Wholesale Enquiry') selected @endif>Wholesale Enquiry</option>
                      <option @if(old('subject') == 'Feedback') selected @endif>Feedback</option>
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
                  <div><h3>Call Us</h3><a href="tel:{{ $settings['contact_phone'] ?? '+919999999999' }}">{{ $settings['contact_phone'] ?? '+91 99999 99999' }}</a><small>Mon - Sat: 9:00 AM - 7:00 PM</small></div>
                </article>
                <article>
                  <span class="contact-icon mail"><i class="bi bi-envelope"></i></span>
                  <div><h3>Email Us</h3><a href="mailto:{{ $settings['contact_email'] ?? 'hello@svaadvika.com' }}">{{ $settings['contact_email'] ?? 'hello@svaadvika.com' }}</a><small>We reply within 24 hours</small></div>
                </article>
                <article>
                  <span class="contact-icon whatsapp"><i class="bi bi-whatsapp"></i></span>
                  <div><h3>WhatsApp Us</h3><a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}">+{{ $settings['whatsapp_number'] ?? '91 99999 99999' }}</a><small>Chat with us on WhatsApp</small></div>
                </article>
                <article>
                  <span class="contact-icon location"><i class="bi bi-geo-alt"></i></span>
                  <div><h3>Our Office</h3><p>{{ $settings['address'] ?? 'New Delhi, India' }}</p></div>
                </article>
              </aside>
            </div>
          </div>
        </div>
      </section>

      <section class="contact-location-section">
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
      </section>

      <section class="contact-faq-section" id="faq">
    <div class="container-xl">
        <div class="contact-panel reveal-up">

            <div class="section-head contact-faq-head">
                <div>
                    <h2>Frequently Asked Questions</h2>
                </div>
                <a class="text-link" href="#faq">
                    View All FAQs <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="faq-grid">

                <div class="faq-item">
                    <h4>
                        How long does it take to get a response?
                        <i class="bi bi-dash-lg"></i>
                    </h4>
                    <p>We typically respond within 24 hours on business days.</p>
                </div>

                <div class="faq-item">
                    <h4>
                        Can I change or cancel my order?
                        <i class="bi bi-dash-lg"></i>
                    </h4>
                    <p>Yes! Contact us as soon as possible and we'll do our best to help.</p>
                </div>

                <div class="faq-item">
                    <h4>
                        Do you offer bulk or corporate orders?
                        <i class="bi bi-dash-lg"></i>
                    </h4>
                    <p>Absolutely! Reach out to us for special pricing and assistance.</p>
                </div>

                <div class="faq-item">
                    <h4>
                        Where do you deliver?
                        <i class="bi bi-dash-lg"></i>
                    </h4>
                    <p>We deliver across India. Check our shipping policy for more details.</p>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="index.html">Home</a>
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
              <form class="contact-panel contact-form reveal-up" id="contactForm" novalidate>
                <div class="contact-panel-head">
                  <h2>Send Us a Message</h2>
                </div>
                <div class="row g-4">
                  <div class="col-md-6">
                    <label for="fullName">Full Name <span>*</span></label>
                    <input id="fullName" name="fullName" type="text" placeholder="Enter your full name" required>
                  </div>
                  <div class="col-md-6">
                    <label for="contactEmail">Email Address <span>*</span></label>
                    <input id="contactEmail" name="contactEmail" type="email" placeholder="Enter your email" required>
                  </div>
                  <div class="col-12">
                    <label for="phoneNumber">Phone Number</label>
                    <input id="phoneNumber" name="phoneNumber" type="tel" placeholder="Enter your phone number" pattern="[0-9 +()-]{8,}">
                  </div>
                  <div class="col-12">
                    <label for="subject">Subject <span>*</span></label>
                    <select id="subject" name="subject" required>
                      <option value="">Select a subject</option>
                      <option>Order Support</option>
                      <option>Product Enquiry</option>
                      <option>Wholesale Enquiry</option>
                      <option>Feedback</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="message">Your Message <span>*</span></label>
                    <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
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
                  <div><h3>Call Us</h3><a href="tel:+919876543210">+91 98765 43210</a><small>Mon - Sat: 9:00 AM - 7:00 PM</small></div>
                </article>
                <article>
                  <span class="contact-icon mail"><i class="bi bi-envelope"></i></span>
                  <div><h3>Email Us</h3><a href="mailto:hello@svaadvika.com">hello@svaadvika.com</a><small>We reply within 24 hours</small></div>
                </article>
                <article>
                  <span class="contact-icon whatsapp"><i class="bi bi-whatsapp"></i></span>
                  <div><h3>WhatsApp Us</h3><a href="https://wa.me/919876543210">+91 98765 43210</a><small>Chat with us on WhatsApp</small></div>
                </article>
                <article>
                  <span class="contact-icon location"><i class="bi bi-geo-alt"></i></span>
                  <div><h3>Our Office</h3><p>Svaadvika Foods Pvt. Ltd.<br>123, Flavour Street, Andheri (E)<br>Mumbai, Maharashtra 400069, India</p></div>
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
              <a class="btn btn-green" href="https://www.google.com/maps/search/Mumbai" target="_blank" rel="noreferrer"><i class="bi bi-geo-alt"></i> View on Google Maps</a>
            </div>
            <div class="contact-map" aria-label="Svaadvika Mumbai location map">
              <span class="map-water"></span>
              <span class="map-road road-one"></span>
              <span class="map-road road-two"></span>
              <span class="map-road road-three"></span>
              <span class="map-pin"><span>S</span></span>
              <strong>Mumbai</strong>
              <em>Andheri East</em>
              <small>Navi Mumbai</small>
            </div>
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
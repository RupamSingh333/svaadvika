@extends('frontend.layouts.master')

@section('content')
<section class="about-hero">
        <div class="container-xl">
          <div class="about-hero-copy reveal-up">
           <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>About Us</span>
            </nav>
            <h1>Crafted From Tradition. <span>Served With Love.</span></h1>
            <p>Svaadvika is more than just a food brand - it is a celebration of India&rsquo;s rich culinary heritage, authentic flavours, and timeless traditions.</p>
          </div>
        </div>
      </section>

      <section class="about-story">
        <div class="container-fluid px-0">
          <div class="row g-0 align-items-stretch">
            <div class="col-lg-6">
              <div class="about-story-copy reveal-up">
                <p class="eyebrow">Our Story</p>
                <h2>A Journey Rooted in Tradition, <span>Inspired by India</span></h2>
                <p>Svaadvika was born from a simple belief - that every home deserves restaurant flavour without the hours of preparation.</p>
                <p>We blend authentic recipes, premium ingredients and modern technology to deliver purity, taste and trust. From our kitchens to your home, we ensure every bite brings the warmth of tradition and the comfort of home.</p>
                <a class="btn btn-gold" href="index.html#products">Explore Our Products</a>
              </div>
            </div>
            <div class="col-lg-6 about-story-image-wrap reveal-right">
              <img src="{{ asset('frontend/assets/images/story-reference.png') }}" alt="Indian grandmother and granddaughter preparing biryani in a heritage kitchen" loading="lazy">
            </div>
          </div>
        </div>
      </section>
      <section class="about-journey-section py-5">
        <div class="container-xl">
          <div class="about-section-title reveal-up">
            <h2>Our Journey</h2>
          </div>
          <div class="journey-timeline reveal-up">
            <article><span><i class="bi bi-building"></i></span><strong>2018</strong><h3>The Idea</h3><p>Svaadvika was founded with a passion for authentic Indian flavours.</p></article>
            <article><span><i class="bi bi-basket"></i></span><strong>2019</strong><h3>First Kitchen</h3><p>Our first production kitchen opened, bringing traditional recipes to life.</p></article>
            <article><span><i class="bi bi-people"></i></span><strong>2020</strong><h3>Growing Together</h3><p>Expanded our product range and reached thousands of happy homes.</p></article>
            <article><span><i class="bi bi-patch-check"></i></span><strong>2021</strong><h3>Quality First</h3><p>Achieved quality certifications and strengthened our commitment.</p></article>
            <article><span><i class="bi bi-box-seam"></i></span><strong>2022</strong><h3>Pan India</h3><p>Delivered our products to homes across India with love and trust.</p></article>
            <article><span><i class="bi bi-stars"></i></span><strong>2026</strong><h3>The Future</h3><p>Continuing to innovate and bring you the best of Indian flavours.</p></article>
          </div>
        </div>
      </section>
      <section class="founder-section">
        <div class="container-fluid px-0">
          <div class="founder-card reveal-up">
            <div class="founder-portrait">
              <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=85" alt="Neha Sharma, co-founder of Svaadvika" loading="lazy">
              <strong>Neha Sharma</strong>
              <small>Co-Founder</small>
            </div>
            <div class="founder-message">
              <p class="eyebrow">Founder&rsquo;s Message</p>
              <h2>Bringing Authentic Flavours To Every Home</h2>
              <p>At Svaadvika, we believe food is an emotion that connects hearts and creates memories. Our mission is to make authentic, wholesome and delicious meals accessible to every home with convenience and trust.</p>
              <p>Thank you for letting us be a part of your culinary journey.</p>
              <span>Neha Sharma</span>
            </div>
          </div>
        </div>
      </section>



      <section class="mission-section">
        <div class="container-xl">
          <div class="row g-4">
            <div class="col-lg-6">
              <article class="mission-card reveal-up">
                <i class="bi bi-bullseye"></i>
                <div>
                  <p class="eyebrow">Our Mission</p>
                  <p>To deliver authentic, nutritious and delicious Indian food products made with premium ingredients and modern technology. We aim to make every meal easy, flavourful and memorable.</p>
                </div>
              </article>
            </div>
            <div class="col-lg-6">
              <article class="mission-card reveal-right">
                <i class="bi bi-eye"></i>
                <div>
                  <p class="eyebrow">Our Vision</p>
                  <p>To be India&rsquo;s most trusted food brand known for authenticity, quality and innovation - bringing the joy of traditional flavours to every home across the world.</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <section class="values-section">
        <div class="container-xl">
          <div class="about-section-title reveal-up">
            <h2>Our Core Values</h2>
          </div>
          <div class="values-grid">
            <article class="reveal-up"><i class="bi bi-arrow-repeat"></i><h3>Authenticity</h3><p>Rooted in traditional recipes and true Indian flavours.</p></article>
            <article class="reveal-up"><i class="bi bi-award"></i><h3>Quality</h3><p>We use the finest ingredients and follow highest standards.</p></article>
            <article class="reveal-up"><i class="bi bi-shield-check"></i><h3>Integrity</h3><p>Honest practices and transparency in everything we do.</p></article>
            <article class="reveal-up"><i class="bi bi-lightbulb"></i><h3>Innovation</h3><p>Blending tradition with modern technology for better experiences.</p></article>
            <article class="reveal-up"><i class="bi bi-heart"></i><h3>Customer First</h3><p>Your trust and happiness are at the heart of every decision.</p></article>
          </div>
        </div>
      </section>

      <section class="about-manufacturing">
        <div class="container-xl">
          <div class="about-manufacturing-card reveal-up">
            <div>
              <p class="eyebrow">Our Manufacturing</p>
              <h2>Where Tradition Meets Technology</h2>
              <ul>
                <li><i class="bi bi-check-circle"></i> State-of-the-art production facility</li>
                <li><i class="bi bi-check-circle"></i> Hygienic and automated process</li>
                <li><i class="bi bi-check-circle"></i> Premium quality ingredients</li>
                <li><i class="bi bi-check-circle"></i> Zero preservatives and chemicals</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="cert-achievement-section">
        <div class="container-xl">
          <div class="row g-4">
            <div class="col-lg-6">
              <div class="cert-panel reveal-up">
                <p class="eyebrow">Our Certifications</p>
                <div class="cert-grid">
                  <article><i class="fa-solid fa-certificate"></i><strong>FSSAI</strong><small>Approved</small></article>
                  <article><i class="bi bi-patch-check"></i><strong>ISO</strong><small>22000:2018 Certified</small></article>
                  <article><i class="bi bi-shield-check"></i><strong>HACCP</strong><small>Certified</small></article>
                  <article><i class="bi bi-award"></i><strong>GMP</strong><small>Certified</small></article>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="cert-panel reveal-right">
                <p class="eyebrow">Our Achievements</p>
                <div class="achievement-grid">
                  <article><i class="bi bi-basket2"></i><strong data-counter="10">0</strong><small>Authentic Recipes</small></article>
                  <article><i class="bi bi-box-seam"></i><strong data-counter="50">0</strong><small>Premium Products</small></article>
                  <article><i class="bi bi-person-heart"></i><strong>1M+</strong><small>Happy Customers</small></article>
                  <article><i class="bi bi-award"></i><strong>100%</strong><small>Quality &amp; Trust</small></article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="about-cta">
        <div class="container-xl">
          <div class="about-cta-copy reveal-up">
            <h2>Experience Authentic Flavours At Home</h2>
            <p>Bring home the perfect blend of tradition, quality and taste with Svaadvika.</p>
            <a class="btn btn-gold" href="index.html#products">Explore Our Products</a>
          </div>
        </div>
      </section>
@endsection
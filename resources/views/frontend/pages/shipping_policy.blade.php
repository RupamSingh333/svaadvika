@extends('frontend.layouts.master')

@section('content')
<section class="products-hero">
  <div class="container-xl">
    <div class="products-hero-copy reveal-up">
      <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <span>Shipping & Delivery Policy</span>
      </nav>
      <h1>Shipping & Delivery Policy</h1>
      <!-- <p>Authentic flavours, premium ingredients crafted for your kitchen.</p> -->
      <span class="products-divider" aria-hidden="true"></span>
    </div>
  </div>
</section>
 

</head>
<body>

<section class="shipping-policy-section">
<div class="container">

<div class="policy-wrapper">

<div class="text-center mb-5">
<h1 class="policy-title">Shipping & Delivery Policy</h1>
<p class="policy-subtitle">
Svaadvika — operated by Javoris Solutions Private Limited
</p>
</div>

<div class="policy-card">
<h3>1. Serviceable Area</h3>

<p>
Deliveries by <strong>Javoris Solutions Private Limited</strong>, operating the brand
<strong>Svaadvika</strong> through
<a href="https://www.svaadvika.com" target="_blank">www.svaadvika.com</a>,
are currently available only within eligible Mumbai and Thane pin codes verified during checkout.
Estimated delivery timelines displayed at checkout are pincode-specific and indicative only.
These timelines do not constitute a guaranteed delivery commitment unless expressly stated as a fixed delivery date at the time of order.
</p>

</div>

<div class="policy-card">

<h3>2. Minimum Shelf-Life Dispatch Threshold</h3>

<p>
No packaged food item shall be dispatched unless at least
<strong>70% of its declared remaining shelf-life</strong>
(measured from the date of manufacture/packing to the declared
"Best Before" or "Use By" date) remains available at the time of dispatch.
The Company maintains internal dispatch records to verify compliance with this requirement.
These records shall serve as primary evidence in the event of any dispute regarding product freshness.
</p>

</div>

<div class="policy-card">

<h3>3. Pre-Purchase Digital Disclosure</h3>

<p>
In accordance with the Food Safety and Standards (Labelling and Display) Regulations, 2020,
the Platform provides all mandatory product declarations before purchase, except variable
information such as batch number and exact manufacturing or expiry dates, which may be supplied at or before delivery.
Product pages include:
</p>

<ul class="mt-3">
<li>Name and true nature of the food</li>
<li>Complete ingredient list in descending order</li>
<li>Allergen declarations</li>
<li>Nutritional information per serving</li>
<li>Vegetarian / Non-Vegetarian logo</li>
<li>Net quantity</li>
<li>Manufacturer and marketer details</li>
</ul>

<div class="mt-4 p-3 rounded bg-light border">

<strong>Manufacturer / Marketer Disclosure</strong>

<p class="mt-3 mb-0">
Manufactured by <strong>M. M. Poonjiaji Spices Ltd.</strong>,
Plot No. C-420, TTC Industrial Area,
MIDC Pawane, Turbhe, Navi Mumbai – 400705
(FSSAI Licence No. 11515016000351).
<br><br>

Labelled and Marketed by
<strong>Javoris Solutions Private Limited</strong>,
101, Marathe Heights,
Titwala (East), Thane – 421605
(FSSAI Licence No. 21526021004811).
</p>

</div>

</div>

<div class="policy-card">

<h3>4. Risk of Loss</h3>

<p>
The Company retains the risk of loss, damage, or spoilage during transit until the products are physically delivered to the User at the declared delivery address.
Upon successful delivery, the risk transfers immediately to the User, subject to the reporting provisions contained in the Refund and Cancellation Policy.
</p>

</div>

<div class="policy-card">

<h3>5. Force Majeure</h3>

<p>
The Company shall not be liable for delays or failure to deliver resulting from events beyond its reasonable control, including but not limited to heavy rainfall, flooding, civic restrictions, strikes, transport disruptions, epidemics, pandemics, road closures, or third-party logistics failures.
Where such events prevent delivery within a reasonable period, the order shall be treated as cancelled and a full refund shall be processed instead of indefinitely postponing delivery.
</p>

</div>

<div class="policy-card">

<h3>6. Failed Delivery</h3>

<p>
If delivery cannot be completed due to reasons attributable to the User, the Company will make at least one additional attempt to contact the User before treating the delivery as failed.
Thereafter, the order shall be cancelled and the User shall receive a refund after deduction only of the actual documented cost of goods and logistics already incurred by the Company.
</p>

</div>

<div class="policy-card">

<h3>7. Grievance Redressal</h3>

<p>
For any shipping or delivery-related concerns, Users may contact the
<strong>Grievance Officer</strong> whose details are provided in the Terms and Conditions available on the Platform.
</p>

</div>

<div class="policy-card mb-0">

<h3>8. Governing Law & Jurisdiction</h3>

<p>
This Shipping & Delivery Policy shall be governed by the laws of India.
Any disputes arising from or relating to this Policy shall be subject to the jurisdiction of the competent courts at Mumbai, without prejudice to the User's statutory rights to approach the Consumer Commission having appropriate jurisdiction.
</p>

</div>

</div>

</div>
</section>
@endsection
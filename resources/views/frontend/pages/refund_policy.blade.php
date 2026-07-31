@extends('frontend.layouts.master')

@section('content')
<section class="products-hero">
  <div class="container-xl">
    <div class="products-hero-copy reveal-up">
      <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <span>Refund & Cancellation Policy</span>
      </nav>
      <h1>Refund & Cancellation Policy</h1>
      <!-- <p>Authentic flavours, premium ingredients crafted for your kitchen.</p> -->
      <span class="products-divider" aria-hidden="true"></span>
    </div>
  </div>
</section>
 <section class="shipping-policy-section">
<div class="container">

<div class="policy-wrapper">

<div class="text-center mb-5">
<h1 class="policy-title">Refund & Cancellation Policy</h1>
<p class="policy-subtitle">
Svaadvika — operated by Javoris Solutions Private Limited
</p>
</div>

<div class="policy-card">
<h3>1. Statutory Basis</h3>

<p>
This Refund & Cancellation Policy is framed in accordance with the
<strong>Consumer Protection Act, 2019</strong> and the
<strong>Consumer Protection (E-Commerce) Rules, 2020</strong>.
It forms an integral part of the Terms & Conditions of
<strong>Javoris Solutions Private Limited</strong>, operating the brand
<strong>Svaadvika</strong> through
<a href="https://www.svaadvika.com" target="_blank">www.svaadvika.com</a>.
This Policy applies only to orders placed directly on the Platform.
Orders placed through third-party marketplaces such as
<strong>Zepto</strong>, <strong>Amazon</strong>, or
<strong>Blinkit</strong> shall be governed by the refund and cancellation
policies of those respective platforms.
</p>

</div>

<div class="text-center mb-4">
<h2 class="fw-bold">PART A — Refund & Return</h2>
</div>

<div class="policy-card">

<h3>2. Baseline Rule – No Return, No Exchange</h3>

<p>
Due to the perishable nature, hygiene sensitivity, and shelf-life dependency of
Ready-to-Eat, Ready-to-Cook, and Heat-and-Eat products,
no return, exchange, or change-of-mind refund shall be permitted
once the order has been successfully delivered.
</p>

</div>

<div class="policy-card">

<h3>3. Narrow Exception – Tiered Reporting Window</h3>

<p>
Refund or replacement requests shall be considered only if reported
within the timelines below and supported by
time-stamped photographs or video evidence.
</p>

<ul class="mt-3">
<li>
<strong>Category I – Physical / Packaging Defects</strong><br>
(Missing item, damaged, leaking, tampered packaging, or wrong product delivered.)
Report within <strong>6 hours</strong> from the delivery timestamp.
</li>

<li class="mt-3">
<strong>Category II – Spoilage / Food Safety Concerns</strong><br>
(Foul smell, abnormal taste, mould, contamination,
foreign object, or suspected unsafe food.)
Report within <strong>2 hours</strong> of delivery together with a
video recorded while opening the package before refrigeration or storage.
</li>
</ul>

<div class="mt-4 p-3 bg-light rounded border">

<strong>Rationale</strong>

<p class="mt-3 mb-0">
The shorter reporting period for spoilage complaints reflects the
scientific reality that bacterial growth increases rapidly once a sealed
food package is opened and left unrefrigerated.
Immediate reporting enables genuine verification while preserving
the consumer's statutory right to report unsafe food to the Company,
FSSAI, or the Consumer Commission at any time.
</p>

</div>

</div>

<div class="policy-card">

<h3>4. Verification & Decision</h3>

<p>
Upon receiving a valid claim, the Company shall verify the submitted
proof against dispatch records, shelf-life logs, and packaging
quality-control records and communicate its decision within
<strong>[X] hours</strong>.
</p>

</div>

<div class="policy-card">

<h3>5. Refund Mode & Timeline</h3>

<p>
Approved refunds shall be credited to the original payment method
within <strong>3–7 business days</strong> after approval,
subject to banking and payment gateway processing timelines.
For Cash-on-Delivery orders, refunds shall be made through
Bank Transfer or UPI after receiving the User's payment details.
</p>

</div>

<div class="policy-card">

<h3>6. Grievance Escalation</h3>

<p>
If a refund-related dispute remains unresolved,
the User may escalate the matter to the
<strong>Grievance Officer</strong> mentioned in the Terms & Conditions,
and thereafter approach the appropriate Consumer Commission
or the competent courts at Mumbai.
</p>

</div>

<div class="text-center mb-4">
<h2 class="fw-bold">PART B — Cancellation</h2>
</div>

<div class="policy-card">

<h3>7. B2C Orders – Dispatch Cycle Based Cancellation Window</h3>

<p>
Svaadvika products are packaged Ready-to-Eat and Ready-to-Cook foods
dispatched through daily courier pickups at
<strong>10:00 AM</strong>.
Orders follow the cancellation windows below:
</p>

<ul class="mt-3">

<li>
<strong>Cycle 1</strong><br>
Orders placed between
<strong>12:00 AM – 7:00 AM</strong>
may be cancelled or modified free of charge until
<strong>7:00 AM</strong> on the same day.
</li>

<li class="mt-3">
<strong>Cycle 2</strong><br>
Orders placed between
<strong>7:00 AM – 11:59 PM</strong>
may be cancelled or modified free of charge until
<strong>7:00 AM</strong> the following day.
</li>

</ul>

<p class="mt-4">
The applicable cancellation deadline shall be displayed during checkout
and in the order confirmation notification.
Once the cut-off time has passed and an invoice has been generated,
the order cannot be cancelled or modified as packing and courier
processing has already commenced.
</p>

</div>

<div class="policy-card">

<h3>8. Cancellation by the Company</h3>

<p>
If the Company cancels a confirmed order due to stock unavailability,
packing constraints, or non-serviceability,
the entire order amount shall be refunded without deduction,
and no cancellation charge shall be imposed on the consumer.
</p>

</div>

<div class="policy-card">

<h3>9. Notification</h3>

<p>
If an order is cancelled by the Company,
the User shall be informed promptly with the reason for cancellation,
and the refund shall be processed in accordance with
Clause 5 of this Policy.
</p>

</div>

<div class="policy-card mb-0">

<h3>10. Governing Law & Jurisdiction</h3>

<p>
This Refund & Cancellation Policy shall be governed by the laws of India.
Any disputes arising under this Policy shall be subject to the jurisdiction
of the competent courts at Mumbai, without prejudice to the User's
statutory right to approach the appropriate Consumer Commission.
</p>

</div>

</div>

</div>
</section>
@endsection
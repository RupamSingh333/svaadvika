@extends('frontend.layouts.master')

@section('content')
      <section class="products-hero">
  <div class="container-xl">
    <div class="products-hero-copy reveal-up">
      <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="bi bi-chevron-right"></i>
        <span>Privacy Policy</span>
      </nav>
      <h1>Privacy Policy</h1>
      <!-- <p>Authentic flavours, premium ingredients crafted for your kitchen.</p> -->
      <span class="products-divider" aria-hidden="true"></span>
    </div>
  </div>
</section>
 <section class="shipping-policy-section">
    <div class="container">

        <div class="policy-wrapper">

            <div class="text-center mb-5">
                <h1 class="policy-title">Privacy Policy</h1>
                <p class="policy-subtitle">
                    Svaadvika — operated by Javoris Solutions Private Limited
                </p>
            </div>

            <div class="policy-card">
                <h3>1. Statutory Basis and Data Fiduciary</h3>

                <p>
                    This Privacy Policy is issued by
                    <strong>Javoris Solutions Private Limited</strong>,
                    having its registered office at
                    <strong>101, Marathe Heights, Titwala (East), Thane – 421605, Maharashtra</strong>,
                    in compliance with the
                    <strong>Digital Personal Data Protection Act, 2023 (DPDP Act)</strong>,
                    Section 43A of the Information Technology Act, 2000,
                    and the applicable IT (Reasonable Security Practices) Rules.
                </p>

                <p class="mt-3 mb-0">
                    The Company acts as the
                    <strong>Data Fiduciary</strong> for all Personal Data
                    collected through
                    <a href="https://www.svaadvika.com" target="_blank">www.svaadvika.com</a>,
                    whether Users access the Svaadvika storefront or the franchise portal.
                </p>
            </div>

            <div class="policy-card">

                <h3>2. Data Collected – B2C Buyers</h3>

                <ul>
                    <li>Name, mobile number, email address and delivery address.</li>
                    <li>Order history, payment reference and GSTIN (where provided).</li>
                    <li>Dietary or allergen information voluntarily shared for food safety purposes.</li>
                    <li>Technical information including IP address, cookies and device identifiers.</li>
                </ul>

            </div>

            <div class="policy-card">

                <h3>3. Data Collected – B2B Franchise Applicants</h3>

                <ul>
                    <li>Identity, contact information and business address.</li>
                    <li>Investment capacity, financial declarations and bank references.</li>
                    <li>Business background and previous entrepreneurial experience voluntarily submitted.</li>
                    <li>Such information is used solely for franchise evaluation and is never combined with B2C customer data.</li>
                </ul>

            </div>

            <div class="policy-card">

                <h3>4. Purpose, Notice and Consent</h3>

                <p>
                    Personal Data is processed only for lawful purposes,
                    with the consent of the Data Principal or under
                    applicable legitimate uses permitted under the DPDP Act.
                    Consent is obtained through clear affirmative action,
                    is specific, informed and voluntary,
                    and may be withdrawn at any time with the same ease as it was granted.
                </p>

            </div>

            <div class="policy-card">

                <h3>5. Sharing and Cross-Border Transfer</h3>

                <p>
                    Personal Data may be shared with authorised payment gateways,
                    logistics partners and other contracted Data Processors
                    solely for order fulfilment and related business operations.
                    Where Users purchase through third-party marketplaces such as
                    <strong>Zepto</strong>,
                    <strong>Amazon</strong> or
                    <strong>Blinkit</strong>,
                    their Personal Data is also governed by the respective platform's privacy policy.
                    Cross-border transfers shall be made only in accordance with the DPDP Act.
                </p>

            </div>

            <div class="policy-card">

                <h3>6. Security and Breach Notification</h3>

                <p>
                    The Company implements appropriate technical and organisational
                    safeguards to protect Personal Data.
                    In the event of any Personal Data breach,
                    affected users and the competent authority shall be notified
                    in accordance with applicable legal requirements.
                </p>

            </div>

            <div class="policy-card">

                <h3>7. Data Retention</h3>

                <p>
                    Personal Data is retained only for as long as necessary
                    to fulfil the purposes for which it was collected
                    or as required by applicable law.
                    Franchise application records that are no longer required
                    shall be securely deleted after the applicable retention period.
                </p>

            </div>

            <div class="policy-card">

                <h3>8. Rights of the Data Principal</h3>

                <ul>
                    <li>Right to obtain a summary of Personal Data being processed.</li>
                    <li>Right to correction, updating and erasure of Personal Data.</li>
                    <li>Right to raise grievances against the Company.</li>
                    <li>Right to nominate another individual to exercise rights in case of death or incapacity.</li>
                </ul>

            </div>

            <div class="policy-card">

                <h3>9. Children's Data</h3>

                <p>
                    Personal Data relating to children below 18 years of age
                    shall only be processed with verifiable parental or guardian consent.
                    The Platform does not engage in behavioural tracking,
                    targeted advertising or profiling of children.
                </p>

            </div>

            <div class="policy-card">

                <h3>10. Grievance Officer / Data Protection Officer</h3>

                <p>
                    Users may contact the Company's designated Grievance Officer
                    for any privacy-related concern.
                </p>

                <div class="bg-light border rounded p-3 mt-3">

                    <strong>Grievance Officer</strong>

                    <ul class="mb-0 mt-3">
                        <li><strong>Name:</strong> [Name of Grievance Officer]</li>
                        <li><strong>Designation:</strong> [Designation]</li>
                        <li><strong>Address:</strong> 101, Marathe Heights, Titwala (East), Thane – 421605, Maharashtra</li>
                        <li><strong>Email:</strong> grievance@svaadvika.com</li>
                    </ul>

                </div>

                <p class="mt-3 mb-0">
                    If the grievance remains unresolved,
                    the Data Principal may approach the
                    <strong>Data Protection Board of India</strong>
                    in accordance with the DPDP Act.
                </p>

            </div>

            <div class="policy-card">

                <h3>11. Cookies and Tracking Technologies</h3>

                <p>
                    The Platform uses cookies and similar technologies
                    for authentication, user preferences,
                    analytics and personalised recommendations.
                    Non-essential cookies are activated only after
                    obtaining the User's explicit consent
                    through the cookie consent banner.
                </p>

            </div>

            <div class="policy-card">

                <h3>12. Amendment</h3>

                <p>
                    The Company reserves the right to modify this Privacy Policy
                    from time to time.
                    Material changes affecting the processing of Personal Data
                    shall be notified to Users,
                    and fresh consent shall be obtained wherever legally required.
                </p>

            </div>

            <div class="policy-card mb-0">

                <h3>13. Governing Law & Jurisdiction</h3>

                <p>
                    This Privacy Policy shall be governed by the laws of India.
                    Subject to the jurisdiction of the Data Protection Board of India
                    for matters arising under the DPDP Act,
                    all disputes relating to this Policy shall be subject to the
                    jurisdiction of the competent courts at Mumbai.
                </p>

            </div>

        </div>

    </div>
</section>
@endsection
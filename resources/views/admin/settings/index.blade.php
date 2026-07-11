@extends('admin.layouts.master')

@section('title', 'General Settings')
@section('page_title', 'General Settings')

@section('content')
@php
    $general = $settings->has('general') ? $settings['general']->pluck('value', 'key') : collect();
    $social = $settings->has('social') ? $settings['social']->pluck('value', 'key') : collect();
@endphp

<div class="row">
    <div class="col-12 col-xl-12 col-xxl-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <ul class="nav nav-pills mb-4 custom-nav-pills" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-selected="true"><i class="fa-solid fa-gear me-2"></i> General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-selected="false"><i class="fa-solid fa-address-book me-2"></i> Contact Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab" aria-selected="false"><i class="fa-solid fa-share-nodes me-2"></i> Social Media</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="settingsTabContent">
                        
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Website Name</label>
                                <input type="text" name="site_name" class="form-control" value="{{ $general->get('site_name', 'Svaadvika') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Website Description</label>
                                <textarea name="site_description" class="form-control" rows="3">{{ $general->get('site_description', '') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Currency Symbol</label>
                                <input type="text" name="currency_symbol" class="form-control" value="{{ $general->get('currency_symbol', '₹') }}" style="max-width: 150px;">
                            </div>
                        </div>

                        <!-- Contact Tab -->
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control" value="{{ $general->get('contact_email', 'info@svaadvika.com') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control" value="{{ $general->get('contact_phone', '+91 99999 99999') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Office Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $general->get('address', 'New Delhi, India') }}</textarea>
                            </div>
                        </div>

                        <!-- Social Tab -->
                        <div class="tab-pane fade" id="social" role="tabpanel">
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fa-brands fa-facebook text-primary me-2"></i> Facebook URL</label>
                                <input type="url" name="facebook_url" class="form-control" value="{{ $social->get('facebook_url', '') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fa-brands fa-instagram text-danger me-2"></i> Instagram URL</label>
                                <input type="url" name="instagram_url" class="form-control" value="{{ $social->get('instagram_url', '') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="fa-brands fa-twitter text-info me-2"></i> Twitter URL</label>
                                <input type="url" name="twitter_url" class="form-control" value="{{ $social->get('twitter_url', '') }}">
                            </div>
                        </div>
                        
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-save me-2"></i> Save Settings</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.custom-nav-pills .nav-link {
    color: #4b5563;
    border-radius: 8px;
    padding: 10px 20px;
    margin-right: 10px;
    font-weight: 500;
    transition: all 0.2s ease;
}
.custom-nav-pills .nav-link:hover {
    background: rgba(79, 70, 229, 0.05);
}
.custom-nav-pills .nav-link.active {
    background: var(--primary-color);
    color: #fff;
    box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
}
</style>
@endpush

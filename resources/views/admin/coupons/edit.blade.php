@extends('admin.layouts.master')

@section('title', 'Edit Coupon')
@section('page_title', 'Edit Coupon')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Coupon Details</h5>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-light btn-sm border shadow-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Coupon Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control text-uppercase @error('code') is-invalid @enderror" value="{{ old('code', $coupon->code) }}" required>
                            @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Discount Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                                <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            </select>
                            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Discount Value <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value', $coupon->value) }}" required>
                            @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Min Cart Value (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="min_cart_value" class="form-control @error('min_cart_value') is-invalid @enderror" value="{{ old('min_cart_value', $coupon->min_cart_value) }}" required>
                            @error('min_cart_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Max Discount (₹) <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="number" step="0.01" name="max_discount" class="form-control @error('max_discount') is-invalid @enderror" value="{{ old('max_discount', $coupon->max_discount) }}">
                            @error('max_discount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Usage Limit <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" value="{{ old('usage_limit', $coupon->usage_limit) }}">
                            @error('usage_limit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Expires At <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="datetime-local" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror" value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}">
                            @error('expires_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-4 d-flex align-items-center mt-4">
                            <p class="mb-0 text-muted">Total times used: <strong>{{ $coupon->used_count }}</strong></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Coupon is Active</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end border-top pt-4">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-save me-2"></i> Update Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

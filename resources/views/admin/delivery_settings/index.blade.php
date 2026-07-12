@extends('admin.layouts.master')

@section('title', 'Delivery Settings')
@section('page_title', 'Delivery Settings')

@section('content')
<div class="row">
    <div class="col-12 col-xl-6 mx-auto">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Global Delivery Settings</h5>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('admin.delivery-settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Delivery Type <span class="text-danger">*</span></label>
                        <select name="delivery_type" class="form-select @error('delivery_type') is-invalid @enderror">
                            <option value="Fixed Charge" {{ old('delivery_type', $setting->delivery_type ?? '') == 'Fixed Charge' ? 'selected' : '' }}>Fixed Charge</option>
                            <option value="Distance Based" disabled>Distance Based (Future Use)</option>
                        </select>
                        @error('delivery_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fixed Delivery Charge <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="0.01" min="0" name="fixed_charge" class="form-control @error('fixed_charge') is-invalid @enderror" value="{{ old('fixed_charge', $setting->fixed_charge ?? 0) }}" required>
                        </div>
                        <div class="form-text">Charge applied on orders below the free delivery amount.</div>
                        @error('fixed_charge')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Free Delivery Above <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="0.01" min="0" name="free_delivery_above" class="form-control @error('free_delivery_above') is-invalid @enderror" value="{{ old('free_delivery_above', $setting->free_delivery_above ?? 0) }}" required>
                        </div>
                        <div class="form-text">Order amount above which delivery is free.</div>
                        @error('free_delivery_above')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Minimum Order Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" step="0.01" min="0" name="minimum_order" class="form-control @error('minimum_order') is-invalid @enderror" value="{{ old('minimum_order', $setting->minimum_order ?? 0) }}" required>
                        </div>
                        <div class="form-text">Minimum subtotal required to place an order.</div>
                        @error('minimum_order')
                            <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', $setting->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $setting->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    @hasPermission('delivery-settings', 'edit')
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Save Settings</button>
                    </div>
                    @endhasPermission
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

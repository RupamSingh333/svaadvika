@extends('admin.layouts.master')

@section('title', 'Audit Log Details')
@section('page_title', 'Audit Log Details')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Log #{{ $auditLog->id }}</h5>
                    <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-light btn-sm border shadow-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body p-4 mt-2">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-3">Context Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th style="width: 150px;">User:</th>
                                <td>{{ $auditLog->user ? $auditLog->user->name . ' (' . $auditLog->user->email . ')' : 'System / Unknown' }}</td>
                            </tr>
                            <tr>
                                <th>Module:</th>
                                <td>{{ Str::title(str_replace('-', ' ', $auditLog->module)) }}</td>
                            </tr>
                            <tr>
                                <th>Action:</th>
                                <td>{{ Str::title($auditLog->action) }}</td>
                            </tr>
                            <tr>
                                <th>Record ID:</th>
                                <td>{{ $auditLog->record_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date/Time:</th>
                                <td>{{ $auditLog->created_at->format('d M Y, h:i:s A') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-3">System Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th style="width: 150px;">IP Address:</th>
                                <td>{{ $auditLog->ip_address }}</td>
                            </tr>
                            <tr>
                                <th>User Agent:</th>
                                <td><small>{{ $auditLog->user_agent }}</small></td>
                            </tr>
                            <tr>
                                <th>Session ID:</th>
                                <td><code>{{ $auditLog->session_id }}</code></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    @if($auditLog->old_data)
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger mb-3"><i class="fa-solid fa-minus-circle me-2"></i> Old Data</h6>
                        <pre class="bg-light p-3 rounded border" style="font-size: 0.85rem; overflow-x: auto;"><code>{{ json_encode($auditLog->old_data, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                    @endif

                    @if($auditLog->new_data)
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success mb-3"><i class="fa-solid fa-plus-circle me-2"></i> New Data</h6>
                        <pre class="bg-light p-3 rounded border" style="font-size: 0.85rem; overflow-x: auto;"><code>{{ json_encode($auditLog->new_data, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

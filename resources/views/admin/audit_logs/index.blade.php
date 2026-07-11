@extends('admin.layouts.master')

@section('title', 'Audit Logs')
@section('page_title', 'Audit Logs')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Filters -->
        <div class="card border-0 shadow-sm glass-effect mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.audit-logs.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Module</label>
                        <select name="module" class="form-select">
                            <option value="">All Modules</option>
                            @foreach($modules as $mod)
                                <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ Str::title(str_replace('-', ' ', $mod)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Action</label>
                        <select name="action" class="form-select">
                            <option value="">All Actions</option>
                            @foreach($actions as $act)
                                <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ Str::title($act) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">User ID</label>
                        <input type="number" name="user_id" class="form-control" value="{{ request('user_id') }}" placeholder="User ID">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-filter me-2"></i> Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0">System Audit Logs</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Module</th>
                                <th>Action</th>
                                <th>Record ID</th>
                                <th>IP Address</th>
                                <th>Date/Time</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>#{{ $log->id }}</td>
                                    <td>
                                        @if($log->user)
                                            <span class="fw-semibold">{{ $log->user->name }}</span><br>
                                            <small class="text-muted">{{ $log->user->email }}</small>
                                        @else
                                            <span class="text-muted">System / Unknown</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-secondary-subtle text-secondary">{{ Str::title(str_replace('-', ' ', $log->module)) }}</span></td>
                                    <td>
                                        @if($log->action == 'create')
                                            <span class="badge bg-success-subtle text-success">Create</span>
                                        @elseif($log->action == 'update')
                                            <span class="badge bg-warning-subtle text-warning">Update</span>
                                        @elseif($log->action == 'delete')
                                            <span class="badge bg-danger-subtle text-danger">Delete</span>
                                        @else
                                            <span class="badge bg-info-subtle text-info">{{ Str::title($log->action) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $log->record_id ?? '-' }}</td>
                                    <td>{{ $log->ip_address }}</td>
                                    <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.audit-logs.show', $log->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-eye text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-clipboard-list fa-3x text-light-gray"></i></div>
                                        No audit logs found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.master')

@section('title', 'Manage Permissions')
@section('page_title', 'Manage Permissions: ' . $user->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold mb-0">Module Permissions</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm border shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i> Back to Users
                </a>
            </div>
            
            <form action="{{ route('admin.users.permissions.update', $user->id) }}" method="POST">
                @csrf
                <div class="card-body p-4 mt-3">
                    
                    @if(auth()->id() === 1 && $user->id === 1)
                        <div class="alert alert-info">
                            <i class="fa-solid fa-circle-info me-2"></i> User #1 (Super Admin) automatically has all permissions. This interface is for display purposes only.
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th style="width: 250px;">Module</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                                    <tr>
                                        <td class="fw-semibold align-middle">
                                            {{ $module->name }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-3 py-2">
                                                @foreach($module->actions as $action)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" 
                                                               value="{{ $action->id }}" 
                                                               id="perm_{{ $action->id }}"
                                                               {{ in_array($action->id, $userPermissions) ? 'checked' : '' }}
                                                               {{ ($user->id === 1) ? 'disabled checked' : '' }}>
                                                        <label class="form-check-label" for="perm_{{ $action->id }}">
                                                            {{ $action->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($user->id !== 1)
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-light border shadow-sm me-2" onclick="selectAll()">Select All</button>
                            <button type="button" class="btn btn-light border shadow-sm me-3" onclick="deselectAll()">Deselect All</button>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Permissions</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function selectAll() {
        document.querySelectorAll('input[name="permissions[]"]').forEach(cb => cb.checked = true);
    }
    
    function deselectAll() {
        document.querySelectorAll('input[name="permissions[]"]').forEach(cb => cb.checked = false);
    }
</script>
@endsection

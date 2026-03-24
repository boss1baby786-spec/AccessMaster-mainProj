@extends('layouts.master')
@section('title')
    <title> Users | Roles </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <h2>Edit User Permissions </h2>
    <p><strong>Role:</strong>
    <h3>{{ $role->name }}</h3>
    </p>
    <form method="POST" action="{{ route('roles.update', $role) }}">
        @csrf
        @method('PUT')

        @php
            $groupedPermissions = [];
            foreach ($permissions as $permission) {
                $parts = explode('.', $permission->name);
                $module = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                $groupedPermissions[$module][] = $permission;
            }
        @endphp
            <div class="mb-4">
    <!-- Header Row -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <div>
            <h5 class="fw-bold mb-1">
                <i class="bi bi-key me-2 text-success"></i>Assign Permissions
            </h5>
            <p class="text-muted small mb-0">
                Select permissions for this role by toggling the switches
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mt-2 mt-md-0">
            <button type="button" class="btn  bg-primary btn-sm" onclick="selectAll()">
                <i class="bi bi-check-all me-1"></i>Select All
            </button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="deselectAll()">
                <i class="bi bi-x-circle me-1"></i>Deselect All
            </button>
        </div>
    </div>
</div>

        <div class="accordion accordion-flush border rounded-3" id="permissionsAccordion">
            @foreach ($groupedPermissions as $module => $modulePermissions)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-semibold {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $module }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            <i class="bi bi-folder2-open me-2 text-success"></i>
                            {{ $module }}
                            <span class="badge bg-success ms-2">{{ count($modulePermissions) }}</span>
                        </button>
                    </h2>
                    <div id="collapse{{ $module }}"
                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                        data-bs-parent="#permissionsAccordion">
                        <div class="accordion-body bg-light">
                            <div class="row g-3">
                                @foreach ($modulePermissions as $permission)
                                    <div class="col-md-3 col-lg-3">
                                        <div class="card border h-100 shadow-sm">
                                            <div class="card-body p-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input permission-switch" type="checkbox" role="switch"
                                                        name="permissions[]" value="{{ $permission->name }}"
                                                        id="permission_{{ $permission->id }}"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                   
                                                    <label class="form-check-label fw-semibold user-select-none"
                                                        for="permission_{{ $permission->id }}">
                                                        <i class="bi bi-shield-check me-1 text-success"></i>
                                                       {{explode('.',$permission->name)[1] ?? $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="text-center m-2">
            <button class="btn btn-success text-center  btn-lg px-5" type="submit">Update Permission</button>

        </div>
</div>


    </form>
@endsection

@section('page-wise-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
@section('script')
   <script>
    function selectAll(){
document.querySelectorAll(".permission-switch").forEach(element => {
    element.checked=true;
});



    }
    function deselectAll(){
document.querySelectorAll(".permission-switch").forEach(element => {
    element.checked=false;
});
    }
</script>
@endsection

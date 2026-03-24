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
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white py-4">
                    <h3 class="mb-0 fw-bold text-white">
                        <i class="bi bi-shield-plus text-white me-2"></i>Create New Role
                    </h3>
                    <p class="mb-0 mt-2 text-white-50">Define role name and assign permissions</p>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Validation Errors
                            </h5>
                            <hr>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf


                        <div class="mb-5">
                            <label for="name" class="form-label fw-semibold fs-5">
                                <i class="bi bi-tag me-1"></i>Role Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g., Admin,Manager etc" required>

                        </div>

                        <hr class="my-4 border-2">






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




                        @error('permissions')
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror


                        {{-- ***************************************GROUP PERMISSION BY MODULE ARRAY************************************************ --}}
                        @php
                            $groupedPermissions = [];
                            foreach ($permissions as $permission) {
                                $parts = explode('.', $permission->name);
                                $module = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                                $groupedPermissions[$module][] = $permission;
                            }
                        @endphp

                        {{-- ***************************************GROUP PERMISSION ACCORDIAN************************************************ --}}
                        <div class="accordion accordion-flush border rounded-3" id="permissionsAccordion">
                            @foreach ($groupedPermissions as $module => $modulePermissions)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-semibold {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $module }}"
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
                                                        <div class="card border h-100  shadow-sm">
                                                            <div class="card-body p-3">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input permission-switch"
                                                                        type="checkbox" role="switch" name="permissions[]"
                                                                        value="{{ $permission->name }}"
                                                                        id="permission_{{ $permission->id }}"
                                                                        {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                                                    <label
                                                                        class="form-check-label fw-semibold user-select-none"
                                                                        for="permission_{{ $permission->id }}">
                                                                        <i class="bi bi-shield-check me-1 text-success"></i>
                                                                        {{ explode('.', $permission->name)[1] ?? $permission->name }}

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
                </div>





                <div class="d-grid gap-2 d-md-flex justify-content-md-between p-2 mt-5">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-arrow-left me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="bi bi-check-circle me-2"></i>Create Role
                    </button>
                </div>
                </form>
            </div>

            
        </div>


        <div class="alert alert-info mt-4 border-0 shadow-sm d-flex align-items-center">
            <i class="bi bi-lightbulb-fill fs-4 me-3"></i>
            <div>
                <strong>Tip:</strong> Permissions are grouped by module. Expand each section to view and toggle permissions.
            </div>
        </div>
    </div>
    </div>



@endsection

@section('page-wise-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection
@section('script')
    <script>
        function selectAll() {
            document.querySelectorAll(".permission-switch").forEach(element => {
                element.checked = true;
            });



        }

        function deselectAll() {
            document.querySelectorAll(".permission-switch").forEach(element => {
                element.checked = false;
            });
        }
    </script>
@endsection

@extends('layouts.master')
@section('title')
    <title> Users </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')


    {{-- <form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div>
        <label>Name</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <h4>Assign Roles</h4>
    @foreach ($roles as $role)
        <div>
            <input type="checkbox" name="roles[]" value="{{ $role->name }}">
            {{ $role->name }}
        </div>
    @endforeach

    <button type="submit">Create User</button>
</form> --}}






    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white py-4">
                    <h3 class="mb-0 fw-bold text-white">
                        <i class="bi bi-person-plus-fill me-2"></i>Create New User
                    </h3>
                    <p class="mb-0 mt-2 text-white-50">Fill in the details to create a new user account</p>
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

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf


                        <div class="row">
<div class="mb-4 col-6">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-person me-1"></i>Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name"
                                required>

                        </div>


                        <div class="mb-4 col-6">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-1"></i>Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"
                                required>

                        </div>
                        </div>


                       <div class="row">
                         <div class="mb-4 col-6">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock me-1"></i>Password <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"
                                name="password" placeholder="Enter password" required>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Use at least 6 characters with a mix of letters, numbers & symbols
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-6">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-1"></i>Confirm Password <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" placeholder="Re-enter password"
                                required>
                            <div class="form-text text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Must match the password entered above
                            </div>
                        </div>

                       </div>

                        <hr class="my-4 border-2">


                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-shield-check me-2 text-primary"></i>Assign Roles
                            </h5>
                            <p class="text-muted small mb-3">Select one or more roles for this user</p>



                            <div class="row g-3">
                                @foreach ($roles as $role)
                                    <div class="col-md-6">
                                        <div class="card border-primary border-opacity-25 h-100">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                                        value="{{ $role->name }}" id="role_{{ $role->id }}"
                                                        {{ is_array(old('roles')) && in_array($role->name, old('roles')) ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-semibold"
                                                        for="role_{{ $role->id }}">
                                                        <i class="bi bi-person-badge me-2 text-primary"></i>
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-5">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-check-circle me-2"></i>Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="alert alert-info mt-4 border-0 shadow-sm d-flex align-items-center">
                <i class="bi bi-lightbulb-fill fs-4 me-3"></i>
                <div>
                    <strong>Tip:</strong> Make sure to assign appropriate roles based on the user's responsibilities.
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
    <script></script>
@endsection

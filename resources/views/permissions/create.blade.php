@extends('layouts.master')
@section('title')
<title> Roles | Permissions </title>
@endsection
@section('page-wise-css')
@endsection
@section('css')
<style>    
</style>
@endsection
@section('content')
<h1>Create Permissions</h1>  

 {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Roles</h5>
                </div>
                <div class="card-body"> --}}


    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white py-4">
                    <h3 class="mb-0 fw-bold text-white">
                        <i class="bi bi-shield-plus text-white me-2"></i>Create New Permission
                    </h3>
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


<form method="POST" action="{{route('permissions.store')}}">
@csrf



     <div class="mb-5">
                            <label for="name" class="form-label fw-semibold fs-5">
                                <i class="bi bi-tag me-1"></i>Permission Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="e.g., users.create etc etc"
                                   required>
                         
                        </div>

    <button class="btn btn-lg btn-primary" type="submit">Create Permission</button>
</form>
                </div>
            </div>
        </div>


@endsection

@section('page-wise-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@endsection
@section('script')
<script>
</script>
@endsection
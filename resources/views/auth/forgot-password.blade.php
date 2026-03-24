@include("partials.main")

<head>

    @include('partials.title-meta', ['title' => 'Sign In'])
    @include('partials.head-css')

</head>

<body>


<div class="auth-page-content">
<div class="container">
    <div class="row">
<div class="col-lg-12">
     <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                              
                                    <h1 class="mt-4 text-black text-nowrap fs-2">
  AccessMaster
</h1>
                            </div>
                            <p class="mt-3 fs-15 fw-medium text-black">Give your email and then get link to reset your password</p>
                        </div>
                    </div>
                </div>
       <div class="row justify-content-center">
             <div class="col-md-8 col-lg-6 col-xl-5">
<div class="card mt-4 bg-fill">
    <div class="card-header">
        <h4>Forgot Password</h4>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</div>
             </div>
       </div>

    </div>        

    </div>

</div>
</div>

</body>
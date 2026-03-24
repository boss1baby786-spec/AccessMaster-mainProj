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
                            <p class="mt-3 fs-15 text-black fw-medium">Reset Your Password</p>
                        </div>
                    </div>
                </div>
       <div class="row justify-content-center">
             <div class="col-md-8 col-lg-6 col-xl-5">
<div class="card mt-4 bg-fill">
    <div class="card-header">
        <h4>Reset Password</h4>
    </div>



    <div class="card-body">
       <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button class="btn btn-primary">Reset Password</button>
</form>

     </div>
       </div>

    </div>        

    </div>

</div>
</div>
</body>
@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Register Business'])
    @include('partials.head-css')
</head>
<body>
@include('partials.body-attr')
<div id="layout-wrapper">
    @include('layouts.navbarheader')
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row"><div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Register <span class="text-primary">New Business</span></h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.businesses') }}">Businesses</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ol>
                    </div>
                </div></div>

                <div class="row">
                    <div class="col-xl-8">

                        <!-- Step Progress -->
                        <div class="card mb-4">
                            <div class="card-body py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    @foreach([['1','Business Info','primary'],['2','Plan & Billing','secondary'],['3','Access & API','secondary'],['4','Review','secondary']] as $step)
                                    <div class="d-flex align-items-center gap-2 {{ !$loop->last ? 'flex-grow-1' : '' }}">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-{{ $step[2] }}{{ $step[2]==='secondary'?'-subtle text-muted':'' }}">{{ $step[0] }}</span>
                                        </div>
                                        <span class="fw-medium {{ $step[2]==='secondary'?'text-muted':'' }}">{{ $step[1] }}</span>
                                        @if(!$loop->last)<div class="flex-grow-1 border-top mx-2"></div>@endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Business Info -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center gap-2">
                                <div class="avatar-sm"><span class="avatar-title bg-primary-subtle text-primary rounded"><i class="ri-building-2-line fs-18"></i></span></div>
                                <div><h5 class="card-title mb-0">Business Information</h5><small class="text-muted">Core details about the business</small></div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Business Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="e.g. KFC Pakistan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Business Category</label>
                                        <select class="form-select">
                                            <option>Restaurant / Food</option><option>Retail</option><option>Pharmacy</option><option>Salon & Spa</option><option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Owner Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="e.g. Ali Raza">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Owner Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="owner@business.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="+92 300 0000000">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City / Location</label>
                                        <input type="text" class="form-control" placeholder="e.g. Lahore, Pakistan">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Business Address</label>
                                        <textarea class="form-control" rows="2" placeholder="Full address..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NTN / Registration No.</label>
                                        <input type="text" class="form-control" placeholder="Optional">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Website</label>
                                        <input type="url" class="form-control" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Plan Selection -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center gap-2">
                                <div class="avatar-sm"><span class="avatar-title bg-warning-subtle text-warning rounded"><i class="ri-vip-crown-line fs-18"></i></span></div>
                                <div><h5 class="card-title mb-0">Subscription Plan</h5><small class="text-muted">Select the plan for this business</small></div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach([['Basic','$99/mo','secondary','Up to 5 branches · 1,000 cards · Standard support'],['Premium','$299/mo','primary','Up to 20 branches · 10,000 cards · Priority support'],['Enterprise','$599/mo','warning','Unlimited branches · Unlimited cards · Dedicated support']] as $plan)
                                    <div class="col-md-4">
                                        <div class="card border mb-0 {{ $plan[2]==='primary'?'border-primary':'border-light' }} cursor-pointer" style="cursor:pointer;" onclick="selectPlan(this)">
                                            <div class="card-body text-center">
                                                @if($plan[2]==='primary')<span class="badge bg-primary mb-2">Recommended</span>@endif
                                                <h5 class="fw-bold">{{ $plan[0] }}</h5>
                                                <h3 class="text-{{ $plan[2] }} fw-bold">{{ $plan[1] }}</h3>
                                                <p class="text-muted small mb-0">{{ $plan[3] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Billing Cycle</label>
                                        <select class="form-select"><option>Monthly</option><option>Quarterly</option><option>Annually (Save 20%)</option></select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Trial Period</label>
                                        <select class="form-select"><option>No Trial</option><option>7 Days Free</option><option>14 Days Free</option><option>30 Days Free</option></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Initial VFM Cards -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center gap-2">
                                <div class="avatar-sm"><span class="avatar-title bg-info-subtle text-info rounded"><i class="ri-credit-card-line fs-18"></i></span></div>
                                <div><h5 class="card-title mb-0">Initial VFM Card Batch</h5><small class="text-muted">Cards to issue at registration</small></div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Number of Cards</label>
                                        <input type="number" class="form-control" value="100" min="10" max="10000">
                                        <div class="form-text">Cards are prefixed with VFM-</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Card Type</label>
                                        <select class="form-select"><option>Physical</option><option>Digital</option><option>Both</option></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Card Expiry</label>
                                        <select class="form-select"><option>1 Year</option><option>2 Years</option><option>5 Years</option><option>No Expiry</option></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Account -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center gap-2">
                                <div class="avatar-sm"><span class="avatar-title bg-success-subtle text-success rounded"><i class="ri-user-settings-line fs-18"></i></span></div>
                                <div><h5 class="card-title mb-0">Business Admin Account</h5><small class="text-muted">Login credentials for this business</small></div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Admin Username</label>
                                        <input type="text" class="form-control" placeholder="e.g. kfc_admin">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Admin Email</label>
                                        <input type="email" class="form-control" placeholder="admin@kfc.pk">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Temporary Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" value="TempPass@123">
                                            <button class="btn btn-soft-secondary" type="button"><i class="ri-refresh-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select class="form-select"><option>Active</option><option>Pending Verification</option></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mb-4">
                            <a href="{{ route('admin.businesses') }}" class="btn btn-light">Cancel</a>
                            <button class="btn btn-primary"><i class="ri-save-line me-1"></i>Register Business</button>
                        </div>
                    </div>

                    <!-- Right Sidebar Summary -->
                    <div class="col-xl-4">
                        <div class="card sticky-top" style="top:80px;">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-clipboard-line me-2 text-primary"></i>Registration Summary</h5></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tbody>
                                            <tr><td class="text-muted">Plan</td><td class="fw-semibold"><span class="badge bg-primary-subtle text-primary">Premium</span></td></tr>
                                            <tr><td class="text-muted">Monthly Cost</td><td class="fw-semibold text-success">$299.00</td></tr>
                                            <tr><td class="text-muted">Trial Period</td><td class="fw-semibold">14 Days</td></tr>
                                            <tr><td class="text-muted">Cards to Issue</td><td class="fw-semibold">100</td></tr>
                                            <tr><td class="text-muted">Billing Cycle</td><td class="fw-semibold">Monthly</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="alert alert-info mb-0 py-2">
                                    <i class="ri-information-line me-2"></i>
                                    <small>An email with login credentials will be automatically sent to the business owner.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@include('layouts.customizer')
@include('partials.scripts')
<script>
function selectPlan(el){document.querySelectorAll('[onclick="selectPlan(this)"]').forEach(c=>c.classList.remove('border-primary'));el.classList.add('border-primary');}
</script>
</body>
</html>
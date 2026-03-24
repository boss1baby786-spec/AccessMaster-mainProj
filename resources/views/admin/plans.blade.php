<!-- =====================================================================
     FILE: resources/views/admin/plans.blade.php
     COPY THIS CONTENT INTO THAT FILE
===================================================================== -->
@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Subscription Plans'])
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
                        <h4 class="mb-sm-0">Subscription <span class="text-primary">Plans</span></h4>
                        <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Plans</li></ol>
                    </div>
                </div></div>

                <div class="row justify-content-center">
                    @php
                    $plans = [
                        ['Basic','$99','secondary','9','1,000 cards','5 branches','Standard','Email only','Community','No','No'],
                        ['Premium','$299','primary','11','10,000 cards','20 branches','Priority','Email + Chat','Priority','Yes','No'],
                        ['Enterprise','$599','warning','4','Unlimited','Unlimited','Dedicated','24/7 Phone','Dedicated','Yes','Yes'],
                    ];
                    $features = ['Cards Allowed','Branches','Support Level','Contact Method','Account Manager','Custom Branding','White Label'];
                    @endphp
                    @foreach($plans as $p)
                    <div class="col-xl-4 col-md-6">
                        <div class="card {{ $p[2]==='primary'?'border border-primary shadow-lg':'' }} position-relative">
                            @if($p[2]==='primary')<div class="position-absolute top-0 start-50 translate-middle"><span class="badge bg-primary px-3">Most Popular</span></div>@endif
                            <div class="card-body text-center pt-4">
                                <div class="avatar-lg mx-auto mb-3">
                                    <span class="avatar-title bg-{{ $p[2] }}-subtle text-{{ $p[2] }} rounded-circle fs-24"><i class="ri-vip-crown-{{ $p[2]==='basic'?'line':'fill' }}"></i></span>
                                </div>
                                <h4 class="fw-bold">{{ $p[0] }}</h4>
                                <div class="my-3">
                                    <span class="fs-36 fw-bold text-{{ $p[2] }}">{{ $p[1] }}</span><span class="text-muted">/month</span>
                                </div>
                                <p class="text-muted small">{{ $p[3] }} active businesses</p>
                                <hr>
                                <ul class="list-unstyled text-start mb-4">
                                    @foreach([$p[4],$p[5],$p[6],$p[7],$p[8],$p[9],$p[10]] as $fi => $fv)
                                    <li class="mb-2 d-flex align-items-center gap-2">
                                        <i class="ri-checkbox-circle-fill text-{{ $p[2] }}"></i>
                                        <span class="text-muted small"><strong>{{ $features[$fi] }}:</strong> {{ $fv }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('admin.plans') }}" class="btn btn-{{ $p[2]==='primary'?'primary':'soft-'.$p[2] }} w-100">Edit Plan</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Plan Comparison Table -->
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0"><i class="ri-table-2 me-2 text-primary"></i>Businesses by Plan</h5></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light"><tr><th>Business</th><th>Current Plan</th><th>Billing Cycle</th><th>Next Renewal</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
                                <tbody>
                                    @foreach([['KFC Pakistan','Enterprise','Monthly','Jul 31, 2025','$599','Active','success'],['Pizza Hut LHR','Premium','Annual','Dec 1, 2025','$2,868','Active','success'],['Hardees Karachi','Basic','Monthly','Aug 15, 2025','$99','Trial','info'],['Savour Foods','Premium','Monthly','Aug 1, 2025','$299','Active','success'],['Burger Barn','Premium','Monthly','Jul 28, 2025','$299','Overdue','danger']] as $b)
                                    <tr>
                                        <td class="fw-medium">{{ $b[0] }}</td>
                                        <td><span class="badge bg-{{ $b[1]==='Enterprise'?'warning':($b[1]==='Premium'?'primary':'secondary') }}-subtle text-{{ $b[1]==='Enterprise'?'warning':($b[1]==='Premium'?'primary':'secondary') }}">{{ $b[1] }}</span></td>
                                        <td>{{ $b[2] }}</td><td>{{ $b[3] }}</td>
                                        <td class="fw-semibold">{{ $b[4] }}</td>
                                        <td><span class="badge bg-{{ $b[6] }}-subtle text-{{ $b[6] }}">{{ $b[5] }}</span></td>
                                        <td><a href="{{ route('admin.billing') }}" class="btn btn-soft-primary btn-sm">Manage</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
</body>
</html>
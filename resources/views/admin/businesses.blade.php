@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'All Businesses'])
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
                        <h4 class="mb-sm-0">All <span class="text-primary">Businesses</span></h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.register-business') }}" class="btn btn-primary btn-sm"><i class="ri-add-circle-line me-1"></i>Register Business</a>
                            <ol class="breadcrumb m-0 align-self-center">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Businesses</li>
                            </ol>
                        </div>
                    </div>
                </div></div>

                <!-- Summary Cards -->
                <div class="row">
                    @foreach([['Total','24','primary','ri-building-2-line'],['Active','19','success','ri-checkbox-circle-line'],['Suspended','3','danger','ri-forbid-line'],['Trial','2','info','ri-time-line']] as $s)
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted mb-2">{{ $s[0] }} Businesses</p>
                                        <h3 class="fw-semibold ff-secondary">{{ $s[1] }}</h3>
                                    </div>
                                    <div class="avatar-sm"><span class="avatar-title bg-{{ $s[2] }}-subtle rounded fs-3"><i class="{{ $s[3] }} text-{{ $s[2] }}"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Filters + Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="flex-grow-1">
                                <div class="input-group" style="max-width:320px;">
                                    <span class="input-group-text"><i class="ri-search-line"></i></span>
                                    <input type="text" class="form-control" placeholder="Search business name, owner...">
                                </div>
                            </div>
                            <select class="form-select form-select-sm w-auto">
                                <option>All Plans</option><option>Basic</option><option>Premium</option><option>Enterprise</option>
                            </select>
                            <select class="form-select form-select-sm w-auto">
                                <option>All Status</option><option>Active</option><option>Suspended</option><option>Trial</option>
                            </select>
                            <button class="btn btn-soft-secondary btn-sm"><i class="ri-download-line me-1"></i>Export</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Business</th><th>Owner</th><th>Plan</th><th>Cards Issued</th>
                                        <th>Monthly Revenue</th><th>Status</th><th>Joined</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $businesses = [
                                        ['KFC Pakistan','Ali Raza','ali@kfc.pk','Enterprise','warning',4820,'$1,200','Active','success','Jan 2024'],
                                        ['Pizza Hut LHR','Sara Khan','sara@ph.pk','Premium','primary',2310,'$890','Active','success','Feb 2024'],
                                        ['Hardees Karachi','Usman Ali','u@hardees.pk','Basic','secondary',890,'$340','Trial','info','Jun 2024'],
                                        ['CafeCito','Mia Torres','mia@cafe.com','Basic','secondary',340,'$0','Suspended','danger','Aug 2024'],
                                        ['Savour Foods','Bilal Shah','bilal@sf.pk','Premium','primary',1750,'$620','Active','success','Sep 2024'],
                                        ['Burger Barn','John Park','john@bb.com','Premium','primary',980,'$299','Active','success','Oct 2024'],
                                        ['Noodle House','Priya Nair','priya@nh.com','Basic','secondary',410,'$99','Active','success','Nov 2024'],
                                        ['The Grill Spot','Tyler Brooks','ty@grill.com','Enterprise','warning',3200,'$599','Active','success','Dec 2024'],
                                    ];
                                    @endphp
                                    @foreach($businesses as $b)
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-sm"><span class="avatar-title rounded-circle bg-primary-subtle text-primary fw-bold fs-15">{{ substr($b[0],0,1) }}</span></div>
                                                <div>
                                                    <p class="mb-0 fw-semibold">{{ $b[0] }}</p>
                                                    <small class="text-primary font-monospace">BIZ-{{ str_pad($loop->index+1,4,'0',STR_PAD_LEFT) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $b[1] }}</p>
                                            <small class="text-muted">{{ $b[2] }}</small>
                                        </td>
                                        <td><span class="badge bg-{{ $b[4] }}-subtle text-{{ $b[4] }}">{{ $b[3] }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-semibold">{{ number_format($b[5]) }}</span>
                                                <div class="progress flex-grow-1" style="height:4px;max-width:60px;"><div class="progress-bar bg-primary" style="width:{{ min(100, $b[5]/50) }}%"></div></div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold text-success">{{ $b[6] }}</td>
                                        <td><span class="badge bg-{{ $b[8] }}-subtle text-{{ $b[8] }}">{{ $b[7] }}</span></td>
                                        <td class="text-muted">{{ $b[9] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('admin.businesses') }}"><i class="ri-eye-line me-2 text-primary"></i>View Details</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.register-business') }}"><i class="ri-edit-line me-2 text-info"></i>Edit</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.api-settings') }}"><i class="ri-key-2-line me-2 text-warning"></i>Regenerate API Key</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.plans') }}"><i class="ri-vip-crown-line me-2 text-success"></i>Change Plan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="{{ route('admin.audit-logs') }}"><i class="ri-forbid-line me-2"></i>Suspend</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <p class="text-muted mb-0">Showing 1–8 of 24 businesses</p>
                            <nav><ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="{{ route('admin.businesses') }}">«</a></li>
                                <li class="page-item active"><a class="page-link" href="{{ route('admin.businesses') }}">1</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.businesses') }}">2</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.businesses') }}">3</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.businesses') }}">»</a></li>
                            </ul></nav>
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

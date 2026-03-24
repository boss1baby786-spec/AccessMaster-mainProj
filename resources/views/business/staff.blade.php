@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Staff Management'])
    @include('partials.head-css')
</head>
<body>
@include('partials.body-attr')
<div id="layout-wrapper">
    @include('layouts.navbarheader')
    @include('layouts.sidebar')
    <div class="main-content"><div class="page-content"><div class="container-fluid">

        <div class="row"><div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Staff <span class="text-primary">Management</span></h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStaffModal"><i class="ri-user-add-line me-1"></i>Add Staff</button>
                    <ol class="breadcrumb m-0 align-self-center"><li class="breadcrumb-item"><a href="{{ route('business.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Staff</li></ol>
                </div>
            </div>
        </div></div>

        <!-- Stats -->
        <div class="row">
            @foreach([['Total Staff','18','primary','ri-team-line'],['Cashiers','13','success','ri-user-line'],['Managers','4','warning','ri-shield-user-line'],['Suspended','1','danger','ri-user-forbid-line']] as $s)
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate"><div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div><p class="text-uppercase fw-medium text-muted mb-2">{{ $s[0] }}</p><h3 class="ff-secondary fw-semibold">{{ $s[1] }}</h3></div>
                        <div class="avatar-sm"><span class="avatar-title bg-{{ $s[2] }}-subtle rounded fs-3"><i class="{{ $s[3] }} text-{{ $s[2] }}"></i></span></div>
                    </div>
                </div></div>
            </div>
            @endforeach
        </div>

        <!-- Staff Table -->
        <div class="card">
            <div class="card-header d-flex align-items-center flex-wrap gap-2">
                <div class="input-group" style="max-width:280px;"><span class="input-group-text"><i class="ri-search-line"></i></span><input type="text" class="form-control" placeholder="Search staff..."></div>
                <select class="form-select form-select-sm w-auto"><option>All Branches</option><option>KFC – Downtown</option><option>KFC – Airport</option><option>KFC – Mall Plaza</option><option>KFC – Midtown</option></select>
                <select class="form-select form-select-sm w-auto"><option>All Roles</option><option>Cashier</option><option>Branch Manager</option></select>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr><th>Staff</th><th>Role</th><th>Branch</th><th>Joined</th><th>Txns Today</th><th>Status</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @php
                            $staff = [
                                ['Maria Chen','maria@kfc.pk','Cashier','KFC – Downtown','Jan 2024',24,'Active','success'],
                                ['James Okoro','james@kfc.pk','Branch Manager','KFC – Airport','Mar 2023',0,'Active','success'],
                                ['Sofia Reyes','sofia@kfc.pk','Cashier','KFC – Mall Plaza','Sep 2024',18,'Active','success'],
                                ['Tyler Brooks','tyler@kfc.pk','Cashier','KFC – Midtown','Jun 2024',0,'Suspended','danger'],
                                ['Priya Nair','priya@kfc.pk','Branch Manager','KFC – Downtown','Dec 2022',0,'Active','success'],
                                ['Lee Min','lee@kfc.pk','Cashier','KFC – Airport','Feb 2025',31,'Active','success'],
                                ['Amy Liang','amy@kfc.pk','Cashier','KFC – Midtown','Apr 2025',15,'Active','success'],
                            ];
                            @endphp
                            @foreach($staff as $s)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sm"><span class="avatar-title rounded-circle bg-primary-subtle text-primary fw-bold">{{ substr($s[0],0,1) }}</span></div>
                                        <div><p class="mb-0 fw-medium">{{ $s[0] }}</p><small class="text-muted">{{ $s[1] }}</small></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-{{ $s[2]==='Branch Manager'?'warning':'info' }}-subtle text-{{ $s[2]==='Branch Manager'?'warning':'info' }}">{{ $s[2] }}</span></td>
                                <td class="text-muted">{{ $s[3] }}</td>
                                <td class="text-muted">{{ $s[4] }}</td>
                                <td><span class="fw-semibold">{{ $s[5] }}</span></td>
                                <td><span class="badge bg-{{ $s[7] }}-subtle text-{{ $s[7] }}">{{ $s[6] }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="ri-edit-line me-2 text-info"></i>Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-swap-line me-2 text-warning"></i>Transfer Branch</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-lock-password-line me-2 text-primary"></i>Reset Password</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="ri-user-forbid-line me-2"></i>{{ $s[6]==='Active'?'Suspend':'Activate' }}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div></div>
        @include('layouts.footer')
    </div>
</div>

<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title"><i class="ri-user-add-line me-2 text-primary"></i>Add New Staff</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-6"><label class="form-label">Full Name</label><input type="text" class="form-control" placeholder="e.g. Alex Johnson"></div>
                <div class="col-6"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="alex@kfc.pk"></div>
                <div class="col-6"><label class="form-label">Role</label><select class="form-select"><option>Cashier</option><option>Branch Manager</option></select></div>
                <div class="col-6"><label class="form-label">Assign to Branch</label><select class="form-select"><option>KFC – Downtown</option><option>KFC – Airport</option><option>KFC – Mall Plaza</option><option>KFC – Midtown</option></select></div>
                <div class="col-6"><label class="form-label">Phone</label><input type="text" class="form-control" placeholder="+92 300 0000000"></div>
                <div class="col-6"><label class="form-label">Temp Password</label><input type="password" class="form-control" value="Pass@1234"></div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Add Staff</button></div>
    </div></div>
</div>

@include('layouts.customizer')
@include('partials.scripts')
</body>
</html>
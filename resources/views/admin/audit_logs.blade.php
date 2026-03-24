@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Audit Logs'])
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
                        <h4 class="mb-sm-0">Audit <span class="text-primary">Logs</span></h4>
                        <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Audit Logs</li></ol>
                    </div>
                </div></div>

                <!-- Filters -->
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Search</label>
                                <div class="input-group"><span class="input-group-text"><i class="ri-search-line"></i></span><input type="text" class="form-control" placeholder="Action, user, entity..."></div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Action Type</label>
                                <select class="form-select"><option>All</option><option>Create</option><option>Update</option><option>Delete</option><option>Login</option><option>Suspend</option></select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Actor</label>
                                <select class="form-select"><option>All Users</option><option>Super Admin</option><option>Business Admin</option><option>System</option></select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Date From</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Date To</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary w-100"><i class="ri-filter-3-line"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logs Table -->
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0"><i class="ri-file-list-3-line me-2 text-primary"></i>All Audit Events</h5>
                        <button class="btn btn-soft-secondary btn-sm"><i class="ri-download-line me-1"></i>Export</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr><th>Timestamp</th><th>Actor</th><th>Action</th><th>Entity</th><th>Details</th><th>IP Address</th><th>Status</th></tr>
                                </thead>
                                <tbody>
                                    @php
                                    $logs = [
                                        ['2025-07-15 09:42','Super Admin','Create','Business','Registered Savour Foods (Premium Plan)','192.168.1.1','success','Success'],
                                        ['2025-07-15 09:38','Super Admin','Update','Plan','Changed KFC Pakistan from Premium to Enterprise','192.168.1.1','info','Success'],
                                        ['2025-07-15 09:15','System','Suspend','Business','Auto-suspended CafeCito — overdue 14 days','0.0.0.0','warning','Auto'],
                                        ['2025-07-15 08:55','ops@admin.com','Delete','User','Removed user tyler.b from system','10.0.0.5','danger','Success'],
                                        ['2025-07-15 08:30','Super Admin','Create','Cards','Issued 100 VFM cards to KFC Pakistan (batch BK-0892)','192.168.1.1','success','Success'],
                                        ['2025-07-15 08:12','ali@kfc.pk','Login','Auth','Business admin login from new device','103.12.45.88','info','Success'],
                                        ['2025-07-15 07:55','Super Admin','Update','Permissions','Granted cashier role to Sofia Reyes','192.168.1.1','info','Success'],
                                        ['2025-07-14 22:10','System','Notify','Subscription','Renewal reminder sent to Burger Barn','0.0.0.0','warning','Auto'],
                                        ['2025-07-14 18:30','Super Admin','Update','API Key','Regenerated API key for Hardees Karachi','192.168.1.1','warning','Success'],
                                        ['2025-07-14 15:00','priya@sf.pk','Login','Auth','Failed login attempt — wrong password','185.22.3.4','danger','Failed'],
                                    ];
                                    @endphp
                                    @foreach($logs as $l)
                                    <tr>
                                        <td><small class="font-monospace text-muted">{{ $l[0] }}</small></td>
                                        <td><span class="fw-medium">{{ $l[1] }}</span></td>
                                        <td><span class="badge bg-{{ $l[5] }}-subtle text-{{ $l[5] }}">{{ $l[2] }}</span></td>
                                        <td>{{ $l[3] }}</td>
                                        <td><small class="text-muted">{{ $l[4] }}</small></td>
                                        <td><small class="font-monospace text-muted">{{ $l[5]==='0.0.0.0'?'System':$l[5] }}</small></td>
                                        <td><span class="badge bg-{{ $l[6] }}-subtle text-{{ $l[6] }}">{{ $l[7] }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <p class="text-muted mb-0">Showing 1–10 of 1,247 events</p>
                            <nav><ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="{{ route('admin.audit-logs') }}">«</a></li>
                                <li class="page-item active"><a class="page-link" href="{{ route('admin.audit-logs') }}">1</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.audit-logs') }}">2</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.audit-logs') }}">»</a></li>
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
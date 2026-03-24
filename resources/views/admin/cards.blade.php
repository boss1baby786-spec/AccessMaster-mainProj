@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'VFM Card Registry'])
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
                        <h4 class="mb-sm-0">VFM <span class="text-primary">Card Registry</span></h4>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#issueCardsModal"><i class="ri-add-circle-line me-1"></i>Issue Cards</button>
                            <ol class="breadcrumb m-0 align-self-center"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Cards</li></ol>
                        </div>
                    </div>
                </div></div>

                <!-- Stats -->
                <div class="row">
                    @foreach([['Total Issued','18,427','primary','ri-credit-card-fill','+142 today'],['Active','16,890','success','ri-checkbox-circle-fill','89.5% active rate'],['Blocked','234','danger','ri-forbid-fill','Fraud/lost'],['Unregistered','1,303','warning','ri-user-unfollow-fill','Awaiting owner']] as $s)
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted mb-2">{{ $s[0] }}</p>
                                        <h3 class="fw-semibold ff-secondary mb-1">{{ $s[1] }}</h3>
                                        <small class="text-muted">{{ $s[4] }}</small>
                                    </div>
                                    <div class="avatar-sm"><span class="avatar-title bg-{{ $s[2] }}-subtle rounded fs-3"><i class="{{ $s[3] }} text-{{ $s[2] }}"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Search + Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="input-group" style="max-width:300px;">
                                <span class="input-group-text"><i class="ri-search-line"></i></span>
                                <input type="text" class="form-control" placeholder="Search VFM card no., name..." value="{{ request('q', '') }}">
                            </div>
                            <select class="form-select form-select-sm w-auto"><option>All Status</option><option>Active</option><option>Blocked</option><option>Unregistered</option></select>
                            <select class="form-select form-select-sm w-auto"><option>All Businesses</option><option>KFC Pakistan</option><option>Pizza Hut LHR</option></select>
                            <select class="form-select form-select-sm w-auto"><option>All Tiers</option><option>Bronze</option><option>Silver</option><option>Gold</option><option>Platinum</option></select>
                            <button class="btn btn-soft-secondary btn-sm ms-auto"><i class="ri-download-line me-1"></i>Export CSV</button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr><th>Card No.</th><th>Owner</th><th>Business</th><th>Tier</th><th>Points</th><th>Status</th><th>Issued</th><th>Last Used</th><th>Actions</th></tr>
                                </thead>
                                <tbody>
                                    @php
                                    $cards = [
                                        ['VFM-4482','Maria Chen','maria@email.com','KFC Pakistan','Gold','warning',1840,'Active','success','Jan 2024','2 hrs ago'],
                                        ['VFM-7731','James Okoro','james@email.com','Pizza Hut LHR','Silver','secondary',320,'Active','success','Mar 2023','Yesterday'],
                                        ['VFM-1190','Sofia Reyes','sofia@email.com','KFC Pakistan','Platinum','info',5500,'Active','success','Dec 2022','3 hrs ago'],
                                        ['VFM-8843','Tyler Brooks','tyler@email.com','Hardees Karachi','Bronze','secondary',90,'Active','success','Jun 2024','1 week ago'],
                                        ['VFM-3356','Priya Nair','priya@email.com','Savour Foods','Gold','warning',2210,'Active','success','Sep 2023','Today'],
                                        ['VFM-9021','—','—','KFC Pakistan','—','muted',0,'Unregistered','warning','Feb 2025','Never'],
                                        ['VFM-5544','John Park','john@email.com','Pizza Hut LHR','Silver','secondary',650,'Blocked','danger','Apr 2024','2 weeks ago'],
                                    ];
                                    $tierColors=['Gold'=>'warning','Silver'=>'secondary','Platinum'=>'info','Bronze'=>'secondary'];
                                    @endphp
                                    @foreach($cards as $c)
                                    <tr>
                                        <td><span class="font-monospace fw-semibold text-primary">{{ $c[0] }}</span></td>
                                        <td>
                                            <p class="mb-0 fw-medium">{{ $c[1] }}</p>
                                            <small class="text-muted">{{ $c[2] }}</small>
                                        </td>
                                        <td>{{ $c[3] }}</td>
                                        <td>
                                            @if($c[4] !== '—')
                                            <span class="badge bg-{{ $c[5] }}-subtle text-{{ $c[5] }}">{{ $c[4] }}</span>
                                            @else<span class="text-muted">—</span>@endif
                                        </td>
                                        <td class="fw-semibold">{{ number_format($c[6]) }}</td>
                                        <td><span class="badge bg-{{ $c[8] }}-subtle text-{{ $c[8] }}">{{ $c[7] }}</span></td>
                                        <td class="text-muted">{{ $c[9] }}</td>
                                        <td class="text-muted">{{ $c[10] }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.cards') }}" class="btn btn-soft-primary btn-sm" title="View"><i class="ri-eye-line"></i></a>
                                                <a href="{{ route('admin.cards') }}" class="btn btn-soft-warning btn-sm" title="Transfer"><i class="ri-swap-line"></i></a>
                                                @if($c[7]==='Active')
                                                <a href="{{ route('admin.audit-logs') }}" class="btn btn-soft-danger btn-sm" title="Block"><i class="ri-forbid-line"></i></a>
                                                @else
                                                <a href="{{ route('admin.audit-logs') }}" class="btn btn-soft-success btn-sm" title="Unblock"><i class="ri-checkbox-circle-line"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <p class="text-muted mb-0">Showing 1–7 of 18,427 cards</p>
                            <nav><ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="{{ route('admin.cards') }}">«</a></li>
                                <li class="page-item active"><a class="page-link" href="{{ route('admin.cards') }}">1</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.cards') }}">2</a></li>
                                <li class="page-item"><a class="page-link" href="{{ route('admin.cards') }}">»</a></li>
                            </ul></nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>

<!-- Issue Cards Modal -->
<div class="modal fade" id="issueCardsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-credit-card-line me-2 text-primary"></i>Issue VFM Cards</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Assign to Business</label>
                    <select class="form-select"><option>KFC Pakistan</option><option>Pizza Hut LHR</option><option>Hardees Karachi</option></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Number of Cards to Issue</label>
                    <input type="number" class="form-control" value="50" min="1" max="10000">
                    <div class="form-text">Cards will be auto-numbered (e.g. VFM-5001 to VFM-5050)</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Card Type</label>
                    <div class="d-flex gap-2">
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="ctype" checked><label class="form-check-label">Physical</label></div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="ctype"><label class="form-check-label">Digital</label></div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="ctype"><label class="form-check-label">Both</label></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Card Validity</label>
                    <select class="form-select"><option>2 Years</option><option>1 Year</option><option>5 Years</option><option>No Expiry</option></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ri-add-circle-line me-1"></i>Issue Cards</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.customizer')
@include('partials.scripts')
</body>
</html>
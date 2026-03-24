@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'My Branches'])
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
                <h4 class="mb-sm-0">My <span class="text-primary">Branches</span></h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBranchModal"><i class="ri-add-circle-line me-1"></i>Add Branch</button>
                    <ol class="breadcrumb m-0 align-self-center"><li class="breadcrumb-item"><a href="{{ route('business.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Branches</li></ol>
                </div>
            </div>
        </div></div>

        <div class="row">
            @php
            $branches = [
                ['KFC – Downtown','New York','1,842','92,100','Live','success',4,'78%'],
                ['KFC – Airport','JFK Airport','2,310','115,500','Live','success',6,'100%'],
                ['KFC – Mall Plaza','Brooklyn','987','49,350','Offline','danger',3,'42%'],
                ['KFC – Midtown','Manhattan','1,560','78,000','Live','success',5,'66%'],
            ];
            @endphp
            @foreach($branches as $b)
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-md"><span class="avatar-title bg-primary-subtle text-primary rounded fs-22"><i class="ri-store-2-line"></i></span></div>
                                <div>
                                    <h5 class="mb-0 fw-semibold">{{ $b[0] }}</h5>
                                    <small class="text-muted"><i class="ri-map-pin-line me-1"></i>{{ $b[1] }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <span class="badge bg-{{ $b[5] }}-subtle text-{{ $b[5] }}"><i class="ri-radio-button-line me-1"></i>{{ $b[4] }}</span>
                                <div class="dropdown"><button class="btn btn-soft-secondary btn-sm" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ri-user-add-line me-2"></i>Assign Cashier</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="ri-pause-circle-line me-2"></i>Deactivate</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 text-center mb-3">
                            <div class="col-4"><div class="bg-primary-subtle rounded p-2"><div class="fw-bold text-primary">{{ number_format($b[2]) }}</div><div class="text-muted" style="font-size:10px;">Total Swipes</div></div></div>
                            <div class="col-4"><div class="bg-warning-subtle rounded p-2"><div class="fw-bold text-warning">{{ number_format($b[3]) }}</div><div class="text-muted" style="font-size:10px;">Points Issued</div></div></div>
                            <div class="col-4"><div class="bg-success-subtle rounded p-2"><div class="fw-bold text-success">{{ $b[6] }}</div><div class="text-muted" style="font-size:10px;">Cashiers</div></div></div>
                        </div>
                        <div class="mb-1 d-flex justify-content-between"><small class="text-muted">Monthly Activity</small><small class="fw-semibold">{{ $b[7] }}</small></div>
                        <div class="progress" style="height:6px;"><div class="progress-bar bg-{{ $b[5] }}" style="width:{{ $b[7] }};"></div></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div></div>
        @include('layouts.footer')
    </div>
</div>

<div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title"><i class="ri-store-2-line me-2 text-primary"></i>Add New Branch</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Branch Name <span class="text-danger">*</span></label><input type="text" class="form-control" placeholder="e.g. KFC – Times Square"></div>
            <div class="mb-3"><label class="form-label">City / Location</label><input type="text" class="form-control" placeholder="e.g. New York"></div>
            <div class="mb-3"><label class="form-label">Full Address</label><textarea class="form-control" rows="2"></textarea></div>
            <div class="mb-3"><label class="form-label">Manager Name</label><input type="text" class="form-control" placeholder="e.g. James Okoro"></div>
        </div>
        <div class="modal-footer"><button class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Create Branch</button></div>
    </div></div>
</div>

@include('layouts.customizer')
@include('partials.scripts')
</body>
</html>
@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Reward Catalog'])
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
                <h4 class="mb-sm-0">Reward <span class="text-primary">Catalog</span></h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRewardModal"><i class="ri-add-circle-line me-1"></i>Add Reward</button>
                    <ol class="breadcrumb m-0 align-self-center"><li class="breadcrumb-item"><a href="{{ route('business.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Rewards</li></ol>
                </div>
            </div>
        </div></div>

        <div class="row">
            @php
            $rewards = [
                ['Free Zinger Burger','500 pts',87,100,'Dec 31, 2025','Active','success','ri-hamburger-line'],
                ['50% Discount Voucher','300 pts',12,50,'Sep 30, 2025','Active','warning','ri-price-tag-3-line'],
                ['Mega Meal Deal','800 pts',0,30,'Aug 01, 2025','Out of Stock','danger','ri-bowl-line'],
                ['Birthday Bucket','1200 pts',20,20,'Jan 01, 2026','Active','primary','ri-cake-2-line'],
                ['Free Fries Combo','250 pts',45,60,'Nov 15, 2025','Active','info','ri-restaurant-2-line'],
                ['VIP Table Booking','2000 pts',5,10,'Dec 31, 2025','Active','secondary','ri-vip-crown-line'],
            ];
            @endphp
            @foreach($rewards as $r)
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="avatar-md"><span class="avatar-title bg-{{ $r[6] }}-subtle text-{{ $r[6] }} rounded fs-24"><i class="{{ $r[7] }}"></i></span></div>
                            <div class="d-flex gap-1">
                                <span class="badge bg-{{ $r[5]==='Active'?'success':($r[5]==='Out of Stock'?'danger':'warning') }}-subtle text-{{ $r[5]==='Active'?'success':($r[5]==='Out of Stock'?'danger':'warning') }}">{{ $r[5] }}</span>
                                <div class="dropdown"><button class="btn btn-soft-secondary btn-sm" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="ri-edit-line me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ri-pause-circle-line me-2"></i>Pause</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h5 class="fw-semibold mb-1">{{ $r[0] }}</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-warning-subtle text-warning"><i class="ri-coin-line me-1"></i>{{ $r[1] }}</span>
                            <small class="text-muted">Exp: {{ $r[4] }}</small>
                        </div>
                        <!-- Stock Progress -->
                        <div class="mb-2">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Stock</small>
                                <small class="fw-medium {{ $r[2]==0?'text-danger':($r[2]<=$r[3]*0.25?'text-warning':'text-success') }}">{{ $r[2] }} / {{ $r[3] }}</small>
                            </div>
                            <div class="progress" style="height:6px;">
                                <div class="progress-bar bg-{{ $r[2]==0?'danger':($r[2]<=$r[3]*0.25?'warning':'success') }}" style="width:{{ $r[3]>0?($r[2]/$r[3]*100):0 }}%;"></div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-soft-primary btn-sm flex-grow-1"><i class="ri-edit-line me-1"></i>Edit</button>
                            @if($r[5]==='Active')
                            <button class="btn btn-soft-warning btn-sm"><i class="ri-pause-circle-line"></i></button>
                            @else
                            <button class="btn btn-soft-success btn-sm"><i class="ri-play-circle-line"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div></div>
        @include('layouts.footer')
    </div>
</div>

<div class="modal fade" id="addRewardModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title"><i class="ri-gift-line me-2 text-primary"></i>Add New Reward</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-12"><label class="form-label">Reward Name</label><input type="text" class="form-control" placeholder="e.g. Free Twister Wrap"></div>
                <div class="col-6"><label class="form-label">Point Cost</label><input type="number" class="form-control" placeholder="e.g. 500"></div>
                <div class="col-6"><label class="form-label">Stock Limit</label><input type="number" class="form-control" placeholder="e.g. 100"></div>
                <div class="col-6"><label class="form-label">Valid Until</label><input type="date" class="form-control"></div>
                <div class="col-6"><label class="form-label">Category</label><select class="form-select"><option>Food Item</option><option>Discount</option><option>Voucher</option><option>Experience</option></select></div>
                <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" rows="2" placeholder="Brief description..."></textarea></div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Add Reward</button></div>
    </div></div>
</div>

@include('layouts.customizer')
@include('partials.scripts')
</body>
</html>
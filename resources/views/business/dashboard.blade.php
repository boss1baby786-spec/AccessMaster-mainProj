@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Business Admin Dashboard'])
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
                        <div>
                            <h4 class="mb-0">KFC Pakistan <span class="text-primary">— Business Dashboard</span></h4>
                            <small class="text-muted"><span class="badge bg-warning-subtle text-warning me-1">Enterprise Plan</span> 4 Active Branches · API Connected</small>
                        </div>
                        <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="#">AccessMaster</a></li><li class="breadcrumb-item active">Business Dashboard</li></ol>
                    </div>
                </div></div>

                <!-- KPI Cards -->
                <div class="row">
                    @php
                    $bKpis = [
                        ['Today\'s Swipes','847','ri-swap-line','primary','+12% vs yesterday'],
                        ['Points Issued Today','84,700 pts','ri-gift-line','warning','Standard rate'],
                        ['Active Customers','16,890','ri-users-line','success','+3.2% this week'],
                        ['Pending Redemptions','23','ri-time-line','danger','Needs approval'],
                    ];
                    @endphp
                    @foreach($bKpis as $k)
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted mb-2">{{ $k[0] }}</p>
                                        <h4 class="fw-semibold ff-secondary mb-1">{{ $k[1] }}</h4>
                                        <small class="text-muted">{{ $k[4] }}</small>
                                    </div>
                                    <div class="avatar-sm"><span class="avatar-title bg-{{ $k[3] }}-subtle rounded fs-3"><i class="{{ $k[2] }} text-{{ $k[3] }}"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="ri-line-chart-line me-2 text-primary"></i>Points Activity (Last 7 Days)</h5>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-primary-subtle text-primary"><i class="ri-circle-fill me-1 fs-10"></i>Earned</span>
                                    <span class="badge bg-warning-subtle text-warning"><i class="ri-circle-fill me-1 fs-10"></i>Redeemed</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="pointsChart" style="height:260px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-bar-chart-grouped-line me-2 text-warning"></i>Branch Performance</h5></div>
                            <div class="card-body p-0">
                                @php
                                $branches = [
                                    ['KFC – Downtown','1,842 swipes','92,100 pts','Live','success',78],
                                    ['KFC – Airport','2,310 swipes','115,500 pts','Live','success',100],
                                    ['KFC – Mall Plaza','987 swipes','49,350 pts','Offline','danger',42],
                                    ['KFC – Midtown','1,560 swipes','78,000 pts','Live','success',66],
                                ];
                                @endphp
                                <ul class="list-group list-group-flush">
                                    @foreach($branches as $br)
                                    <li class="list-group-item px-3 py-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="fw-medium small">{{ $br[0] }}</span>
                                            <span class="badge bg-{{ $br[4] }}-subtle text-{{ $br[4] }} fs-10">{{ $br[3] }}</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress flex-grow-1" style="height:5px;"><div class="progress-bar bg-primary" style="width:{{ $br[5] }}%"></div></div>
                                            <small class="text-muted">{{ $br[1] }}</small>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="p-3">
                                    <a href="{{ route('business.branches') }}" class="btn btn-soft-primary btn-sm w-100">Manage Branches</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Queue + Reward Catalog -->
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="ri-checkbox-circle-line me-2 text-warning"></i>Approval Queue
                                    <span class="badge bg-danger ms-2">23</span>
                                </h5>
                                <a href="{{ route('business.approval-queue') }}" class="btn btn-soft-primary btn-sm">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr><th>Card No.</th><th>Reward</th><th>Points</th><th>Branch</th><th>Time</th><th>Action</th></tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $queue = [
                                                ['VFM-4482','Free Zinger Burger',500,'Downtown','2 min ago'],
                                                ['VFM-7731','50% Discount Voucher',300,'Airport','5 min ago'],
                                                ['VFM-1190','Free Fries Combo',250,'Midtown','11 min ago'],
                                                ['VFM-8843','Mega Meal Deal',800,'Downtown','14 min ago'],
                                                ['VFM-3356','Birthday Bucket',1200,'Mall Plaza','22 min ago'],
                                            ];
                                            @endphp
                                            @foreach($queue as $q)
                                            <tr>
                                                <td><span class="font-monospace text-primary fw-medium">{{ $q[0] }}</span></td>
                                                <td class="fw-medium">{{ $q[1] }}</td>
                                                <td><span class="badge bg-warning-subtle text-warning">{{ number_format($q[2]) }} pts</span></td>
                                                <td><small class="text-muted">{{ $q[3] }}</small></td>
                                                <td><small class="text-muted">{{ $q[4] }}</small></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-soft-success btn-sm"><i class="ri-check-line"></i></button>
                                                        <button class="btn btn-soft-danger btn-sm"><i class="ri-close-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <!-- Point Rules -->
                        <div class="card mb-3">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="ri-settings-3-line me-2 text-success"></i>Active Point Rules</h5>
                                <a href="{{ route('business.point-rules') }}" class="btn btn-soft-success btn-sm">Manage</a>
                            </div>
                            <div class="card-body p-0">
                                @php
                                $rules = [
                                    ['Standard Spend','$1 = 10 pts','success','Active'],
                                    ['Weekend Bonus','Sat–Sun × 1.5','warning','Active'],
                                    ['Buy 5 Meals','5th meal = +500 pts','info','Paused'],
                                    ['First Visit','New card = +200 pts','primary','Active'],
                                ];
                                @endphp
                                <ul class="list-group list-group-flush">
                                    @foreach($rules as $r)
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-3 py-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-price-tag-3-line text-{{ $r[2] }}"></i>
                                            <div>
                                                <p class="mb-0 small fw-medium">{{ $r[0] }}</p>
                                                <small class="text-muted">{{ $r[1] }}</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-{{ $r[3]==='Active'?'success':'warning' }}-subtle text-{{ $r[3]==='Active'?'success':'warning' }}">{{ $r[3] }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0"><i class="ri-flashlight-line me-2 text-warning"></i>Quick Actions</h5></div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('business.staff') }}" class="btn btn-soft-primary btn-sm text-start"><i class="ri-user-add-line me-2"></i>Add Staff / Cashier</a>
                                    <a href="{{ route('business.rewards') }}" class="btn btn-soft-success btn-sm text-start"><i class="ri-gift-line me-2"></i>Add New Reward</a>
                                    <a href="{{ route('business.coupons') }}" class="btn btn-soft-warning btn-sm text-start"><i class="ri-coupon-line me-2"></i>Create Coupon</a>
                                    <a href="{{ route('business.customer-lookup') }}" class="btn btn-soft-info btn-sm text-start"><i class="ri-search-eye-line me-2"></i>Customer Lookup</a>
                                    <a href="{{ route('business.ledger') }}" class="btn btn-soft-secondary btn-sm text-start"><i class="ri-file-chart-line me-2"></i>View Brand Ledger</a>
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
var pOpts={chart:{type:'area',height:260,toolbar:{show:false}},series:[{name:'Points Earned',data:[82000,94000,71000,112000,98000,134000,84700]},{name:'Points Redeemed',data:[12000,18000,9000,24000,15000,31000,19000]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},colors:['#405189','#f7b84b'],fill:{type:'gradient',gradient:{shadeIntensity:.8,opacityFrom:.4,opacityTo:.1}},dataLabels:{enabled:false},stroke:{curve:'smooth',width:2},grid:{borderColor:'rgba(0,0,0,0.05)'}};
if(document.getElementById('pointsChart')) new ApexCharts(document.getElementById('pointsChart'),pOpts).render();
</script>
</body>
</html>
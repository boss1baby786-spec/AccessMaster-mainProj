@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Billing'])
    @include('partials.head-css')
</head>

<body>
@include('partials.body-attr')

<div id="layout-wrapper">
    @include('partials.topbar')
    @include('layouts.sidebar')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('partials.page-title', ['title' => 'Billing', 'pagetitle' => 'AccessMaster'])

                {{-- Alert: Upcoming Renewals --}}
                <div class="alert alert-warning alert-border-left alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="ri-error-warning-line me-2 fs-16"></i>
                    <div>
                        <strong>3 businesses</strong> have subscription renewals due within 7 days.
                        <a href="#renewals-table" class="alert-link ms-1">View Details</a>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>

                {{-- ===================== STATS ROW ===================== --}}
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Monthly Revenue (MRR)</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="14820">$14,820</span>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> 12.4%
                                            </span> vs last month
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="ri-money-dollar-circle-line text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Active Subscriptions</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">19</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-success-subtle text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> 3
                                            </span> new this month
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="ri-checkbox-circle-line text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Overdue Payments</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold text-danger">2</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-danger-subtle text-danger mb-0">
                                                <i class="ri-error-warning-line align-middle"></i> Action needed
                                            </span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger-subtle rounded fs-3">
                                            <i class="ri-timer-flash-line text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Annual Revenue Run Rate</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">$177,840</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-info-subtle text-info mb-0">
                                                <i class="ri-calendar-line align-middle"></i> Projected
                                            </span>
                                        </p>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="ri-bar-chart-grouped-line text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ===================== END STATS ===================== --}}

                {{-- ===================== CHARTS ROW ===================== --}}
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="ri-line-chart-line me-1 text-primary"></i> Revenue Overview (6 Months)
                                </h5>
                                <div class="flex-shrink-0">
                                    <select class="form-select form-select-sm">
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Quarterly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="revenueChart" style="height: 260px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="ri-pie-chart-2-line me-1 text-primary"></i> Plan Distribution
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="planDonut" style="height: 210px;"></div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span><span class="badge bg-primary me-1">&nbsp;</span> Basic</span>
                                        <span class="fw-semibold">9 businesses</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span><span class="badge bg-success me-1">&nbsp;</span> Premium</span>
                                        <span class="fw-semibold">11 businesses</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><span class="badge bg-warning me-1">&nbsp;</span> Enterprise</span>
                                        <span class="fw-semibold">4 businesses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ===================== END CHARTS ===================== --}}

                {{-- ===================== BILLING TABLE ===================== --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="renewals-table">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="ri-file-list-3-line me-1 text-primary"></i> All Business Billing
                                </h5>
                                <div class="d-flex gap-2 flex-shrink-0">
                                    <select class="form-select form-select-sm" style="width: 130px;">
                                        <option>All Plans</option>
                                        <option>Basic</option>
                                        <option>Premium</option>
                                        <option>Enterprise</option>
                                    </select>
                                    <select class="form-select form-select-sm" style="width: 130px;">
                                        <option>All Status</option>
                                        <option>Active</option>
                                        <option>Overdue</option>
                                        <option>Trial</option>
                                        <option>Cancelled</option>
                                    </select>
                                    <a href="{{ route('admin.billing') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="ri-download-2-line me-1"></i> Export
                                    </a>
                                    <a href="{{ route('admin.billing') }}" class="btn btn-sm btn-primary">
                                        <i class="ri-add-line me-1"></i> New Invoice
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="form-check-input">
                                                </th>
                                                <th scope="col">Business</th>
                                                <th scope="col">Plan</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Billing Cycle</th>
                                                <th scope="col">Last Payment</th>
                                                <th scope="col">Next Renewal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $billings = [
                                                ['name'=>'KFC Pakistan',    'code'=>'BIZ-0001', 'plan'=>'Enterprise', 'plan_color'=>'danger',  'amount'=>'$1,200', 'cycle'=>'Monthly', 'last'=>'Mar 01, 2026', 'next'=>'Apr 01, 2026', 'status'=>'Active',    'status_color'=>'success'],
                                                ['name'=>'Pizza Hut LHR',  'code'=>'BIZ-0002', 'plan'=>'Premium',    'plan_color'=>'primary', 'amount'=>'$890',   'cycle'=>'Monthly', 'last'=>'Mar 01, 2026', 'next'=>'Apr 01, 2026', 'status'=>'Active',    'status_color'=>'success'],
                                                ['name'=>'Hardees Karachi','code'=>'BIZ-0003', 'plan'=>'Basic',      'plan_color'=>'info',    'amount'=>'$340',   'cycle'=>'Monthly', 'last'=>'Feb 01, 2026', 'next'=>'Mar 01, 2026', 'status'=>'Overdue',   'status_color'=>'danger'],
                                                ['name'=>'Burger King ISB','code'=>'BIZ-0004', 'plan'=>'Premium',    'plan_color'=>'primary', 'amount'=>'$890',   'cycle'=>'Monthly', 'last'=>'Mar 05, 2026', 'next'=>'Apr 05, 2026', 'status'=>'Active',    'status_color'=>'success'],
                                                ['name'=>'Subway Lahore',  'code'=>'BIZ-0005', 'plan'=>'Basic',      'plan_color'=>'info',    'amount'=>'$340',   'cycle'=>'Monthly', 'last'=>'—',            'next'=>'Mar 15, 2026', 'status'=>'Trial',     'status_color'=>'warning'],
                                                ['name'=>'McDonald\'s DHA','code'=>'BIZ-0006', 'plan'=>'Enterprise', 'plan_color'=>'danger',  'amount'=>'$1,200', 'cycle'=>'Monthly', 'last'=>'Feb 28, 2026', 'next'=>'Mar 28, 2026', 'status'=>'Overdue',   'status_color'=>'danger'],
                                                ['name'=>'Dunkin Donuts',  'code'=>'BIZ-0007', 'plan'=>'Basic',      'plan_color'=>'info',    'amount'=>'$340',   'cycle'=>'Monthly', 'last'=>'Mar 03, 2026', 'next'=>'Apr 03, 2026', 'status'=>'Active',    'status_color'=>'success'],
                                                ['name'=>'Gloria Jean\'s', 'code'=>'BIZ-0008', 'plan'=>'Premium',    'plan_color'=>'primary', 'amount'=>'$890',   'cycle'=>'Annual',  'last'=>'Jan 01, 2026', 'next'=>'Jan 01, 2027', 'status'=>'Active',    'status_color'=>'success'],
                                            ];
                                            @endphp

                                            @foreach($billings as $b)
                                            <tr>
                                                <td><input type="checkbox" class="form-check-input"></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar-xs flex-shrink-0">
                                                            <span class="avatar-title rounded-circle bg-primary-subtle text-primary fw-bold">
                                                                {{ strtoupper(substr($b['name'], 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $b['name'] }}</h6>
                                                            <small class="text-muted">{{ $b['code'] }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $b['plan_color'] }}-subtle text-{{ $b['plan_color'] }} fs-12">
                                                        {{ $b['plan'] }}
                                                    </span>
                                                </td>
                                                <td class="fw-semibold text-success">{{ $b['amount'] }}</td>
                                                <td>{{ $b['cycle'] }}</td>
                                                <td class="text-muted">{{ $b['last'] }}</td>
                                                <td>
                                                    @if($b['status'] === 'Overdue')
                                                        <span class="text-danger fw-semibold">{{ $b['next'] }}</span>
                                                    @else
                                                        {{ $b['next'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $b['status_color'] }}-subtle text-{{ $b['status_color'] }}">
                                                        {{ $b['status'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ri-more-2-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('admin.billing') }}">
                                                                    <i class="ri-eye-line me-2 text-muted"></i> View Invoice
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('admin.billing') }}">
                                                                    <i class="ri-refresh-line me-2 text-muted"></i> Renew Now
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('admin.plans') }}">
                                                                    <i class="ri-arrow-up-circle-line me-2 text-primary"></i> Upgrade Plan
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="{{ route('admin.audit-logs') }}">
                                                                    <i class="ri-close-circle-line me-2"></i> Cancel
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Pagination --}}
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <p class="text-muted mb-0">Showing <b>8</b> of <b>24</b> businesses</p>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="{{ route('admin.billing') }}">Prev</a></li>
                                            <li class="page-item active"><a class="page-link" href="{{ route('admin.billing') }}">1</a></li>
                                            <li class="page-item"><a class="page-link" href="{{ route('admin.billing') }}">2</a></li>
                                            <li class="page-item"><a class="page-link" href="{{ route('admin.billing') }}">3</a></li>
                                            <li class="page-item"><a class="page-link" href="{{ route('admin.billing') }}">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ===================== END TABLE ===================== --}}

                {{-- ===================== RECENT INVOICES + PAYMENT METHODS ===================== --}}
                <div class="row">
                    {{-- Recent Invoices --}}
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="ri-receipt-line me-1 text-primary"></i> Recent Invoices
                                </h5>
                                <a href="{{ route('admin.billing') }}" class="btn btn-sm btn-soft-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Invoice #</th>
                                                <th>Business</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ route('admin.billing') }}" class="text-primary fw-semibold">#INV-0024</a></td>
                                                <td>KFC Pakistan</td>
                                                <td class="fw-semibold">$1,200</td>
                                                <td>Mar 01, 2026</td>
                                                <td><span class="badge bg-success-subtle text-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('admin.billing') }}" class="text-primary fw-semibold">#INV-0023</a></td>
                                                <td>Pizza Hut LHR</td>
                                                <td class="fw-semibold">$890</td>
                                                <td>Mar 01, 2026</td>
                                                <td><span class="badge bg-success-subtle text-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('admin.billing') }}" class="text-primary fw-semibold">#INV-0022</a></td>
                                                <td>Hardees Karachi</td>
                                                <td class="fw-semibold">$340</td>
                                                <td>Feb 01, 2026</td>
                                                <td><span class="badge bg-danger-subtle text-danger">Overdue</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('admin.billing') }}" class="text-primary fw-semibold">#INV-0021</a></td>
                                                <td>Burger King ISB</td>
                                                <td class="fw-semibold">$890</td>
                                                <td>Mar 05, 2026</td>
                                                <td><span class="badge bg-success-subtle text-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('admin.billing') }}" class="text-primary fw-semibold">#INV-0020</a></td>
                                                <td>McDonald's DHA</td>
                                                <td class="fw-semibold">$1,200</td>
                                                <td>Feb 28, 2026</td>
                                                <td><span class="badge bg-danger-subtle text-danger">Overdue</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Summary --}}
                    <div class="col-xl-5">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="ri-secure-payment-line me-1 text-primary"></i> Payment Summary
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded bg-success-subtle text-success">
                                                <i class="ri-check-line"></i>
                                            </span>
                                        </div>
                                        <span class="fw-medium">Collected This Month</span>
                                    </div>
                                    <span class="fw-bold text-success fs-15">$12,430</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded bg-warning-subtle text-warning">
                                                <i class="ri-time-line"></i>
                                            </span>
                                        </div>
                                        <span class="fw-medium">Pending</span>
                                    </div>
                                    <span class="fw-bold text-warning fs-15">$2,390</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded bg-danger-subtle text-danger">
                                                <i class="ri-error-warning-line"></i>
                                            </span>
                                        </div>
                                        <span class="fw-medium">Overdue</span>
                                    </div>
                                    <span class="fw-bold text-danger fs-15">$1,540</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded bg-info-subtle text-info">
                                                <i class="ri-refund-2-line"></i>
                                            </span>
                                        </div>
                                        <span class="fw-medium">Refunded</span>
                                    </div>
                                    <span class="fw-bold text-info fs-15">$450</span>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary w-100">
                                        <i class="ri-send-plane-line me-1"></i> Send Payment Reminders
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ===================== END INVOICES ===================== --}}

            </div>
        </div>

        @include('layouts.footer')
    </div>
</div>

@include('layouts.customizer')
@include('partials.scripts')

<script>
// Revenue Chart
var revenueOpts = {
    chart: { type: 'bar', height: 260, toolbar: { show: false } },
    series: [{ name: 'Revenue ($)', data: [8200, 9400, 11000, 10200, 13500, 14820] }],
    xaxis: { categories: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'] },
    colors: ['#405189'],
    plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } },
    dataLabels: { enabled: false },
    grid: { borderColor: 'rgba(0,0,0,0.06)' },
    tooltip: { y: { formatter: v => '$' + v.toLocaleString() } }
};
if (document.getElementById('revenueChart'))
    new ApexCharts(document.getElementById('revenueChart'), revenueOpts).render();

// Plan Donut
var planOpts = {
    chart: { type: 'donut', height: 210 },
    series: [9, 11, 4],
    labels: ['Basic', 'Premium', 'Enterprise'],
    colors: ['#405189', '#0ab39c', '#f7b84b'],
    legend: { show: false },
    dataLabels: { enabled: false },
    plotOptions: { pie: { donut: { size: '70%' } } }
};
if (document.getElementById('planDonut'))
    new ApexCharts(document.getElementById('planDonut'), planOpts).render();
</script>
</body>
</html>
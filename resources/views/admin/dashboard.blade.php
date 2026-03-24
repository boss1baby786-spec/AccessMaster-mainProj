@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'Super Admin Dashboard'])
    @include('partials.head-css')
    <style>
        .sa-wrap { padding: 8px 0 4px; }
        .sa-hero { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; }
        .sa-hero h4 { margin: 0; font-weight: 700; }
        .sa-hero p { margin: 4px 0 0; color: #64748b; font-size: 13px; }
        .sa-stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; margin-bottom: 18px; }
        .sa-stat { border-radius: 14px; border: 1px solid #e5e7eb; background: #fff; padding: 16px; }
        .sa-stat .icon { width: 40px; height: 40px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px; font-size: 18px; }
        .sa-stat .value { font-size: 26px; line-height: 1; font-weight: 800; margin-bottom: 6px; }
        .sa-stat .label { color: #64748b; font-size: 13px; margin-bottom: 5px; }
        .sa-stat .change { font-size: 12px; font-weight: 600; color: #16a34a; }
        .sa-stat .change.warn { color: #dc2626; }
        .sa-icon-blue { background: #eff6ff; color: #2563eb; }
        .sa-icon-green { background: #ecfdf5; color: #059669; }
        .sa-icon-orange { background: #fffbeb; color: #d97706; }
        .sa-icon-purple { background: #f5f3ff; color: #7c3aed; }
        .sa-grid { display: grid; grid-template-columns: 1fr 340px; gap: 16px; margin-bottom: 18px; }
        .sa-card { border-radius: 14px; border: 1px solid #e5e7eb; background: #fff; padding: 16px; }
        .sa-card-title { font-size: 15px; font-weight: 700; margin-bottom: 12px; }
        .sa-activity { display: flex; flex-direction: column; gap: 10px; }
        .sa-activity-item { display: grid; grid-template-columns: 8px 1fr auto; align-items: start; gap: 10px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
        .sa-activity-item:last-child { border-bottom: 0; padding-bottom: 0; }
        .sa-dot { width: 8px; height: 8px; border-radius: 50%; margin-top: 6px; }
        .sa-table-wrap { overflow-x: auto; }
        .sa-table th { font-size: 11px; text-transform: uppercase; letter-spacing: .05em; color: #64748b; background: #f8fafc; }
        .sa-table td, .sa-table th { white-space: nowrap; }
        @media (max-width: 1200px) { .sa-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); } .sa-grid { grid-template-columns: 1fr; } }
        @media (max-width: 768px) { .sa-stats { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
@include('partials.body-attr')
<div id="layout-wrapper">
    @include('layouts.navbarheader')
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid sa-wrap">
                <div class="sa-hero">
                    <div>
                        <h4>Welcome, Super Admin</h4>
                        <p>Dashboard layout from your `velzonsuperadmindash.html`, integrated with AccessMaster routes.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.register-business') }}" class="btn btn-primary btn-sm">Register Owner / Business</a>
                        <a href="{{ route('admin.businesses') }}" class="btn btn-soft-primary btn-sm">All Businesses</a>
                        <a href="{{ route('admin.cards') }}" class="btn btn-soft-warning btn-sm">VFM Cardholders</a>
                    </div>
                </div>

                <div class="sa-stats">
                    @foreach($kpis as $idx => $k)
                        @php
                            $iconClass = ['sa-icon-blue', 'sa-icon-green', 'sa-icon-orange', 'sa-icon-purple'][$idx % 4];
                            $warn = str_contains(strtolower($k['badge']), 'expire') || str_contains(strtolower($k['badge']), 'failed');
                        @endphp
                        <a href="{{ $k['link'] }}" class="sa-stat text-decoration-none text-reset">
                            <div class="icon {{ $iconClass }}"><i class="{{ $k['icon'] }}"></i></div>
                            <div class="value">{{ $k['value'] }}</div>
                            <div class="label">{{ $k['label'] }}</div>
                            <div class="change {{ $warn ? 'warn' : '' }}">{{ $k['badge'] }}</div>
                        </a>
                    @endforeach
                </div>

                <div class="sa-grid">
                    <div class="sa-card">
                        <div class="sa-card-title">Monthly Revenue</div>
                        <canvas id="saRevenueChart" height="110"></canvas>
                    </div>
                    <div class="sa-card">
                        <div class="sa-card-title">Recent Activity</div>
                        <div class="sa-activity">
                            @forelse($recentActivities as $a)
                                <div class="sa-activity-item">
                                    <span class="sa-dot" style="background:#3b82f6"></span>
                                    <div>
                                        <a href="{{ route('admin.audit-logs') }}" class="fw-semibold text-decoration-none">{{ $a->message }}</a>
                                        <div class="text-muted small">{{ ucfirst($a->type) }}</div>
                                    </div>
                                    <small class="text-muted">{{ $a->created_at?->diffForHumans() }}</small>
                                </div>
                            @empty
                                <div class="text-muted small">No recent activity.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="sa-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="sa-card-title mb-0">Business Owners Overview</div>
                        <a href="{{ route('admin.businesses') }}" class="btn btn-sm btn-soft-primary">View All</a>
                    </div>
                    <div class="sa-table-wrap">
                        <table class="table sa-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Owner</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBusinessUsers as $b)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded bg-primary-subtle text-primary fw-bold">
                                                        {{ strtoupper(substr($b->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>{{ $b->name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $b->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $b->status === 'active' ? 'success' : 'danger' }}-subtle text-{{ $b->status === 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($b->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $b->created_at?->format('M d, Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a class="btn btn-sm btn-soft-secondary" href="{{ route('admin.businesses') }}">View</a>
                                                <a class="btn btn-sm btn-soft-primary" href="{{ route('admin.users.edit', $b->id) }}">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">No business owners found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@include('layouts.customizer')
@include('partials.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    (function () {
        const el = document.getElementById('saRevenueChart');
        if (!el || typeof Chart === 'undefined') return;
        new Chart(el, {
            type: 'line',
            data: {
                labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Revenue',
                    data: [9200, 10800, 9900, 12100, 13300, 14900, 16200],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.15)',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: false, grid: { color: 'rgba(148,163,184,0.18)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    })();
</script>
</body>
</html>

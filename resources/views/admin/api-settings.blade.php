@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'API Settings'])
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
                        <h4 class="mb-sm-0">API <span class="text-primary">Settings</span></h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">API Settings</li>
                        </ol>
                    </div>
                </div></div>

                <div class="row g-3">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="ri-settings-3-line me-2 text-primary"></i>Global API Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Rate Limit (req/min)</label>
                                        <input type="number" class="form-control" value="1000">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Token Expiry (days)</label>
                                        <input type="number" class="form-control" value="365">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Base URL</label>
                                        <input type="text" class="form-control" value="https://api.accessmaster.local/v1">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Webhook URL</label>
                                        <input type="text" class="form-control" placeholder="https://yourapp.com/webhooks/accessmaster">
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('admin.api-settings') }}" class="btn btn-primary">
                                            <i class="ri-save-line me-1"></i> Save Settings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="ri-key-2-line me-2 text-warning"></i>Master API Key</h5>
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <input class="form-control font-monospace" value="ups_master_sk_************************" readonly>
                                    <a href="{{ route('admin.api-settings') }}" class="btn btn-soft-primary">Copy</a>
                                </div>
                                <a href="{{ route('admin.audit-logs') }}" class="btn btn-soft-danger btn-sm mt-3">
                                    <i class="ri-refresh-line me-1"></i> Regenerate (logged)
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="ri-pulse-line me-2 text-success"></i>Usage Snapshot</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between py-2 border-bottom"><span>Total Requests Today</span><strong>48,291</strong></div>
                                <div class="d-flex justify-content-between py-2 border-bottom"><span>Success Rate</span><strong class="text-success">99.1%</strong></div>
                                <div class="d-flex justify-content-between py-2 border-bottom"><span>Error Rate</span><strong class="text-danger">0.9%</strong></div>
                                <div class="d-flex justify-content-between py-2"><span>Avg Response</span><strong>142ms</strong></div>
                                <a href="{{ route('admin.audit-logs') }}" class="btn btn-soft-secondary btn-sm mt-3">
                                    <i class="ri-file-list-3-line me-1"></i> View Logs
                                </a>
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
</body>
</html>

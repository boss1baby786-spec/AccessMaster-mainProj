@include("partials.main")
<head>
    @include('partials.title-meta', ['title' => 'My Account'])
    @include('partials.head-css')
    <style>
        .vfm-card-visual { background: linear-gradient(135deg, #405189 0%, #0ab39c 100%); border-radius: 16px; padding: 24px; color: white; position: relative; overflow: hidden; }
        .vfm-card-visual::before { content:''; position:absolute; top:-30px; right:-30px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,0.08); }
        .vfm-card-visual::after { content:''; position:absolute; bottom:-40px; left:-20px; width:100px; height:100px; border-radius:50%; background:rgba(255,255,255,0.05); }
        .tier-bronze { color: #cd7f32; }
        .tier-silver { color: #9ca3af; }
        .tier-gold { color: #f59e0b; }
        .tier-platinum { color: #818cf8; }
        .txn-row-expand { cursor: pointer; }
        .reward-card:hover { transform: translateY(-3px); transition: transform 0.2s; }
        .coupon-ticket { border-left: 4px solid #f7b84b; position: relative; }
        .coupon-ticket::before { content:''; position:absolute; left:-12px; top:50%; transform:translateY(-50%); width:20px; height:20px; border-radius:50%; background:#f8f9fa; border:2px dashed #f7b84b; }
    </style>
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
                        <h4 class="mb-sm-0">My <span class="text-primary">Account</span></h4>
                        <ol class="breadcrumb m-0"><li class="breadcrumb-item"><a href="#">AccessMaster</a></li><li class="breadcrumb-item active">My Account</li></ol>
                    </div>
                </div></div>

                <div class="row">
                    <!-- LEFT: VFM Card + Quick Stats -->
                    <div class="col-xl-4">

                        <!-- VFM Card Visual -->
                        <div class="vfm-card-visual mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-4" style="position:relative;z-index:1;">
                                <div>
                                    <div class="fw-bold opacity-75 small mb-1">ACCESSMASTER</div>
                                    <div class="fw-bold fs-13">Loyalty Card</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge" style="background:rgba(247,184,75,0.25);color:#f7b84b;border:1px solid rgba(247,184,75,0.4);">
                                        <i class="ri-vip-crown-fill me-1"></i>Gold Member
                                    </span>
                                </div>
                            </div>
                            <div class="font-monospace fs-22 fw-bold mb-3 tracking-widest" style="position:relative;z-index:1;letter-spacing:.15em;">VFM-4482</div>
                            <div class="d-flex justify-content-between align-items-end" style="position:relative;z-index:1;">
                                <div>
                                    <div class="opacity-75 small">Card Holder</div>
                                    <div class="fw-semibold">Maria Chen</div>
                                </div>
                                <div class="text-end">
                                    <div class="opacity-75 small">Points Balance</div>
                                    <div class="fw-bold fs-22">1,840</div>
                                </div>
                            </div>
                            <!-- QR Code placeholder -->
                            <div class="mt-3 pt-2 border-top border-white border-opacity-25 d-flex align-items-center gap-2" style="position:relative;z-index:1;">
                                <div class="bg-white rounded p-1" style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;">
                                    <i class="ri-qr-code-line text-dark fs-22"></i>
                                </div>
                                <small class="opacity-75">Show QR at counter to earn/redeem points</small>
                            </div>
                        </div>

                        <!-- Tier Progress -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Tier Progress</h6>
                                    <span class="badge bg-warning-subtle text-warning tier-gold fw-semibold"><i class="ri-vip-crown-fill me-1"></i>Gold</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Gold (1,000 pts)</small>
                                    <small class="text-muted">Platinum (5,000 pts)</small>
                                </div>
                                <div class="progress mb-2" style="height:10px;border-radius:5px;">
                                    <div class="progress-bar bg-warning" style="width:37%;"></div>
                                </div>
                                <small class="text-muted"><strong class="text-warning">3,160 more points</strong> to reach Platinum tier</small>
                                <div class="row g-2 text-center mt-2">
                                    @foreach([['Bronze','<500','secondary'],['Silver','500+','secondary'],['Gold','1K+','warning'],['Platinum','5K+','info']] as $tier)
                                    <div class="col-3">
                                        <div class="rounded p-1 {{ $tier[2]==='warning'?'bg-warning bg-opacity-10 border border-warning':'bg-light' }}">
                                            <i class="ri-vip-crown-fill text-{{ $tier[2] }} fs-14"></i>
                                            <div style="font-size:9px;font-weight:600;" class="text-{{ $tier[2] }}">{{ $tier[0] }}</div>
                                            <div style="font-size:8px;" class="text-muted">{{ $tier[1] }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Point Summary -->
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Points Summary</h6>
                                <div class="row g-2">
                                    @foreach([['Current Balance','1,840','primary'],['Lifetime Earned','3,200','success'],['Redeemed','1,360','warning'],['Expiring Soon','200','danger']] as $ps)
                                    <div class="col-6">
                                        <div class="text-center bg-{{ $ps[2] }}-subtle rounded p-2">
                                            <div class="fw-bold text-{{ $ps[2] }} fs-18">{{ $ps[1] }}</div>
                                            <div class="text-muted" style="font-size:10px;">{{ $ps[0] }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Tabs with Transactions/Rewards/Coupons/Profile -->
                    <div class="col-xl-8">

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-primary mb-3">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-txn"><i class="ri-history-line me-2"></i>Transactions</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-rewards"><i class="ri-gift-line me-2"></i>Rewards</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-coupons"><i class="ri-coupon-line me-2"></i>Coupons <span class="badge bg-warning ms-1">2</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-profile"><i class="ri-user-line me-2"></i>Profile</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-notify"><i class="ri-notification-3-line me-2"></i>Alerts <span class="badge bg-danger ms-1">3</span></a></li>
                        </ul>

                        <div class="tab-content">

                            <!-- TRANSACTIONS TAB -->
                            <div class="tab-pane active" id="tab-txn">
                                <!-- Filter Tabs -->
                                <div class="d-flex gap-2 mb-3 flex-wrap">
                                    @foreach(['All','Earn','Redeem','Coupon','Expire','Bonus'] as $tf)
                                    <button class="btn btn-sm {{ $tf==='All'?'btn-primary':'btn-soft-secondary' }}">{{ $tf }}</button>
                                    @endforeach
                                </div>
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr><th>Date</th><th>Description</th><th>Business</th><th>Amount</th><th>Points</th><th>Status</th></tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $ctxns = [
                                                        ['Jul 14','Purchase at KFC Downtown','Zinger Combo + Pepsi','KFC Pakistan','$18.50','+185 pts','earn','success','Completed'],
                                                        ['Jul 12','Reward Redemption','Free Zinger Burger','KFC Pakistan','$0.00','-500 pts','redeem','warning','Completed'],
                                                        ['Jul 12','Weekend Bonus Purchase','Family Bucket Meal','KFC Pakistan','$37.60','+564 pts','bonus','success','Completed'],
                                                        ['Jul 10','Purchase at KFC Midtown','Twister Wrap + Fries','KFC Pakistan','$14.20','+142 pts','earn','success','Completed'],
                                                        ['Jul 08','Coupon Applied — SAVE20','Mega Meal Deal','KFC Pakistan','$30.40','+304 pts','coupon','warning','Completed'],
                                                        ['Jul 05','Purchase at Mall Plaza','Popcorn Chicken Box','KFC Pakistan','$10.50','+105 pts','earn','success','Completed'],
                                                        ['Jun 28','Birthday Bonus','Birthday Bucket','KFC Pakistan','$29.75','+595 pts','bonus','success','Completed'],
                                                        ['Jun 01','Points Expired','Promotional points expired','—','—','-200 pts','expire','danger','Auto'],
                                                    ];
                                                    $txnColors=['earn'=>'success','redeem'=>'warning','bonus'=>'primary','coupon'=>'info','expire'=>'danger'];
                                                    @endphp
                                                    @foreach($ctxns as $t)
                                                    <tr>
                                                        <td><small class="text-muted">{{ $t[0] }}</small></td>
                                                        <td>
                                                            <p class="mb-0 fw-medium small">{{ $t[1] }}</p>
                                                            <small class="text-muted">{{ $t[2] }}</small>
                                                        </td>
                                                        <td><small class="text-muted">{{ $t[3] }}</small></td>
                                                        <td class="fw-medium">{{ $t[4] }}</td>
                                                        <td>
                                                            @php $pts_color = str_starts_with($t[5],'+') ? 'success' : 'danger'; @endphp
                                                            <span class="badge bg-{{ $pts_color }}-subtle text-{{ $pts_color }} fw-semibold">{{ $t[5] }}</span>
                                                        </td>
                                                        <td><span class="badge bg-{{ $t[7] }}-subtle text-{{ $t[7] }}">{{ $t[8] }}</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between p-3">
                                            <p class="text-muted mb-0">Showing 1–8 of 34 transactions</p>
                                            <nav><ul class="pagination pagination-sm mb-0">
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                                            </ul></nav>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- REWARDS TAB -->
                            <div class="tab-pane" id="tab-rewards">
                                <div class="alert alert-info mb-3">
                                    <i class="ri-information-line me-2"></i>You have <strong>1,840 points</strong> available. Redeem for exciting rewards below!
                                </div>
                                <div class="row g-3">
                                    @php
                                    $rewards = [
                                        ['Free Zinger Burger','500 pts','87 left','Dec 2025','success','ri-hamburger-line','Available'],
                                        ['50% Discount Voucher','300 pts','12 left','Sep 2025','warning','ri-price-tag-3-line','Low Stock'],
                                        ['Mega Meal Deal','800 pts','0 left','Aug 2025','danger','ri-bowl-line','Out of Stock'],
                                        ['Birthday Bucket','1200 pts','20 left','Jan 2026','primary','ri-cake-2-line','Available'],
                                        ['Free Fries Combo','250 pts','45 left','Nov 2025','info','ri-restaurant-2-line','Available'],
                                        ['Double Points Day','0 pts','Limited','Jul 31','secondary','ri-star-line','Event'],
                                    ];
                                    @endphp
                                    @foreach($rewards as $r)
                                    <div class="col-md-6">
                                        <div class="card reward-card border mb-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="avatar-md">
                                                        <span class="avatar-title bg-{{ $r[4] }}-subtle text-{{ $r[4] }} rounded fs-24">
                                                            <i class="{{ $r[5] }}"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 fw-semibold">{{ $r[0] }}</h6>
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <span class="badge bg-warning-subtle text-warning"><i class="ri-coin-line me-1"></i>{{ $r[1] }}</span>
                                                            <span class="badge bg-{{ $r[4] }}-subtle text-{{ $r[4] }}">{{ $r[6] }}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">{{ $r[2] }} · Exp: {{ $r[3] }}</small>
                                                            @if($r[6] !== 'Out of Stock')
                                                            <button class="btn btn-primary btn-sm">Redeem</button>
                                                            @else
                                                            <button class="btn btn-soft-secondary btn-sm" disabled>Unavailable</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- COUPONS TAB -->
                            <div class="tab-pane" id="tab-coupons">
                                <div class="row g-3">
                                    @foreach([
                                        ['SAVE20','20% off any order','percent',20,'Sep 30, 2025','Active','warning','Min. order $15'],
                                        ['FREE50','50 bonus points on next visit','bonus_pts',50,'Dec 31, 2025','Active','success','Any order'],
                                        ['XMAS10','Holiday $10 flat discount','flat',10,'Dec 31, 2024','Expired','secondary','Min. order $25'],
                                    ] as $c)
                                    <div class="col-md-6">
                                        <div class="card coupon-ticket mb-0 {{ $c[5]==='Expired'?'opacity-50':'' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="font-monospace fw-bold fs-18 text-{{ $c[6] }}">{{ $c[0] }}</span>
                                                    <span class="badge bg-{{ $c[5]==='Active'?'success':'secondary' }}-subtle text-{{ $c[5]==='Active'?'success':'secondary' }}">{{ $c[5] }}</span>
                                                </div>
                                                <p class="text-muted small mb-2">{{ $c[1] }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fw-bold text-{{ $c[6] }} fs-20">
                                                            @if($c[2]==='percent')-{{ $c[3] }}%
                                                            @elseif($c[2]==='flat')-${{ $c[3] }}
                                                            @else+{{ $c[3] }} pts
                                                            @endif
                                                        </div>
                                                        <small class="text-muted">{{ $c[7] }}</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <small class="text-muted d-block">Expires</small>
                                                        <small class="fw-medium {{ $c[5]==='Expired'?'text-danger':'' }}">{{ $c[4] }}</small>
                                                    </div>
                                                </div>
                                                @if($c[5]==='Active')
                                                <div class="mt-2 pt-2 border-top border-dashed">
                                                    <small class="text-muted"><i class="ri-information-line me-1"></i>Show code at counter when billing</small>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- PROFILE TAB -->
                            <div class="tab-pane" id="tab-profile">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="card mb-0">
                                            <div class="card-header"><h6 class="mb-0"><i class="ri-user-line me-2 text-primary"></i>Personal Information</h6></div>
                                            <div class="card-body">
                                                @foreach([['Full Name','Maria Chen'],['Email','maria.chen@email.com'],['Phone','+1 917-555-0101'],['City','New York'],['VFM Card No.','VFM-4482'],['User ID','USR-10042'],['Member Since','January 2024'],['Current Tier','Gold']] as $pf)
                                                <div class="d-flex justify-content-between py-2 border-bottom">
                                                    <span class="text-muted small">{{ $pf[0] }}</span>
                                                    <span class="fw-medium small {{ in_array($pf[0],['VFM Card No.','User ID'])?'font-monospace text-primary':($pf[0]==='Current Tier'?'text-warning':'') }}">{{ $pf[1] }}</span>
                                                </div>
                                                @endforeach
                                                <div class="mt-3 d-flex gap-2">
                                                    <button class="btn btn-primary btn-sm"><i class="ri-edit-line me-1"></i>Edit Profile</button>
                                                    <button class="btn btn-soft-secondary btn-sm"><i class="ri-lock-password-line me-1"></i>Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-0">
                                            <div class="card-header"><h6 class="mb-0"><i class="ri-trophy-line me-2 text-warning"></i>Loyalty Summary</h6></div>
                                            <div class="card-body">
                                                @foreach([['Current Points','1,840 pts','primary'],['Lifetime Earned','+3,200 pts','success'],['Lifetime Redeemed','-1,360 pts','warning'],['Total Transactions','34','info'],['Total Spend','$142.70','success'],['Total Saved','$24.65','danger'],['Active Coupons','2','warning'],['Next Tier','Platinum (3,160 pts away)','info']] as $ls)
                                                <div class="d-flex justify-content-between py-2 border-bottom">
                                                    <span class="text-muted small">{{ $ls[0] }}</span>
                                                    <span class="fw-semibold small text-{{ $ls[2] }}">{{ $ls[1] }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- NOTIFICATIONS TAB -->
                            <div class="tab-pane" id="tab-notify">
                                <div class="d-flex flex-column gap-3">
                                    @php
                                    $notifs = [
                                        ['danger','ri-alert-line','Points Expiring Soon','200 promotional points will expire on Jun 01, 2026. Redeem them before they are lost!','2 days ago'],
                                        ['success','ri-vip-crown-line','Welcome to Gold Tier!','Congratulations! You\'ve reached Gold tier. Enjoy 1.5x points on every purchase.','1 week ago'],
                                        ['warning','ri-gift-line','New Reward Available','Birthday Bucket is now available for 1,200 points. Limited to 20 vouchers!','2 weeks ago'],
                                        ['primary','ri-calendar-event-line','Double Points Weekend','This Saturday and Sunday earn 2x points at all KFC branches. Don\'t miss out!','3 weeks ago'],
                                        ['info','ri-coupon-line','New Coupon Added','SAVE20 coupon has been added to your account. Use it on your next visit!','1 month ago'],
                                    ];
                                    @endphp
                                    @foreach($notifs as $n)
                                    <div class="d-flex gap-3 p-3 border rounded">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-{{ $n[0] }}-subtle text-{{ $n[0] }} rounded-circle"><i class="{{ $n[1] }}"></i></span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $n[2] }}</h6>
                                            <p class="text-muted small mb-0">{{ $n[3] }}</p>
                                        </div>
                                        <small class="text-muted flex-shrink-0">{{ $n[4] }}</small>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>{{-- end tab-content --}}
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
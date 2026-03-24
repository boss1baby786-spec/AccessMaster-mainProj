<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm"><h1 class="text-white fs-16 mb-0">AM</h1></span>
            <span class="logo-lg"><h1 class="text-white fs-18 mb-0">AccessMaster</h1></span>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm"><h1 class="text-white fs-16 mb-0">AM</h1></span>
            <span class="logo-lg"><h1 class="text-white fs-18 mb-0">AccessMaster</h1></span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    {{-- Sidebar User Dropdown --}}
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary fs-14 fw-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">{{ auth()->user()->name }}</span>
                    <span class="d-block fs-12 sidebar-user-name-sub-text">
                        <i class="ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">
                            {{ ucfirst(str_replace('_', ' ', auth()->user()->getRoleNames()->first() ?? 'User')) }}
                        </span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}!</h6>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="mdi mdi-logout fs-16 align-middle me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">

                {{-- ======================================================= --}}
                {{-- SUPER ADMIN --}}
                {{-- ======================================================= --}}
                @role('super_admin')

                <li class="menu-title"><span>Main</span></li>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Businesses</span></li>

                <li class="nav-item">
                    <a href="{{ route('admin.businesses') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.businesses') ? 'active' : '' }}">
                        <i class="ri-building-2-line"></i> <span>All Businesses</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.register-business') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.register-business') ? 'active' : '' }}">
                        <i class="ri-add-box-line"></i> <span>Register Business</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>VFM Cards & Plans</span></li>

                <li class="nav-item">
                    <a href="{{ route('admin.cards') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.cards') ? 'active' : '' }}">
                        <i class="ri-bank-card-line"></i> <span>VFM Cards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.plans') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.plans') ? 'active' : '' }}">
                        <i class="ri-price-tag-3-line"></i> <span>Plans</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.billing') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.billing') ? 'active' : '' }}">
                        <i class="ri-secure-payment-line"></i> <span>Billing</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>System</span></li>

                @canany(['users.index', 'users.create'])
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="ri-user-settings-line"></i> <span>Users</span>
                    </a>
                </li>
                @endcanany

                @canany(['roles.index', 'roles.create'])
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="ri-shield-user-line"></i> <span>Roles</span>
                    </a>
                </li>
                @endcanany

                @canany(['permissions.index', 'permissions.create'])
                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                        <i class="ri-lock-2-line"></i> <span>Permissions</span>
                    </a>
                </li>
                @endcanany

                <li class="nav-item">
                    <a href="{{ route('admin.api-settings') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.api-settings') ? 'active' : '' }}">
                        <i class="ri-code-s-slash-line"></i> <span>API Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.audit-logs') }}"
                       class="nav-link menu-link {{ request()->routeIs('admin.audit-logs') ? 'active' : '' }}">
                        <i class="ri-file-list-3-line"></i> <span>Audit Logs</span>
                    </a>
                </li>

                @endrole

                {{-- ======================================================= --}}
                {{-- BUSINESS ADMIN --}}
                {{-- ======================================================= --}}
                @role('business_admin')

                <li class="menu-title"><span>Main</span></li>

                <li class="nav-item">
                    <a href="{{ route('business.dashboard') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Loyalty Ops</span></li>

                <li class="nav-item">
                    <a href="{{ route('business.branches') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.branches') ? 'active' : '' }}">
                        <i class="ri-store-2-line"></i> <span>My Branches</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('business.point-rules') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.point-rules') ? 'active' : '' }}">
                        <i class="ri-coins-line"></i> <span>Point Rules</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('business.rewards') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.rewards') ? 'active' : '' }}">
                        <i class="ri-gift-line"></i> <span>Reward Catalog</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('business.approval-queue') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.approval-queue') ? 'active' : '' }}">
                        <i class="ri-checkbox-circle-line"></i> <span>Approval Queue</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('business.coupons') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.coupons') ? 'active' : '' }}">
                        <i class="ri-coupon-3-line"></i> <span>Coupons</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Financials</span></li>

                <li class="nav-item">
                    <a href="{{ route('business.ledger') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.ledger') ? 'active' : '' }}">
                        <i class="ri-book-2-line"></i> <span>Brand Ledger</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Access Control</span></li>

                <li class="nav-item">
                    <a href="{{ route('business.staff') }}"
                       class="nav-link menu-link {{ request()->routeIs('business.staff') ? 'active' : '' }}">
                        <i class="ri-team-line"></i> <span>Staff</span>
                    </a>
                </li>

                @endrole

                {{-- ======================================================= --}}
                {{-- CASHIER --}}
                {{-- ======================================================= --}}
                @role('cashier')

                <li class="menu-title"><span>POS Terminal</span></li>

                <li class="nav-item">
                    <a href="{{ route('cashier.terminal') }}"
                       class="nav-link menu-link {{ request()->routeIs('cashier.terminal') ? 'active' : '' }}">
                        <i class="ri-qr-scan-2-line"></i> <span>Terminal</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cashier.transactions') }}"
                       class="nav-link menu-link {{ request()->routeIs('cashier.transactions') ? 'active' : '' }}">
                        <i class="ri-exchange-line"></i> <span>Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cashier.void-refund') }}"
                       class="nav-link menu-link {{ request()->routeIs('cashier.void-refund') ? 'active' : '' }}">
                        <i class="ri-refund-2-line"></i> <span>Void / Refund</span>
                    </a>
                </li>

                @endrole

                {{-- ======================================================= --}}
                {{-- CUSTOMER --}}
                {{-- ======================================================= --}}
                @role('customer')

                <li class="menu-title"><span>My Account</span></li>

                <li class="nav-item">
                    <a href="{{ route('customer.account') }}"
                       class="nav-link menu-link {{ request()->routeIs('customer.account') ? 'active' : '' }}">
                        <i class="ri-bank-card-line"></i> <span>VFM Card</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customer.transactions') }}"
                       class="nav-link menu-link {{ request()->routeIs('customer.transactions') ? 'active' : '' }}">
                        <i class="ri-exchange-line"></i> <span>Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customer.rewards') }}"
                       class="nav-link menu-link {{ request()->routeIs('customer.rewards') ? 'active' : '' }}">
                        <i class="ri-gift-line"></i> <span>Rewards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customer.coupons') }}"
                       class="nav-link menu-link {{ request()->routeIs('customer.coupons') ? 'active' : '' }}">
                        <i class="ri-coupon-3-line"></i> <span>Coupons</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customer.profile') }}"
                       class="nav-link menu-link {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                        <i class="ri-user-line"></i> <span>My Profile</span>
                    </a>
                </li>

                @endrole

                {{-- ======================================================= --}}
                {{-- LOGOUT — ALL ROLES --}}
                {{-- ======================================================= --}}
                <li class="menu-title"><i class="ri-more-fill"></i> <span>Account</span></li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="nav-link menu-link w-100 text-start border-0 bg-transparent text-danger">
                            <i class="ri-logout-box-r-line"></i> <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<div class="vertical-overlay"></div>





























{{-- <div class="app-menu navbar-menu">

        <div class="navbar-brand-box">

            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    {{-- <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22"> --}}
                    {{-- <h1 class="mt-4 text-white text-nowrap fs-2">
                        AccessMaster
                    </h1>

                </span>
                <span class="logo-lg"> --}}
                    {{-- <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17"> --}}
                    {{-- <h1 class="mt-4 text-white text-nowrap fs-2">
                        AccessMaster
                    </h1>

                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm"> --}}
                    {{-- <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22"> --}}
                    {{-- <h1 class="mt-4 text-white text-nowrap fs-2">
                        AccessMaster
                    </h1>

                </span>
                <span class="logo-lg"> --}}
                    {{-- <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17"> --}}
                    {{-- <h1 class="mt-4 text-white text-nowrap fs-2">
                        AccessMaster
                    </h1>

                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div class="dropdown sidebar-user m-1 rounded">
            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="d-flex align-items-center gap-2">
                    <img class="rounded header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                        alt="Header Avatar">
                    <span class="text-start">
                        <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                        <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                                class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                                class="align-middle">Online</span></span>
                    </span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <h6 class="dropdown-header">Welcome Anna!</h6>
                <a class="dropdown-item" href="pages-profile.html"><i
                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Profile</span></a>
                <a class="dropdown-item" href="apps-chat.html"><i
                        class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Messages</span></a>
                <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                        class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Taskboard</span></a>
                <a class="dropdown-item" href="pages-faqs.html"><i
                        class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Help</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="pages-profile.html"><i --}}
                        {{-- class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Balance : <b>$5971.67</b></span></a>
                <a class="dropdown-item" href="pages-profile-settings.html"><span
                        class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                        class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Settings</span></a>
                <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                        class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                        screen</span></a>
                <a class="dropdown-item" href="auth-logout-basic.html"><i --}}
                        {{-- class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                        data-key="t-logout">Logout</span></a>
            </div>
        </div>
        <div id="scrollbar">
            <div class="container-fluid">


                <div id="two-column-menu">
                </div>


                <ul class="navbar-nav" id="navbar-nav"> --}}
                    {{-- <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                       
                      --}}



                    {{-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                                <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Layouts</span> <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarLayouts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="layouts-horizontal.html" target="_blank" class="nav-link" data-key="t-horizontal">Horizontal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">Detached</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Two Column</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="layouts-vertical-hovered.html" target="_blank" class="nav-link" data-key="t-hovered">Hovered</a>
                                    </li>
                                </ul>
                            </div>
                        </li>  --}}
                    {{-- <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>




                    <li class="nav-item"> --}}


                        {{-- ************************************USERS***************************************************                                              --}}

                        {{-- @canany(['users.index', 'users.create', 'users.reports'])
                        <li class="nav-item">
                            <a href="#sidebarUsers" class="nav-link" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarUsers">
                                Users
                            </a>

                            <div class="collapse menu-dropdown" id="sidebarUsers">
                                <ul class="nav nav-sm flex-column">

                                    @can('users.create')
                                        <li class="nav-item">
                                            <a href="{{ route('users.create') }}" class="nav-link">Create User</a>
                                        </li>
                                    @endcan

                                    @can('users.index')
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}" class="nav-link">List Users</a>
                                        </li>
                                    @endcan

                                    @can('users.reports')
                                        <li class="nav-item">
                                            <a href="{{ route('users.reports') }}" class="nav-link">User Reports</a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcanany --}}

                    {{-- 
************************************ROLES***************************************************  --}}
                    {{-- @canany(['roles.index', 'roles.create'])
                        <li class="nav-item">
                            <a href="#sidebarRoles" class="nav-link" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarRoles">
                                Roles
                            </a>

                            <div class="collapse menu-dropdown" id="sidebarRoles">
                                <ul class="nav nav-sm flex-column">

                                    @can('roles.create')
                                        <li class="nav-item"> --}}
                                            {{-- <a href="{{ route('roles.create') }}" class="nav-link">Create Role</a>
                                        </li>
                                    @endcan

                                    @can('roles.index')
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}" class="nav-link">List Roles</a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcanany --}}



                    {{-- ************************************PERMISSIONS***************************************************  --}}

                    {{-- @canany(['permissions.index', 'permissions.create'])
                        <li class="nav-item">
                            <a href="#sidebarPermissions" class="nav-link" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPermissions">
                                Permissions
                            </a>

                            <div class="collapse menu-dropdown" id="sidebarPermissions">
                                <ul class="nav nav-sm flex-column">

                                    @can('permissions.create')
                                        <li class="nav-item">
                                            <a href="{{ route('permissions.create') }}" class="nav-link">Create Permission</a>
                                        </li>
                                    @endcan

                                    @can('permissions.index')
                                        <li class="nav-item">
                                            <a href="{{ route('permissions.index') }}" class="nav-link">List Permissions</a>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </li>
                    @endcanany














                    </li>

                    <li class="nav-item text-center ">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-secondary" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>




                </ul>
            </div>
 --}}
{{-- 
        </div>

        <div class="sidebar-background"></div>
    </div>

    <div class="vertical-overlay"></div>  --}}

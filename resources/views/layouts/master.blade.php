<!doctype html>
<html   lang="en" 
        data-layout="vertical" 
        data-topbar="light" 
        data-sidebar="dark" 
        data-sidebar-size="lg" 
        data-sidebar-image="none" 
        data-preloader="disable" 
        data-theme="default" 
        data-theme-colors="default">
<head>

    @include('layouts.head')
</head>
<body>
    <div id="layout-wrapper">
        @include('layouts.navbarheader')
        @include('layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
           @include('layouts.footer')
        </div>
    </div>
    @include('layouts.preloader')
    @include('layouts.customizer')
    @include('layouts.script')
</body>

</html>
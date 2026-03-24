@extends('layouts.master')
@section('title')
<title> Admin| Dashboard </title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-wise-css')
@endsection
@section('css')
<style>
    
</style>
@endsection
@section('content')
   <h1>Welcome to Dashboard</h1> 
@endsection

@section('page-wise-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@endsection
@section('script')
@vite('resources/js/app.js')
<script>

function setRadio(name, value) {
    const el = document.querySelector(`input[name="${name}"][value="${value}"]`);
    if(!el) return;
    if (el) el.checked = true;   
     el.dispatchEvent(new Event('change')); 
}
function setSidebarUserProfile(isVisible) {
    const el = document.querySelector('input[name="sidebarUserProfile"]');
    if (!el) return;
   
    if (el.checked !== isVisible) {
        el.click(); 
    }
}
window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const prefs = @json(auth()->user()->preferences ?? null);
        if (!prefs) return;

        setRadio('data-layout', prefs.layout);
        setRadio('data-theme', prefs.theme);
        setRadio('data-bs-theme', prefs.color_scheme);
        setRadio('data-sidebar-size', prefs.sidebar_size);
        setSidebarUserProfile(prefs.sidebarUserProfile === 'show');
        setRadio('data-layout-width', prefs.layout_width);
        setRadio('data-sidebar-visibility', prefs.sidebar_visibility);
        setRadio('data-layout-position', prefs.layout_position);
        setRadio('data-topbar', prefs.topbar_color);
        setRadio('data-layout-style', prefs.sidebar_view);
        setRadio('data-sidebar', prefs.sidebar_color);
        setRadio('data-sidebar-image', prefs.sidebar_image);
        setRadio('data-theme-colors', prefs.primary_color);
        setRadio('data-preloader', prefs.preloader);
    }, 200); 
});
if(window.AUTH_USER_ID={{auth()->id()}});
</script>
@endsection 
@php
    $user = auth()->user();
    $prefs = $user?->preferences;
@endphp
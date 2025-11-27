<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestion Scolaire') }} - @yield('title', '')</title>
    <link rel="stylesheet" href="{{ asset('css/auth-google.css') }}">
    @stack('styles')
    <style>
        /* small wrapper to keep auth screens centered similar to login view */
        body { background: var(--g-bg, #f6f9fc); }
        .auth-shell { min-height: 100vh; display:flex; align-items:center; justify-content:center; padding:2rem; }
    </style>
</head>
<body>
    <div class="auth-shell">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>

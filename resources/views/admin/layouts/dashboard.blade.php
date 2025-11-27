<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1a73e8">
    <meta name="description" content="Système de gestion scolaire moderne et performant">

    <title>{{ config('app.name', 'Gestion Scolaire') }} - @yield('title', 'Dashboard')</title>

    <!-- Preconnect to external domains for better performance -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- DNS Prefetch for faster loading -->
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- Bootstrap CSS - Essential for layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Critical CSS - Load after Bootstrap for overrides -->
    <link rel="stylesheet" href="{{ asset('css/google-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-header.css') }}">
    
    <!-- Font Awesome - Defer non-critical icons -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    
    <!-- Flag Icons - Defer non-critical -->
    <link rel="preload" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"></noscript>

    <!-- Fonts - Load with display swap for better performance -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Additional Component CSS -->
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Mobile Header (component) -->
    <x-admin.mobile-header />

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <x-navigation.sidebar />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Content Header (extracted to partial) -->
            @include('admin.partials.header')

            <!-- Content Body -->
            <div class="content-body">
                <!-- Breadcrumb -->
                @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                @endif
                <!-- Flash Messages (centralized partial) -->
                @include('admin.partials.flash')

                <!-- Main Content -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS - Load with integrity check -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Alpine.js for Custom Components - Load early for datalists -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Dashboard Core Scripts - Optimized and cached -->
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    @stack('scripts')
</body>

</html>
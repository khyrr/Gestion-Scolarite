<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', $themeVars['site_name'] ?? 'School Management System')</title>
    <meta name="description" content="@yield('description', 'Excellence in Education - School Management System')">
    
    <!-- SEO Meta Tags -->
    <meta name="keywords" content="@yield('keywords', 'school, education, management, students, teachers')">
    <meta name="author" content="{{ $themeVars['site_name'] ?? 'School Management System' }}">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('og_title', $themeVars['site_name'] ?? 'School Management System')">
    <meta property="og:description" content="@yield('og_description', 'Excellence in Education')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(isset($themeVars['logo_url']) && $themeVars['logo_url'])
        <meta property="og:image" content="{{ Storage::url($themeVars['logo_url']) }}">
    @endif
    
    <!-- Favicon -->
    @if(isset($themeVars['logo_url']) && $themeVars['logo_url'])
        <link rel="icon" href="{{ Storage::url($themeVars['logo_url']) }}" type="image/x-icon">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Material Design 3 Color System
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe', 
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49'
                        },
                        surface: {
                            50: '#fafafa',
                            100: '#f5f5f5',
                            200: '#eeeeee',
                            300: '#e0e0e0',
                            400: '#bdbdbd',
                            500: '#9e9e9e',
                            600: '#757575',
                            700: '#616161',
                            800: '#424242',
                            900: '#212121'
                        },
                        outline: '#79747e',
                        'on-surface': '#1c1b1f',
                        'surface-variant': '#e7e0ec'
                    },
                    fontFamily: {
                        'sans': ['Google Sans', 'Inter', 'system-ui', 'sans-serif']
                    },
                    borderRadius: {
                        'material': '12px',
                        'material-lg': '16px',
                        'material-xl': '28px'
                    },
                    boxShadow: {
                        'material-1': '0 1px 3px 1px rgba(0, 0, 0, 0.15), 0 1px 2px 0 rgba(0, 0, 0, 0.30)',
                        'material-2': '0 2px 6px 2px rgba(0, 0, 0, 0.15), 0 1px 2px 0 rgba(0, 0, 0, 0.30)',
                        'material-3': '0 4px 8px 3px rgba(0, 0, 0, 0.15), 0 1px 3px 0 rgba(0, 0, 0, 0.30)',
                        'material-4': '0 6px 10px 4px rgba(0, 0, 0, 0.15), 0 2px 3px 0 rgba(0, 0, 0, 0.30)',
                        'material-5': '0 8px 12px 6px rgba(0, 0, 0, 0.15), 0 4px 4px 0 rgba(0, 0, 0, 0.30)'
                    },
                    spacing: {
                        '18': '4.5rem',
                        '88': '22rem'
                    }
                }
            }
        }
    </script>
    
    <!-- Styles -->
    @vite(['resources/sass/app.scss'])
    
    <!-- Dynamic Theme CSS -->
    <link rel="stylesheet" href="{{ route('theme.css') }}">
    
    <!-- Additional Styles -->
    @stack('styles')
    
    <!-- Custom CSS Variables -->
    <style>
        :root {
            --primary-color: {{ $themeVars['primary_color'] ?? '#3B82F6' }};
            --secondary-color: {{ $themeVars['secondary_color'] ?? '#1E40AF' }};
        }
        
        body {
            font-family: 'Google Sans', 'Inter', system-ui, sans-serif;
            background-color: #fefbff;
            color: #1c1b1f;
        }
        
        .material-surface {
            background: linear-gradient(135deg, #fefbff 0%, #f8f9ff 100%);
        }
        
        .material-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .material-button {
            transition: all 0.2s cubic-bezier(0.2, 0, 0, 1);
        }
        
        .material-button:hover {
            transform: translateY(-1px);
        }
        
        .bg-primary { background-color: var(--primary-color); }
        .text-primary { color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
        .bg-secondary { background-color: var(--secondary-color); }
        .text-secondary { color: var(--secondary-color); }
        
        .hover\:bg-primary:hover { background-color: var(--primary-color); }
        .hover\:text-primary:hover { color: var(--primary-color); }
    </style>
    
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-900 antialiased" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <!-- Navigation -->
    <x-public.navbar :theme-vars="$themeVars" />
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <x-public.footer :theme-vars="$themeVars" />
    
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireScripts
    
    <!-- Additional Scripts -->
    @stack('scripts')
    
    <!-- Alpine.js for lightweight interactions -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Toast Notifications -->
    @if(session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>
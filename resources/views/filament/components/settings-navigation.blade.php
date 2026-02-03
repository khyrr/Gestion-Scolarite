@php
    $currentRoute = request()->route()->getName();
    $tabs = [
        [
            'name' => 'System',
            'url' => route('filament.admin.pages.settings.system'),
            'icon' => 'heroicon-m-cog-6-tooth',
            'active' => str_contains($currentRoute, 'settings.system')
        ],
        [
            'name' => 'Security', 
            'url' => route('filament.admin.pages.settings.security'),
            'icon' => 'heroicon-m-shield-check',
            'active' => str_contains($currentRoute, 'settings.security')
        ],
        [
            'name' => 'Academic',
            'url' => route('filament.admin.pages.settings.academic'), 
            'icon' => 'heroicon-m-academic-cap',
            'active' => str_contains($currentRoute, 'settings.academic')
        ],
        [
            'name' => 'Application',
            'url' => route('filament.admin.pages.settings.application'),
            'icon' => 'heroicon-m-computer-desktop', 
            'active' => str_contains($currentRoute, 'settings.application')
        ]
    ];
@endphp

@include('filament.components.pill-navigation', ['tabs' => $tabs])
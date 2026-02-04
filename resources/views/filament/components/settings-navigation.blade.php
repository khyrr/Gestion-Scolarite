@php
    $currentRoute = request()->route()->getName();
    $tabs = [
        [
            'name' => 'System',
            'url' => \App\Filament\Pages\Settings\System::getUrl(),
            'icon' => 'heroicon-m-cog-6-tooth',
            'active' => str_contains($currentRoute, 'settings.system')
        ],
        [
            'name' => 'Security', 
            'url' => \App\Filament\Pages\Settings\Security::getUrl(),
            'icon' => 'heroicon-m-shield-check',
            'active' => str_contains($currentRoute, 'settings.security')
        ],
        [
            'name' => 'Academic',
            'url' => \App\Filament\Pages\Settings\Academic::getUrl(),
            'icon' => 'heroicon-m-academic-cap',
            'active' => str_contains($currentRoute, 'settings.academic')
        ],
        [
            'name' => 'Application',
            'url' => \App\Filament\Pages\Settings\Application::getUrl(),
            'icon' => 'heroicon-m-computer-desktop', 
            'active' => str_contains($currentRoute, 'settings.application')
        ],
        [
            'name' => 'Notifications',
            'url' => \App\Filament\Pages\Settings\NotificationSettings::getUrl(),
            'icon' => 'heroicon-m-bell',
            'active' => str_contains($currentRoute, 'settings.notifications')
        ]
    ];
@endphp

@include('filament.components.pill-navigation', ['tabs' => $tabs])
@php
    $currentRoute = request()->route()->getName();
    $tabs = [
        [
            'name' => 'Profile',
            'url' => \App\Filament\Pages\Account\Profile::getUrl(),
            'icon' => 'heroicon-m-user',
            'active' => str_contains($currentRoute, 'account.profile')
        ],
        [
            'name' => 'Security', 
            'url' => \App\Filament\Pages\Account\Security::getUrl(),
            'icon' => 'heroicon-m-shield-check',
            'active' => str_contains($currentRoute, 'account.security')
        ],
        [
            'name' => 'Preferences',
            'url' => \App\Filament\Pages\Account\Preferences::getUrl(), 
            'icon' => 'heroicon-m-cog-6-tooth',
            'active' => str_contains($currentRoute, 'account.preferences')
        ],
        [
            'name' => 'Notifications',
            'url' => \App\Filament\Pages\Account\Notifications::getUrl(),
            'icon' => 'heroicon-m-bell', 
            'active' => str_contains($currentRoute, 'account.notifications')
        ]
    ];
@endphp

@include('filament.components.pill-navigation', ['tabs' => $tabs])
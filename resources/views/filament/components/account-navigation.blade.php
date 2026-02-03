@php
    $currentRoute = request()->route()->getName();
    $tabs = [
        [
            'name' => 'Profile',
            'url' => route('filament.admin.pages.account.profile'),
            'icon' => 'heroicon-m-user',
            'active' => str_contains($currentRoute, 'account.profile')
        ],
        [
            'name' => 'Security', 
            'url' => route('filament.admin.pages.account.security'),
            'icon' => 'heroicon-m-shield-check',
            'active' => str_contains($currentRoute, 'account.security')
        ],
        [
            'name' => 'Preferences',
            'url' => route('filament.admin.pages.account.preferences'), 
            'icon' => 'heroicon-m-cog-6-tooth',
            'active' => str_contains($currentRoute, 'account.preferences')
        ],
        [
            'name' => 'Notifications',
            'url' => route('filament.admin.pages.account.notifications'),
            'icon' => 'heroicon-m-bell', 
            'active' => str_contains($currentRoute, 'account.notifications')
        ]
    ];
@endphp

@include('filament.components.pill-navigation', ['tabs' => $tabs])
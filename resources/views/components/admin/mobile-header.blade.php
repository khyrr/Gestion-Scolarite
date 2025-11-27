<header class="mobile-header">
    <div class="mobile-header-container">
        <!-- Menu Toggle -->
        <button class="mobile-menu-btn" type="button" aria-label="{{ __('app.ouvrir_menu') }}">
            <svg class="mobile-menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
        </button>

        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="mobile-brand">
            <div class="mobile-brand-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                </svg>
            </div>
            <span class="mobile-brand-text">{{ config('app.name', 'Gestion Scolaire') }}</span>
        </a>

        <!-- Actions -->
        <div class="mobile-actions">
            <!-- Language Switcher -->
            <div class="mobile-action-dropdown">
                @php $current = app()->getLocale(); $locales = config('locales', []); $currentFlag = $locales[$current]['flag'] ?? $current; @endphp
                <button class="mobile-action-btn" type="button" data-bs-toggle="dropdown" aria-label="{{ __('app.changer_langue') }}">
                    <span class="flag-icon fi fi-{{ $currentFlag }}"></span>
                </button>
                <ul class="mobile-dropdown-menu dropdown-menu dropdown-menu-end">
                    @foreach($locales as $code => $meta)
                        @php $flag = $meta['flag'] ?? $code; $label = $meta['label'] ?? strtoupper($code); @endphp
                        <li>
                            <a class="mobile-dropdown-item {{ app()->getLocale() === $code ? 'active' : '' }}" href="{{ \Illuminate\Support\Facades\Route::has('admin.lang.switch') ? route('admin.lang.switch', $code) : url('/langue/'.$code) }}">
                                <span class="fi fi-{{ $flag }}"></span>
                                <span>{{ $label }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- notifications -->
            <div class="mobile-action-dropdown">
                <x-dashboard.notifications />
            </div>

            <!-- User Menu -->
            <div class="mobile-action-dropdown">
                <button class="mobile-action-btn mobile-user-btn" type="button" data-bs-toggle="dropdown" aria-label="{{ __('app.menu_utilisateur') }}">
                    @php
                        $user = Auth::guard('admin')->user();
                        $userName = $user->prenom . ' ' . $user->nom ?? 'Admin';
                        $initials = collect(explode(' ', $userName))->map(fn($word) => mb_substr($word, 0, 1))->take(2)->join('');
                    @endphp
                    <span class="mobile-user-avatar">{{ $initials }}</span>
                </button>
                <ul class="mobile-dropdown-menu dropdown-menu dropdown-menu-end">
                    <li class="mobile-dropdown-header">
                        <div class="mobile-user-name">{{ $userName }}</div>
                        <div class="mobile-user-email">{{ $user->email }}</div>
                    </li>
                    <li><hr class="mobile-dropdown-divider"></li>
                    <li>
                        <a class="mobile-dropdown-item" href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M12 1v6m0 6v6m9-9h-6m-6 0H3"/>
                            </svg>
                            <span>{{ __('app.settings') }}</span>
                        </a>
                    </li>
                    <li><hr class="mobile-dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="mobile-dropdown-item mobile-dropdown-danger">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 14l5-5-5-5m5 5H9"/>
                                </svg>
                                <span>{{ __('app.logout') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

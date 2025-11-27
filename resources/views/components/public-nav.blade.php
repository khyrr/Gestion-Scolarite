<nav class="navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
            <a href="{{ route('accueil') }}" class="navbar-brand">
                <div class="brand-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span>{{ config('school.school_name', 'Système Scolaire') }}</span>
            </a>
            
            <!-- Language Switcher -->
            <div class="lang-switcher dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-label="Change language">
                    @if(app()->getLocale() === 'fr')
                        <span class="fi fi-fr"></span>
                    @elseif(app()->getLocale() === 'ar')
                        <span class="fi fi-sa"></span>
                    @else
                        <span class="fi fi-us"></span>
                    @endif
                    <span class="d-none d-sm-inline ms-1">{{ strtoupper(app()->getLocale()) }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}"
                           href="{{ Route::has('lang.switch') ? route('lang.switch', 'fr') : url('/langue/fr') }}">
                            <span class="fi fi-fr me-2"></span> Français
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}"
                           href="{{ Route::has('lang.switch') ? route('lang.switch', 'ar') : url('/langue/ar') }}">
                            <span class="fi fi-sa me-2"></span> العربية
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                           href="{{ Route::has('lang.switch') ? route('lang.switch', 'en') : url('/langue/en') }}">
                            <span class="fi fi-us me-2"></span> English
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

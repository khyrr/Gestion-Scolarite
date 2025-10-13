<div class="sidebar bg-white shadow-sm {{ app()->getLocale() === 'ar' ? 'border-start' : 'border-end' }}">
    <!-- Sidebar Header -->
    <div class="sidebar-header border-bottom p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-school text-primary fs-4 {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
                <div class="d-none d-lg-block">
                    <h5 class="mb-0 fw-bold text-primary">{{ __('app.gestion_ecole') }}</h5>
                    <small class="text-muted">{{ config('app.name', 'École') }}</small>
                </div>
                <h6 class="mb-0 fw-bold text-primary d-lg-none">{{__('app.ecole')}}</h6>
            </div>
            
            <!-- Close button for mobile -->
            <button class="btn btn-link text-muted p-1 d-lg-none sidebar-close" type="button" aria-label="Close sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav p-3">
        <ul class="nav flex-column">
            @foreach($menuItems as $item)
                @if(isset($item['children']))
                    <!-- Menu with children -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center py-2 px-3 rounded {{ collect($item['children'])->pluck('active')->contains(true) ? 'active' : '' }}" 
                           data-bs-toggle="collapse" 
                           href="#menu-{{ Str::slug($item['title']) }}" 
                           role="button" 
                           aria-expanded="{{ collect($item['children'])->pluck('active')->contains(true) ? 'true' : 'false' }}"
                           aria-controls="menu-{{ Str::slug($item['title']) }}">
                            <i class="{{ $item['icon'] }} {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
                            <span>{{ $item['title'] }}</span>
                            <i class="fas fa-chevron-down {{ app()->getLocale() === 'ar' ? 'me-auto' : 'ms-auto' }}"></i>
                        </a>
                        <div class="collapse {{ collect($item['children'])->pluck('active')->contains(true) ? 'show' : '' }}" 
                             id="menu-{{ Str::slug($item['title']) }}">
                            <ul class="nav flex-column {{ app()->getLocale() === 'ar' ? 'me-3' : 'ms-3' }} mt-1">
                                @foreach($item['children'] as $child)
                                    <li class="nav-item">
                                        <a class="nav-link py-1 px-3 rounded {{ $child['active'] ?? false ? 'active' : '' }}" 
                                           href="{{ isset($child['params']) ? route($child['route'], $child['params']) : route($child['route']) }}">
                                            <i class="fas fa-circle text-muted {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}" style="font-size: 6px;"></i>
                                            {{ $child['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <!-- Single menu item -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center py-2 px-3 rounded {{ $item['active'] ?? false ? 'active' : '' }}" 
                           href="{{ route($item['route']) }}">
                            <i class="{{ $item['icon'] }} me-2"></i>
                            <span>{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer border-top p-3 mt-auto">
        <div class="d-flex align-items-center">
            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 flex-shrink-0" 
                 style="width: 32px; height: 32px;">
                <i class="fas fa-user"></i>
            </div>
            <div class="flex-grow-1 min-w-0">
                <div class="fw-semibold small text-truncate">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="text-muted small text-truncate d-none d-md-block">{{ auth()->user()->email ?? 'user@example.com' }}</div>
                <div class="text-muted small d-md-none">
                    @if(auth()->user()->role === 'admin')
                        <i class="fas fa-crown"></i> {{ __('app.administrateur') }}
                    @elseif(auth()->user()->role === 'enseignant')  
                        <i class="fas fa-chalkboard-teacher"></i> {{ __('app.enseignant') }}
                    @else
                        <i class="fas fa-user"></i> {{ __('app.utilisateur') }}
                    @endif
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-link text-muted p-1" data-bs-toggle="dropdown" aria-label="User options">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header d-lg-none">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <small class="text-muted text-truncate d-block">{{ auth()->user()->email }}</small>
                    </li>
                    <li class="d-lg-none"><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('enseignant.profil') }}"><i class="fas fa-user-cog me-2"></i>{{ __('app.profil') }}</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>{{ __('app.parametres') }}</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i>{{ __('app.notifications') }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('deconnexion') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('app.deconnexion') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Mobile-only quick actions -->
        <div class="d-lg-none mt-2 pt-2 border-top">
            <div class="d-flex justify-content-around">
                <button class="btn btn-link btn-sm text-muted" title="{{ __('app.notifications') }}">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="btn btn-link btn-sm text-muted" title="{{ __('app.messages') }}">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="btn btn-link btn-sm text-muted" title="{{ __('app.aide') }}">
                    <i class="fas fa-question-circle"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.sidebar {
    min-height: 100vh;
    width: var(--sidebar-width, 280px);
    position: fixed;
    top: 0;
    z-index: 1045;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* LTR: sidebar on left */
[dir="ltr"] .sidebar {
    left: 0;
    right: auto;
}

/* RTL: sidebar on right */
[dir="rtl"] .sidebar {
    right: 0;
    left: auto;
}

.sidebar-header {
    flex-shrink: 0;
    background-color: #fff;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #ccc transparent;
}

.sidebar-nav::-webkit-scrollbar {
    width: 4px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 2px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background-color: #999;
}

.sidebar .nav-link {
    color: #6c757d;
    transition: all 0.2s ease;
    border: none;
    background: transparent;
    white-space: nowrap;
    text-decoration: none;
    position: relative;
}

.sidebar .nav-link:hover {
    color: #495057;
    background-color: #f8f9fa;
    text-decoration: none;
}

.sidebar .nav-link.active {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
    font-weight: 500;
}

.sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 3px;
    background-color: #0d6efd;
}

/* LTR: active indicator on left */
[dir="ltr"] .sidebar .nav-link.active::before {
    left: 0;
    right: auto;
}

/* RTL: active indicator on right */
[dir="rtl"] .sidebar .nav-link.active::before {
    right: 0;
    left: auto;
}

.sidebar .nav-link i {
    width: 20px;
    text-align: center;
    flex-shrink: 0;
}

.collapse .nav-link {
    font-size: 0.9rem;
}

/* LTR: indent collapsed items from left */
[dir="ltr"] .collapse .nav-link {
    padding-left: 2.5rem;
    padding-right: 0.75rem;
}

/* RTL: indent collapsed items from right */
[dir="rtl"] .collapse .nav-link {
    padding-right: 2.5rem;
    padding-left: 0.75rem;
}

.sidebar-footer {
    background-color: #f8f9fa;
    flex-shrink: 0;
    border-top: 1px solid #dee2e6;
}

.sidebar-close {
    background: none !important;
    border: none !important;
    color: #6c757d !important;
    font-size: 1.1rem !important;
}

.sidebar-close:hover {
    color: #495057 !important;
}

/* Responsive Styles */
@media (max-width: 1199.98px) {
    .sidebar {
        width: 260px;
    }
}

@media (max-width: 991.98px) {
    /* LTR: sidebar slides in from left */
    [dir="ltr"] .sidebar {
        transform: translateX(-100%);
        width: 280px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    
    /* RTL: sidebar slides in from right */
    [dir="rtl"] .sidebar {
        transform: translateX(100%);
        width: 280px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar.show {
        transform: translateX(0);
    }
    
    .sidebar-nav {
        padding-top: 0;
    }
}

@media (max-width: 767.98px) {
    .sidebar {
        width: 100vw;
        max-width: 320px;
    }
    
    .sidebar-header {
        padding: 1rem 0.75rem;
    }
    
    .sidebar-nav {
        padding: 0 0.75rem;
    }
    
    .sidebar-footer {
        padding: 0.75rem;
    }
    
    .nav-link {
        padding: 0.625rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .collapse .nav-link {
        font-size: 0.85rem;
        padding-left: 2rem;
    }
}

@media (max-width: 575.98px) {
    .sidebar {
        width: 100vw;
        max-width: 100vw;
    }
    
    .sidebar-header h5 {
        font-size: 1rem;
    }
    
    .nav-link {
        font-size: 0.875rem;
    }
}

/* RTL Support */
[dir="rtl"] .sidebar {
    left: auto;
    right: 0;
}

[dir="rtl"] .sidebar .nav-link.active::before {
    left: auto;
    right: 0;
}

[dir="rtl"] .collapse .nav-link {
    padding-left: 0.75rem;
    padding-right: 2.5rem;
}

[dir="rtl"] @media (max-width: 991.98px) {
    .sidebar {
        transform: translateX(100%);
    }
    
    .sidebar.show {
        transform: translateX(0);
    }
}

/* Enhanced Focus States */
.sidebar .nav-link:focus,
.sidebar-close:focus,
.dropdown-toggle:focus {
    outline: 2px solid #0d6efd;
    outline-offset: -2px;
}

/* Animation for collapsible menus */
.collapse {
    transition: height 0.35s ease;
}

.collapsing {
    transition: height 0.35s ease;
}

/* Improve text readability */
.sidebar .nav-link span {
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Better visual hierarchy */
.nav-item.mb-1 > .nav-link {
    font-weight: 500;
}

.collapse .nav-item .nav-link {
    font-weight: 400;
    opacity: 0.9;
}

.collapse .nav-item .nav-link:hover {
    opacity: 1;
}

/* Accessibility improvements */
@media (prefers-reduced-motion: reduce) {
    .sidebar,
    .sidebar .nav-link,
    .collapse,
    .collapsing {
        transition: none !important;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .sidebar {
        border-right: 2px solid;
    }
    
    .sidebar .nav-link.active {
        background-color: highlight;
        color: highlighttext;
    }
}
</style>
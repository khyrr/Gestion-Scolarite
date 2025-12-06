<div class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-content">
                <h5 class="brand-title">{{ __('app.gestion_ecole') }}</h5>
                <span class="brand-subtitle">{{ config('app.name', 'École') }}</span>
            </div>
        </div>
        
        <!-- Close button for mobile -->
        <button class="sidebar-close" type="button" aria-label="{{ __('app.fermer') }}">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <ul class="nav-menu">
            @foreach($menuItems as $item)
                @if(isset($item['children']))
                    <!-- Menu with children -->
                    <li class="nav-item {{ collect($item['children'])->pluck('active')->contains(true) ? 'has-active' : '' }}">
                        <button class="nav-link nav-toggle" 
                                type="button"
                                data-bs-toggle="collapse" 
                                data-bs-target="#menu-{{ Str::slug($item['title']) }}" 
                                aria-expanded="{{ collect($item['children'])->pluck('active')->contains(true) ? 'true' : 'false' }}"
                                aria-controls="menu-{{ Str::slug($item['title']) }}">
                            <span class="nav-icon">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <span class="nav-text">{{ $item['title'] }}</span>
                            <span class="nav-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                        <div class="collapse nav-submenu {{ collect($item['children'])->pluck('active')->contains(true) ? 'show' : '' }}" 
                             id="menu-{{ Str::slug($item['title']) }}">
                            <ul class="submenu-list">
                                @foreach($item['children'] as $child)
                                    <li class="submenu-item">
                                        <a class="submenu-link {{ $child['active'] ?? false ? 'active' : '' }}" 
                                           href="{{ isset($child['params']) ? route($child['route'], $child['params']) : route($child['route']) }}">
                                            <span class="submenu-dot"></span>
                                            <span class="submenu-text">{{ $child['title'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <!-- Single menu item -->
                    <li class="nav-item">
                        <a class="nav-link {{ $item['active'] ?? false ? 'active' : '' }}" 
                           href="{{ route($item['route']) }}">
                            <span class="nav-icon">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <span class="nav-text">{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                @php
                    $user = auth()->user();
                    $userName = $user->name ?? 'User';
                    $userEmail = $user->email ?? '';
                    $initials = collect(explode(' ', $userName))->map(fn($word) => mb_substr($word, 0, 1))->take(2)->join('');
                @endphp
                <span class="avatar-text">{{ $initials }}</span>
            </div>
            <div class="user-info">
                <div class="user-name">{{ $userName }}</div>
                <div class="user-role">
                    @if($user->isAdmin())
                        <i class="fas fa-shield-alt"></i> {{ __('app.administrateur') }}
                    @elseif($user->isTeacher())  
                        <i class="fas fa-chalkboard-teacher"></i> {{ __('app.enseignant') }}
                    @else
                        <i class="fas fa-user"></i> {{ __('app.utilisateur') }}
                    @endif
                </div>
            </div>
            <div class="dropdown user-dropdown">
                <button class="user-menu-btn" data-bs-toggle="dropdown" aria-label="{{ __('app.menu_utilisateur') }}">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="dropdown-user-name">{{ $userName }}</div>
                        <div class="dropdown-user-email">{{ $userEmail }}</div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @if($user->isTeacher())
                    <li>
                        <a class="dropdown-item" href="{{ route('enseignant.profil') }}">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ __('app.profil') }}</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog"></i>
                            <span>{{ __('app.parametres') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-bell"></i>
                            <span>{{ __('app.notifications') }}</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ $user->isAdmin() ? route('admin.logout') : route('enseignant.deconnexion') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-item-danger">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('app.deconnexion') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
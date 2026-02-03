@props(['themeVars'])

<nav class="sticky top-0 z-50 material-card shadow-material-2 border-b border-surface-200/50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Site Name -->
            <div class="flex items-center">
                <a href="{{ route('homepage') }}" class="flex items-center space-x-3 group">
                    @if(isset($themeVars['logo_url']) && $themeVars['logo_url'])
                        <div class="relative">
                            <div class="absolute inset-0 bg-primary-200 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-200"></div>
                            <img src="{{ Storage::url($themeVars['logo_url']) }}" 
                                 alt="{{ $themeVars['site_name'] ?? 'Logo' }}" 
                                 class="h-10 w-10 object-contain rounded-lg relative z-10">
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="text-lg font-medium text-on-surface group-hover:text-primary-700 transition-colors duration-200">
                            {{ $themeVars['site_name'] ?? 'School Management System' }}
                        </span>
                        <span class="text-xs text-surface-600 -mt-0.5">Excellence in Education</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                @php
                    $navigationPages = \App\Models\Page::getNavigationPages();
                @endphp
                
                <a href="{{ route('homepage') }}" 
                   class="material-button px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 
                          {{ request()->routeIs('homepage') ? 'bg-primary-100 text-primary-700' : 'text-surface-700 hover:bg-primary-50 hover:text-primary-700' }}">
                    <span class="material-icons-round text-sm mr-2 inline-block align-middle">home</span>
                    Home
                </a>
                
                @foreach($navigationPages as $navPage)
                    @if($navPage->slug !== 'homepage')
                        <a href="{{ route('page.show', $navPage->slug) }}" 
                           class="material-button px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                                  {{ request()->route('slug') === $navPage->slug ? 'bg-primary-100 text-primary-700' : 'text-surface-700 hover:bg-primary-50 hover:text-primary-700' }}">
                            {{ $navPage->title }}
                        </a>
                    @endif
                @endforeach
                
                <!-- Authentication Links -->
                @auth
                    <div class="relative ml-4" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                class="material-button flex items-center space-x-2 px-4 py-2 rounded-full bg-surface-50 hover:bg-surface-100 text-surface-700 hover:text-primary-700 transition-all duration-200 shadow-material-1">
                            <span class="material-icons-round text-sm">account_circle</span>
                            <span class="text-sm font-medium">{{ Auth::user()->name ?? 'Dashboard' }}</span>
                            <span class="material-icons-round text-sm">keyboard_arrow_down</span>
                        </button>
                        <div x-show="dropdownOpen" 
                             @click.away="dropdownOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 material-card rounded-material shadow-material-3 border border-surface-200/50 overflow-hidden">
                            <a href="/admin" class="flex items-center px-4 py-3 text-sm text-surface-700 hover:bg-primary-50 hover:text-primary-700 transition-colors">
                                <span class="material-icons-round text-sm mr-3">dashboard</span>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-3 text-sm text-surface-700 hover:bg-red-50 hover:text-red-600 transition-colors border-t border-surface-100">
                                    <span class="material-icons-round text-sm mr-3">logout</span>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="ml-4">
                        <a href="/login" 
                           class="material-button inline-flex items-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-full text-sm font-medium shadow-material-2 hover:shadow-material-3 transition-all duration-200">
                            <span class="material-icons-round text-sm">login</span>
                            <span>Login</span>
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="material-button p-3 rounded-full hover:bg-surface-100 text-surface-700 hover:text-primary-700 transition-all duration-200">
                    <span class="material-icons-round" x-text="mobileMenuOpen ? 'close' : 'menu'"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden material-card border-t border-surface-200/50">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('homepage') }}" 
               class="material-button flex items-center px-4 py-3 rounded-material text-base font-medium transition-all duration-200
                      {{ request()->routeIs('homepage') ? 'bg-primary-100 text-primary-700' : 'text-surface-700 hover:bg-primary-50 hover:text-primary-700' }}">
                <span class="material-icons-round text-sm mr-3">home</span>
                Home
            </a>
            
            @foreach($navigationPages as $navPage)
                @if($navPage->slug !== 'homepage')
                    <a href="{{ route('page.show', $navPage->slug) }}" 
                       class="material-button flex items-center px-4 py-3 rounded-material text-base font-medium transition-all duration-200
                              {{ request()->route('slug') === $navPage->slug ? 'bg-primary-100 text-primary-700' : 'text-surface-700 hover:bg-primary-50 hover:text-primary-700' }}">
                        <span class="material-icons-round text-sm mr-3">description</span>
                        {{ $navPage->title }}
                    </a>
                @endif
            @endforeach
            
            @auth
                <div class="pt-2 border-t border-surface-200 mt-4">
                    <a href="/admin" class="material-button flex items-center px-4 py-3 rounded-material text-base font-medium text-surface-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <span class="material-icons-round text-sm mr-3">dashboard</span>
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="material-button flex items-center w-full text-left px-4 py-3 rounded-material text-base font-medium text-red-600 hover:bg-red-50 transition-all duration-200">
                            <span class="material-icons-round text-sm mr-3">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-2 border-t border-surface-200 mt-4">
                    <a href="/login" 
                       class="material-button flex items-center justify-center px-4 py-3 rounded-material text-base font-medium bg-primary-600 hover:bg-primary-700 text-white shadow-material-2 hover:shadow-material-3 transition-all duration-200">
                        <span class="material-icons-round text-sm mr-2">login</span>
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
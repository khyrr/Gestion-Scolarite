@props(['themeVars'])

<footer class="bg-gradient-to-br from-surface-900 to-surface-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 sm:gap-8 lg:gap-12">
            <!-- School Information -->
            <div class="col-span-1 sm:col-span-2 xl:col-span-2">
                <div class="flex flex-col items-start space-y-4 mb-6">
                    @if(isset($themeVars['logo_url']) && $themeVars['logo_url'])
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ Storage::url($themeVars['logo_url']) }}" 
                                     alt="{{ $themeVars['site_name'] ?? 'Logo' }}" 
                                     class="h-8 sm:h-10 lg:h-12 w-8 sm:w-10 lg:w-12 object-contain rounded-material">
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white leading-tight">{{ $themeVars['site_name'] ?? 'School Management System' }}</h3>
                        </div>
                    @else
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">{{ $themeVars['site_name'] ?? 'School Management System' }}</h3>
                    @endif
                </div>
                <p class="text-surface-300 mb-4 sm:mb-6 leading-relaxed max-w-sm sm:max-w-md lg:max-w-lg text-sm sm:text-base">
                    Excellence in Education - Providing quality education and fostering student success with innovation, dedication, and care.
                </p>
                @if(isset($themeVars['contact_address']) && $themeVars['contact_address'])
                    <div class="flex items-start text-surface-300 group hover:text-white transition-colors duration-200">
                        <span class="material-icons-round text-primary-400 mr-2 sm:mr-3 mt-0.5 group-hover:text-primary-300 transition-colors flex-shrink-0 text-lg sm:text-xl">location_on</span>
                        <p class="leading-relaxed text-sm sm:text-base">{{ $themeVars['contact_address'] }}</p>
                    </div>
                @endif
            </div>

            <!-- Quick Links -->
            <div class="mt-8 sm:mt-0">
                <h4 class="text-base sm:text-lg font-semibold mb-4 sm:mb-6 text-white flex items-center">
                    <span class="material-icons-round text-primary-400 mr-2 text-base sm:text-lg">link</span>
                    <span class="text-sm sm:text-base lg:text-lg">Quick Links</span>
                </h4>
                <nav aria-label="Footer navigation">
                    <ul class="space-y-2 sm:space-y-3">
                        <li>
                            <a href="{{ route('homepage') }}" 
                               class="text-surface-300 hover:text-primary-300 transition-colors flex items-center group text-sm sm:text-base py-1 hover:bg-surface-800/30 rounded px-1 -mx-1">
                                <span class="material-icons-round text-xs sm:text-sm mr-2 opacity-60 group-hover:opacity-100 transition-opacity">home</span>
                                Home
                            </a>
                        </li>
                        @php
                            $footerPages = \App\Models\Page::enabled()->public()->ordered()->take(4)->get();
                        @endphp
                        @foreach($footerPages as $page)
                            @if($page->slug !== 'homepage')
                                <li>
                                    <a href="{{ route('page.show', $page->slug) }}" 
                                       class="text-surface-300 hover:text-primary-300 transition-colors flex items-center group text-sm sm:text-base py-1 hover:bg-surface-800/30 rounded px-1 -mx-1">
                                        <span class="material-icons-round text-xs sm:text-sm mr-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                            @if($page->slug === 'about') info
                                            @elseif($page->slug === 'contact') contact_mail
                                            @else article
                                            @endif
                                        </span>
                                        {{ $page->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
            <!-- Contact Information -->
            <div class="mt-8 sm:mt-0 xl:mt-0">
                <h4 class="text-base sm:text-lg font-semibold mb-4 sm:mb-6 text-white flex items-center">
                    <span class="material-icons-round text-primary-400 mr-2 text-base sm:text-lg">contact_phone</span>
                    <span class="text-sm sm:text-base lg:text-lg">Contact Us</span>
                </h4>
                <div class="space-y-3 sm:space-y-4">
                    @if(isset($themeVars['contact_email']) && $themeVars['contact_email'])
                        <div class="group">
                            <a href="mailto:{{ $themeVars['contact_email'] }}" 
                               class="flex items-start sm:items-center text-surface-300 hover:text-primary-300 transition-colors hover:bg-surface-800/30 rounded p-2 -m-2">
                                <span class="material-icons-round text-primary-400 mr-2 sm:mr-3 group-hover:text-primary-300 transition-colors flex-shrink-0 text-lg sm:text-xl mt-0.5 sm:mt-0">email</span>
                                <span class="group-hover:text-white transition-colors text-xs sm:text-sm lg:text-base break-all sm:break-normal">
                                    {{ $themeVars['contact_email'] }}
                                </span>
                            </a>
                        </div>
                    @endif
                    
                    @if(isset($themeVars['contact_phone']) && $themeVars['contact_phone'])
                        <div class="group">
                            <a href="tel:{{ $themeVars['contact_phone'] }}" 
                               class="flex items-center text-surface-300 hover:text-primary-300 transition-colors hover:bg-surface-800/30 rounded p-2 -m-2">
                                <span class="material-icons-round text-primary-400 mr-2 sm:mr-3 group-hover:text-primary-300 transition-colors text-lg sm:text-xl">phone</span>
                                <span class="group-hover:text-white transition-colors text-sm sm:text-base">
                                    {{ $themeVars['contact_phone'] }}
                                </span>
                            </a>
                        </div>
                    @endif
                    
                    <div class="pt-2">
                        <a href="{{ route('page.show', 'contact') }}" 
                           class="inline-flex items-center justify-center w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-material transition-all duration-200 hover:shadow-material-3 text-sm sm:text-base font-medium">
                            <span class="material-icons-round text-sm sm:text-base mr-2">send</span>
                            Send Message
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-surface-700/50 mt-8 sm:mt-12 pt-6 sm:pt-8">
            <div class="flex flex-col space-y-4 sm:space-y-6 md:flex-row md:justify-between md:items-center md:space-y-0">
                <!-- Copyright -->
                <div class="text-surface-300 text-xs sm:text-sm flex items-center justify-center md:justify-start order-2 md:order-1">
                    <span class="material-icons-round text-primary-400 mr-2 text-sm flex-shrink-0">copyright</span>
                    <span class="text-center md:text-left">
                        {{ date('Y') }} {{ $themeVars['site_name'] ?? 'School Management System' }}. All rights reserved.
                    </span>
                </div>
                
                <!-- Language Switcher -->
                <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 lg:space-x-6 order-1 md:order-2">
                    <!-- Language Label -->
                    <div class="flex items-center space-x-2">
                        <span class="material-icons-round text-surface-400 text-sm sm:text-base">language</span>
                        <span class="text-surface-400 text-xs sm:text-sm font-medium whitespace-nowrap">Language:</span>
                    </div>
                    
                    <!-- Language Options -->
                    <div class="flex items-center space-x-1 bg-surface-800/50 rounded-material p-1">
                        <a href="{{ route('lang.switch', 'en') }}" 
                           class="px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm rounded transition-all duration-200 min-w-[2.5rem] sm:min-w-[3rem] text-center
                                  {{ app()->getLocale() === 'en' 
                                     ? 'bg-primary-600 text-white shadow-material-2 font-semibold' 
                                     : 'text-surface-300 hover:text-white hover:bg-surface-700' }}">
                            EN
                        </a>
                        <div class="w-px h-4 sm:h-5 bg-surface-600"></div>
                        <a href="{{ route('lang.switch', 'fr') }}" 
                           class="px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm rounded transition-all duration-200 min-w-[2.5rem] sm:min-w-[3rem] text-center
                                  {{ app()->getLocale() === 'fr' 
                                     ? 'bg-primary-600 text-white shadow-material-2 font-semibold' 
                                     : 'text-surface-300 hover:text-white hover:bg-surface-700' }}">
                            FR
                        </a>
                        <div class="w-px h-4 sm:h-5 bg-surface-600"></div>
                        <a href="{{ route('lang.switch', 'ar') }}" 
                           class="px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm rounded transition-all duration-200 min-w-[2.5rem] sm:min-w-[3rem] text-center
                                  {{ app()->getLocale() === 'ar' 
                                     ? 'bg-primary-600 text-white shadow-material-2 font-semibold' 
                                     : 'text-surface-300 hover:text-white hover:bg-surface-700' }}">
                            AR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@extends('public.layouts.app')

@section('title', $page->title . ' - ' . ($themeVars['site_name'] ?? 'School'))
@section('description', 'Welcome to ' . ($themeVars['site_name'] ?? 'our school') . ' - Excellence in Education')

@section('content')
<div class="relative">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center material-surface overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-0 left-0 w-64 sm:w-80 lg:w-96 h-64 sm:h-80 lg:h-96 bg-gradient-to-br from-primary-200 to-primary-300 rounded-full -translate-x-32 sm:-translate-x-40 lg:-translate-x-48 -translate-y-32 sm:-translate-y-40 lg:-translate-y-48 blur-2xl sm:blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-64 sm:w-80 lg:w-96 h-64 sm:h-80 lg:h-96 bg-gradient-to-br from-primary-300 to-primary-400 rounded-full translate-x-32 sm:translate-x-40 lg:translate-x-48 translate-y-32 sm:translate-y-40 lg:translate-y-48 blur-2xl sm:blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 w-48 sm:w-56 lg:w-64 h-48 sm:h-56 lg:h-64 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full -translate-x-24 sm:-translate-x-28 lg:-translate-x-32 -translate-y-24 sm:-translate-y-28 lg:-translate-y-32 blur-xl sm:blur-2xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 sm:py-20 lg:py-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center lg:text-left lg:pr-8">
                    <div class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                        <span class="material-icons-round text-sm mr-2">school</span>
                        Welcome to {{ $themeVars['site_name'] ?? 'Our School' }}
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-on-surface mb-4 sm:mb-6 leading-tight">
                        Excellence in 
                        <span class="text-transparent bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text">
                            Education
                        </span>
                    </h1>
                    </h1>
                    
                    <p class="text-base sm:text-lg lg:text-xl text-surface-600 mb-6 sm:mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Building tomorrow's leaders through innovative learning and comprehensive education programs.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('page.show', 'about') }}" 
                           class="material-button inline-flex items-center justify-center space-x-2 sm:space-x-3 bg-primary-600 hover:bg-primary-700 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-material-lg font-medium shadow-material-3 hover:shadow-material-4 transition-all duration-200 group">
                            <span class="text-sm sm:text-base">Learn More</span>
                            <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
                        </a>
                        <a href="{{ route('page.show', 'contact') }}" 
                           class="material-button inline-flex items-center justify-center space-x-2 sm:space-x-3 material-card border border-primary-200 hover:border-primary-300 text-primary-700 px-6 sm:px-8 py-3 sm:py-4 rounded-material-lg font-medium hover:shadow-material-2 transition-all duration-200">
                            <span class="material-icons-round text-sm">contact_mail</span>
                            <span class="text-sm sm:text-base">Get in Touch</span>
                        </a>
                    </div>
                </div>
                
                <!-- Hero Visual -->
                <div class="lg:pl-8 mt-8 lg:mt-0 order-first lg:order-last">
                    <div class="relative max-w-sm sm:max-w-md mx-auto lg:max-w-none">
                        <!-- Main Card -->
                        <div class="material-card rounded-material-xl p-6 sm:p-8 shadow-material-5 transform rotate-2 sm:rotate-3 hover:rotate-1 transition-transform duration-500">
                            <div class="text-center">
                                <div class="w-12 sm:w-16 h-12 sm:h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full mx-auto mb-3 sm:mb-4 flex items-center justify-center shadow-material-2">
                                    <span class="material-icons-round text-white text-xl sm:text-2xl">auto_stories</span>
                                </div>
                                <h3 class="text-lg sm:text-xl font-semibold text-on-surface mb-2">Digital Learning</h3>
                                <p class="text-surface-600 text-xs sm:text-sm">Modern tools for modern education</p>
                            </div>
                        </div>
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-2 sm:-top-4 -right-2 sm:-right-4 material-card rounded-material p-3 sm:p-4 shadow-material-3 bg-gradient-to-br from-green-50 to-green-100 border border-green-200 transform -rotate-12 hover:rotate-0 transition-transform duration-500">
                            <div class="w-8 sm:w-10 h-8 sm:h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <span class="material-icons-round text-white text-xs sm:text-sm">trending_up</span>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-2 sm:-bottom-4 -left-2 sm:-left-4 material-card rounded-material p-3 sm:p-4 shadow-material-3 bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 transform rotate-12 hover:rotate-0 transition-transform duration-500">
                            <div class="w-8 sm:w-10 h-8 sm:h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                <span class="material-icons-round text-white text-xs sm:text-sm">group</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce">
                <div class="w-12 h-12 rounded-full material-card shadow-material-2 flex items-center justify-center">
                    <span class="material-icons-round text-primary-600">keyboard_arrow_down</span>
                </div>
            </div>
        </div>
    </section>
        
        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-12 fill-current text-gray-50">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gradient-to-b from-surface-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-sm font-medium mb-6">
                    <span class="material-icons-round text-sm mr-2">stars</span>
                    Why Choose Us
                </div>
                <h2 class="text-4xl font-bold text-on-surface mb-4">Excellence in Every Aspect</h2>
                <p class="text-xl text-surface-600 max-w-3xl mx-auto">
                    Discover what makes our school a leader in educational innovation and student success.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">school</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Expert Faculty</h3>
                    <p class="text-surface-600 leading-relaxed">Dedicated educators with advanced degrees and years of experience in their fields.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">science</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Modern Labs</h3>
                    <p class="text-surface-600 leading-relaxed">State-of-the-art laboratories equipped with latest technology for hands-on learning.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">sports</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Sports Excellence</h3>
                    <p class="text-surface-600 leading-relaxed">Comprehensive sports programs to develop physical fitness and team spirit.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">computer</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Digital Learning</h3>
                    <p class="text-surface-600 leading-relaxed">Advanced technology integration for interactive and engaging learning experiences.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">psychology</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Student Support</h3>
                    <p class="text-surface-600 leading-relaxed">Comprehensive counseling and support services for academic and personal growth.</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="group material-card rounded-material-xl p-8 hover:shadow-material-4 transition-all duration-300 border border-surface-200/50 hover:border-primary-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-material shadow-material-2 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-icons-round text-white text-2xl">group</span>
                    </div>
                    <h3 class="text-xl font-semibold text-on-surface mb-3">Community</h3>
                    <p class="text-surface-600 leading-relaxed">Strong school community fostering collaboration and lifelong friendships.</p>
                </div>
            </div>
            
            <!-- Content from Page -->
            <div class="mt-16 prose prose-lg max-w-none">
                {!! $page->getContent() !!}
            </div>
        </div>
    </section>

    <!-- Quick Access Section -->
    <section class="py-24 material-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-sm font-medium mb-6">
                    <span class="material-icons-round text-sm mr-2">login</span>
                    Quick Access
                </div>
                <h2 class="text-4xl font-bold text-on-surface mb-4">Access Your Portal</h2>
                <p class="text-xl text-surface-600 max-w-3xl mx-auto">
                    Connect to your personalized dashboard for grades, assignments, and school services.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Students Portal -->
                <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-5 transition-all duration-300 border border-surface-200/50 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-material-lg shadow-material-3 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-icons-round text-white text-3xl">school</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-on-surface mb-3">Student Portal</h3>
                        <p class="text-surface-600 mb-6 leading-relaxed">Access grades, assignments, schedules, and school information in your personalized dashboard.</p>
                        <a href="/login?role=student" 
                           class="material-button inline-flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-material font-medium shadow-material-2 hover:shadow-material-3 transition-all duration-200">
                            <span class="material-icons-round text-sm">login</span>
                            <span>Student Login</span>
                        </a>
                    </div>
                </div>

                <!-- Parents Portal -->
                <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-5 transition-all duration-300 border border-surface-200/50 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-material-lg shadow-material-3 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-icons-round text-white text-3xl">family_restroom</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-on-surface mb-3">Parent Portal</h3>
                        <p class="text-surface-600 mb-6 leading-relaxed">Monitor your child's academic progress, attendance, and communicate with teachers.</p>
                        <a href="/login?role=parent" 
                           class="material-button inline-flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-material font-medium shadow-material-2 hover:shadow-material-3 transition-all duration-200">
                            <span class="material-icons-round text-sm">login</span>
                            <span>Parent Login</span>
                        </a>
                    </div>
                </div>

                <!-- Staff Portal -->
                <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-5 transition-all duration-300 border border-surface-200/50 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-material-lg shadow-material-3 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-icons-round text-white text-3xl">admin_panel_settings</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-on-surface mb-3">Staff Portal</h3>
                        <p class="text-surface-600 mb-6 leading-relaxed">Access administrative tools, grade management, and teaching resources.</p>
                        <a href="/login" 
                           class="material-button inline-flex items-center justify-center space-x-2 bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-material font-medium shadow-material-2 hover:shadow-material-3 transition-all duration-200">
                            <span class="material-icons-round text-sm">login</span>
                            <span>Staff Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Announcements Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-b from-white to-surface-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                    <span class="material-icons-round text-sm mr-2">newspaper</span>
                    Latest Updates
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-on-surface mb-3 sm:mb-4">News & Announcements</h2>
                <p class="text-base sm:text-lg lg:text-xl text-surface-600 max-w-2xl lg:max-w-3xl mx-auto px-4 sm:px-0">
                    Stay informed with the latest school events and important information.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- News Item 1 -->
                <article class="group material-card rounded-material-xl overflow-hidden hover:shadow-material-4 transition-all duration-300 border border-surface-200/50">
                    <div class="h-40 sm:h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                        <span class="material-icons-round text-primary-600 text-4xl sm:text-5xl">celebration</span>
                    </div>
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center text-xs sm:text-sm text-surface-500 mb-2 sm:mb-3">
                            <span class="material-icons-round text-xs sm:text-sm mr-1">schedule</span>
                            {{ now()->format('M d, Y') }}
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-on-surface mb-2 sm:mb-3 group-hover:text-primary-700 transition-colors leading-tight">Welcome to New Academic Year</h3>
                        <p class="text-sm sm:text-base text-surface-600 mb-3 sm:mb-4 leading-relaxed">We're excited to welcome all students and families to the new academic year. Registration is now open for all programs.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors text-sm sm:text-base">
                            <span>Read more</span>
                            <span class="material-icons-round text-sm ml-1 group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
                        </a>
                    </div>
                </article>
                
                <!-- News Item 2 -->
                <article class="group material-card rounded-material-xl overflow-hidden hover:shadow-material-4 transition-all duration-300 border border-surface-200/50">
                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                        <span class="material-icons-round text-green-600 text-5xl">emoji_events</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-surface-500 mb-3">
                            <span class="material-icons-round text-sm mr-1">schedule</span>
                            {{ now()->subDays(2)->format('M d, Y') }}
                        </div>
                        <h3 class="text-xl font-semibold text-on-surface mb-3 group-hover:text-primary-700 transition-colors">Sports Day Results</h3>
                        <p class="text-surface-600 mb-4 leading-relaxed">Congratulations to all students who participated in our annual sports day. View the complete results and photos here.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            <span>Read more</span>
                            <span class="material-icons-round text-sm ml-1 group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
                        </a>
                    </div>
                </article>
                
                <!-- News Item 3 -->
                <article class="group material-card rounded-material-xl overflow-hidden hover:shadow-material-4 transition-all duration-300 border border-surface-200/50">
                    <div class="h-48 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                        <span class="material-icons-round text-orange-600 text-5xl">groups</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-surface-500 mb-3">
                            <span class="material-icons-round text-sm mr-1">schedule</span>
                            {{ now()->subDays(5)->format('M d, Y') }}
                        </div>
                        <h3 class="text-xl font-semibold text-on-surface mb-3 group-hover:text-primary-700 transition-colors">Parent-Teacher Conference</h3>
                        <p class="text-surface-600 mb-4 leading-relaxed">Schedule your parent-teacher conference meetings for the upcoming month. Online booking system is now available.</p>
                        <a href="#" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors">
                            <span>Read more</span>
                            <span class="material-icons-round text-sm ml-1 group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>
@endsection
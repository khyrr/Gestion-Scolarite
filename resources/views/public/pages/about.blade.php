@extends('public.layouts.app')

@section('title', $page->title . ' - ' . ($themeVars['site_name'] ?? 'School'))
@section('description', 'Learn about our school, mission, vision, and values')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary-50 via-surface-50 to-primary-100 py-12 sm:py-16 lg:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full bg-white/80 backdrop-blur border border-primary-200 text-primary-700 text-xs sm:text-sm font-medium mb-6 sm:mb-8">
                <span class="material-icons-round text-sm mr-2">school</span>
                About Us
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-on-surface mb-4 sm:mb-6">{{ $page->title }}</h1>
            <p class="text-base sm:text-lg lg:text-xl text-surface-600 max-w-2xl lg:max-w-3xl mx-auto leading-relaxed px-4 sm:px-0">
                Discover our story, mission, and commitment to educational excellence
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Content -->
        <div class="prose prose-sm sm:prose prose-lg lg:prose-xl max-w-none prose-primary">
            <div class="text-surface-600 leading-relaxed">
                {!! $page->getContent() !!}
            </div>
        </div>
        
        <!-- Mission & Vision Cards -->
        <div class="mt-16 sm:mt-20 grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            <!-- Our History -->
            <div class="material-card rounded-material-xl p-6 sm:p-8 bg-gradient-to-br from-primary-50 to-primary-100 border border-primary-200/50">
                <div class="inline-flex items-center justify-center w-12 sm:w-16 h-12 sm:h-16 rounded-material bg-primary-600 text-white mb-4 sm:mb-6">
                    <span class="material-icons-round text-xl sm:text-2xl">history</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-on-surface mb-3 sm:mb-4">Our History</h2>
                <p class="text-sm sm:text-base text-surface-600 leading-relaxed">
                    Founded with a vision to provide quality education, our school has been serving the community for years. 
                    We have evolved and grown while maintaining our core values of excellence, integrity, and innovation.
                </p>
            </div>

            <!-- Our Achievements -->
            <div class="material-card rounded-material-xl p-6 sm:p-8 bg-gradient-to-br from-green-50 to-green-100 border border-green-200/50">
                <div class="inline-flex items-center justify-center w-12 sm:w-16 h-12 sm:h-16 rounded-material bg-green-600 text-white mb-4 sm:mb-6">
                    <span class="material-icons-round text-xl sm:text-2xl">emoji_events</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-on-surface mb-3 sm:mb-4">Our Achievements</h2>
                <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base text-surface-600">
                    <li class="flex items-center">
                        <span class="material-icons-round text-green-500 mr-2 sm:mr-3">check_circle</span>
                        Excellence in Academic Performance
                    </li>
                    <li class="flex items-center">
                        <span class="material-icons-round text-green-500 mr-3">check_circle</span>
                        Award-winning Sports Programs
                    </li>
                    <li class="flex items-center">
                        <span class="material-icons-round text-green-500 mr-3">check_circle</span>
                        Outstanding Alumni Network
                    </li>
                    <li class="flex items-center">
                        <span class="material-icons-round text-green-500 mr-3">check_circle</span>
                        Modern Educational Technology
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Team -->
<section class="py-20 bg-gradient-to-b from-white to-surface-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-sm font-medium mb-6">
                <span class="material-icons-round text-sm mr-2">groups</span>
                Leadership
            </div>
            <h2 class="text-4xl font-bold text-on-surface mb-4">Our Leadership Team</h2>
            <p class="text-xl text-surface-600">Meet the dedicated professionals leading our institution</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Principal -->
            <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-4 transition-all duration-300">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-primary-200 to-primary-300 rounded-full mx-auto flex items-center justify-center">
                        <span class="material-icons-round text-primary-600 text-4xl">person</span>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-on-surface mb-2">Principal Name</h3>
                <p class="text-primary-600 font-medium mb-3">Principal</p>
                <p class="text-surface-600 leading-relaxed">Leading educational excellence and student success with vision and dedication.</p>
            </div>
            
            <!-- Vice Principal -->
            <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-4 transition-all duration-300">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-200 to-green-300 rounded-full mx-auto flex items-center justify-center">
                        <span class="material-icons-round text-green-600 text-4xl">person</span>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-on-surface mb-2">Vice Principal Name</h3>
                <p class="text-green-600 font-medium mb-3">Vice Principal</p>
                <p class="text-surface-600 leading-relaxed">Supporting academic programs and fostering student development across all levels.</p>
            </div>
            
            <!-- Academic Coordinator -->
            <div class="group material-card rounded-material-xl p-8 text-center hover:shadow-material-4 transition-all duration-300">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-orange-200 to-orange-300 rounded-full mx-auto flex items-center justify-center">
                        <span class="material-icons-round text-orange-600 text-4xl">person</span>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-on-surface mb-2">Academic Coordinator</h3>
                <p class="text-orange-600 font-medium mb-3">Academic Coordinator</p>
                <p class="text-surface-600 leading-relaxed">Coordinating curriculum excellence and maintaining educational standards.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-br from-primary-600 to-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Join Our School Community?</h2>
        <p class="text-xl text-primary-100 mb-10 leading-relaxed">
            Discover how we can help your child reach their full potential in a nurturing, excellence-driven environment.
        </p>
        <a href="{{ route('page.show', 'contact') }}" 
           class="inline-flex items-center px-8 py-4 bg-white text-primary-600 hover:bg-surface-50 rounded-material-lg font-semibold transition-all duration-200 hover:shadow-material-3 hover:-translate-y-0.5">
            <span class="material-icons-round mr-2">contact_mail</span>
            Contact Us Today
        </a>
    </div>
</section>
@endsection
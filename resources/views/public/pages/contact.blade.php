@extends('public.layouts.app')

@section('title', $page->title . ' - ' . ($themeVars['site_name'] ?? 'School'))
@section('description', 'Get in touch with us - Contact information and send us a message')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary-50 via-surface-50 to-primary-100 py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full bg-white/80 backdrop-blur border border-primary-200 text-primary-700 text-xs sm:text-sm font-medium mb-6 sm:mb-8">
                <span class="material-icons-round text-sm mr-2">contact_mail</span>
                Get In Touch
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-on-surface mb-4 sm:mb-6">{{ $page->title }}</h1>
            <p class="text-base sm:text-lg lg:text-xl text-surface-600 max-w-2xl lg:max-w-3xl mx-auto leading-relaxed px-4 sm:px-0">
                We'd love to hear from you. Reach out to us for any questions or inquiries.
            </p>
        </div>
    </div>
</section>

<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Contact Information -->
            <div class="space-y-6 sm:space-y-8 order-2 lg:order-1">
                <div class="material-card rounded-material-xl p-6 sm:p-8 bg-gradient-to-br from-white to-surface-50 border border-surface-200/50">
                    <div class="flex items-center mb-6 sm:mb-8">
                        <div class="inline-flex items-center justify-center w-10 sm:w-12 h-10 sm:h-12 rounded-material bg-primary-600 text-white mr-3 sm:mr-4">
                            <span class="material-icons-round text-lg sm:text-xl">info</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-on-surface">Contact Information</h2>
                    </div>
                    
                    <div class="space-y-6 sm:space-y-8">
                        <!-- Address -->
                        @if(isset($themeVars['contact_address']) && $themeVars['contact_address'])
                            <div class="flex items-start group">
                                <div class="flex-shrink-0">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 bg-primary-50 text-primary-600 rounded-material-lg flex items-center justify-center group-hover:bg-primary-100 transition-colors">
                                        <span class="material-icons-round text-lg sm:text-xl">location_on</span>
                                    </div>
                                </div>
                                <div class="ml-4 sm:ml-6">
                                    <h3 class="text-base sm:text-lg font-semibold text-on-surface mb-1 sm:mb-2">Our Location</h3>
                                    <p class="text-sm sm:text-base text-surface-600 leading-relaxed">{{ $themeVars['contact_address'] }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Email -->
                        @if(isset($themeVars['contact_email']) && $themeVars['contact_email'])
                            <div class="flex items-start group">
                                <div class="flex-shrink-0">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 bg-green-50 text-green-600 rounded-material-lg flex items-center justify-center group-hover:bg-green-100 transition-colors">
                                        <span class="material-icons-round text-lg sm:text-xl">email</span>
                                    </div>
                                </div>
                                <div class="ml-4 sm:ml-6">
                                    <h3 class="text-base sm:text-lg font-semibold text-on-surface mb-1 sm:mb-2">Email Us</h3>
                                    <a href="mailto:{{ $themeVars['contact_email'] }}" 
                                       class="text-green-600 hover:text-green-700 transition-colors font-medium text-sm sm:text-base">
                                        {{ $themeVars['contact_email'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Phone -->
                        @if(isset($themeVars['contact_phone']) && $themeVars['contact_phone'])
                            <div class="flex items-start group">
                                <div class="flex-shrink-0">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 bg-orange-50 text-orange-600 rounded-material-lg flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                                        <span class="material-icons-round text-lg sm:text-xl">phone</span>
                                    </div>
                                </div>
                                <div class="ml-4 sm:ml-6">
                                    <h3 class="text-base sm:text-lg font-semibold text-on-surface mb-1 sm:mb-2">Call Us</h3>
                                    <a href="tel:{{ $themeVars['contact_phone'] }}" 
                                       class="text-orange-600 hover:text-orange-700 transition-colors font-medium text-sm sm:text-base">
                                        {{ $themeVars['contact_phone'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Office Hours -->
                        <div class="flex items-start group">
                            <div class="flex-shrink-0">
                                <div class="w-12 sm:w-14 h-12 sm:h-14 bg-blue-50 text-blue-600 rounded-material-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                    <span class="material-icons-round text-lg sm:text-xl">schedule</span>
                                </div>
                            </div>
                            <div class="ml-4 sm:ml-6">
                                <h3 class="text-base sm:text-lg font-semibold text-on-surface mb-1 sm:mb-2">Office Hours</h3>
                                <div class="text-sm sm:text-base text-surface-600 space-y-1">
                                    <p class="flex justify-between">
                                        <span>Monday - Friday</span>
                                        <span class="font-medium">8:00 AM - 4:00 PM</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Saturday</span>
                                        <span class="font-medium">9:00 AM - 1:00 PM</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Sunday</span>
                                        <span class="font-medium text-surface-500">Closed</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="material-card rounded-material-xl p-8 bg-gradient-to-br from-primary-600 to-primary-700 text-white">
                    <div class="flex items-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-material bg-white/20 text-white mr-4">
                            <span class="material-icons-round">help</span>
                        </div>
                        <h3 class="text-xl font-bold">Need Help?</h3>
                    </div>
                    <p class="text-primary-100 mb-6 leading-relaxed">
                        Our friendly staff is here to help answer any questions you may have about our school, 
                        admissions process, or academic programs.
                    </p>
                    <ul class="space-y-3 text-primary-100">
                        <li class="flex items-center">
                            <span class="material-icons-round text-white/80 mr-3">check</span>
                            Admissions Information
                        </li>
                        <li class="flex items-center">
                            <span class="material-icons-round text-white/80 mr-3">check</span>
                            Academic Programs
                        </li>
                        <li class="flex items-center">
                            <span class="material-icons-round text-white/80 mr-3">check</span>
                            Student Support Services
                        </li>
                        <li class="flex items-center">
                            <span class="material-icons-round text-white/80 mr-3">check</span>
                            Extracurricular Activities
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <div class="material-card rounded-material-xl p-8 bg-gradient-to-br from-white to-surface-50 border border-surface-200/50">
                    <div class="flex items-center mb-8">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-material bg-green-600 text-white mr-4">
                            <span class="material-icons-round">send</span>
                        </div>
                        <h2 class="text-2xl font-bold text-on-surface">Send us a Message</h2>
                    </div>
                    <p class="text-surface-600 mb-8 leading-relaxed">
                        Fill out the form below and we'll get back to you as soon as possible. We're here to help!
                    </p>
                    
                    <!-- Livewire Contact Form Component -->
                    @livewire('contact-form')
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-20">
            <div class="material-card rounded-material-xl p-8 bg-gradient-to-br from-white to-surface-50 border border-surface-200/50">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-200 text-primary-700 text-sm font-medium mb-4">
                        <span class="material-icons-round text-sm mr-2">map</span>
                        Location
                    </div>
                    <h2 class="text-3xl font-bold text-on-surface mb-4">Find Us</h2>
                    <p class="text-surface-600">Visit our campus and discover our facilities</p>
                </div>
                <div class="bg-gradient-to-br from-surface-100 to-surface-200 h-80 rounded-material-lg flex items-center justify-center border border-surface-300/50">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-100 text-primary-600 mb-6">
                            <span class="material-icons-round text-3xl">location_on</span>
                        </div>
                        <p class="text-surface-700 text-xl font-semibold mb-2">Interactive Map</p>
                        <p class="text-surface-500">Map integration coming soon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
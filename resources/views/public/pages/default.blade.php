@extends('public.layouts.app')

@section('title', $page->title . ' - ' . ($themeVars['site_name'] ?? 'School'))
@section('description', $page->getSetting('meta_description', 'Learn more about ' . $page->title))

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
            <div class="w-24 h-1 bg-primary mx-auto"></div>
        </div>

        <!-- Page Content -->
        <div class="prose prose-lg max-w-none">
            {!! $page->getContent() !!}
        </div>

        <!-- Back to Home -->
        <div class="mt-12 text-center">
            <a href="{{ route('homepage') }}" 
               class="inline-flex items-center text-primary hover:text-secondary font-medium transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Back to Homepage
            </a>
        </div>
    </div>
</div>
@endsection
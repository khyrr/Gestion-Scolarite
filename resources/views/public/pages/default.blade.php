@extends('public.layouts.app')

@section('title', $page->title . ' - ' . ($themeVars['site_name'] ?? 'School'))
@section('description', $page->getSetting('meta_description', 'Learn more about ' . $page->title))

@section('content')
<!-- Preview Banner -->
@if($isPreview ?? false)
<div class="bg-yellow-50 border-b-4 border-yellow-400 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-yellow-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-yellow-800">
                        {{ __('app.preview') }} - <span class="font-bold">{{ __('app.' . $page->status) }}</span>
                        @if($page->published_at)
                            <span class="text-xs">({{ __('app.publish_date') }}: {{ $page->published_at->format('d/m/Y H:i') }})</span>
                        @endif
                    </p>
                    <p class="text-xs text-yellow-700">{{ __('This is a preview. Only admins can see this page in its current state.') }}</p>
                </div>
            </div>
            <a href="{{ route('filament.admin.resources.pages.edit', $page->slug) }}" 
               class="px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded hover:bg-yellow-700 transition-colors">
                {{ __('Edit Page') }}
            </a>
        </div>
    </div>
</div>
@endif

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
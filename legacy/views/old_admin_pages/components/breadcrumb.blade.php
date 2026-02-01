@props(['class' => ''])

<nav class="flex {{ $class }}" aria-label="Breadcrumb">
    <ol class="inline-flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-1 md:space-x-3">
        {{ $slot }}
    </ol>
</nav>

@props(['href' => null, 'active' => false])

<li class="inline-flex items-center">
    @if($active)
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
            {{ $slot }}
        </span>
    @elseif($href)
        <a href="{{ $href }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            @if($loop->first ?? false)
                <span class="{{ app()->getLocale() === 'ar' ? 'ml-2.5' : 'mr-2.5' }}">
                    <x-icon name="ui/home" :size="12" variant="solid" :decorative="true" />
                </span>
            @else
                <span class="{{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }} mx-1">
                    <x-icon name="ui/chevron-right" :size="12" :decorative="true" />
                </span>
            @endif
            {{ $slot }}
        </a>
    @endif
</li>

@props(['tabs' => []])

<div class="mb-6">
    <div class="inline-flex items-center justify-center p-1 bg-gray-100 rounded-lg border border-gray-200">
        @foreach($tabs as $tab)
            <a href="{{ $tab['url'] }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ $tab['active'] 
                   ? 'bg-white text-primary-600 shadow-sm border border-gray-200' 
                   : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50' }}">
                <x-filament::icon 
                    icon="{{ $tab['icon'] }}" 
                    class="w-4 h-4 mr-2 {{ $tab['active'] ? 'text-primary-600' : 'text-gray-500' }}" />
                {{ $tab['name'] }}
            </a>
        @endforeach
    </div>
</div>
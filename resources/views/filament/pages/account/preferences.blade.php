<x-filament-panels::page>
    <div class="space-y-6">
        <div class="border-b border-gray-200 pb-4">
            <p class="mt-1 text-sm text-gray-600">Customize your language, display, and interface preferences.</p>
        </div>
        
        @include('filament.components.account-navigation')
        
        {{ $this->form }}
        
        <div class="flex justify-end">
            <x-filament-actions::group :actions="$this->getFormActions()" />
        </div>
    </div>
</x-filament-panels::page>
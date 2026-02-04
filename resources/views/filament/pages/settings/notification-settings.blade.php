<x-filament-panels::page>
    <div class="space-y-6">
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">System-Wide Notification Control</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Control which notification types are enabled system-wide. Disabled notifications will not be sent to any users.
            </p>
        </div>
        
        @include('filament.components.settings-navigation')
        
        @if (method_exists($this, 'form'))
            <x-filament-panels::form wire:submit="save">
                {{ $this->form }}
            </x-filament-panels::form>
        @endif
    </div>
</x-filament-panels::page>

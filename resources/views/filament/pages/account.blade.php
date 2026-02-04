<x-filament-panels::page>
    @if (method_exists($this, 'form'))
        <x-filament-panels::form wire:submit="save">
            {{ $this->form }}
            
            <x-filament-panels::form.actions 
                :actions="$this->getFormActions()" 
                :full-width="false"
            />
        </x-filament-panels::form>
    @endif
</x-filament-panels::page>
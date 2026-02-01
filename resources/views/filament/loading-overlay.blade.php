<div
    x-data="{ loading: false }"
    x-init="
        Livewire.hook('message.sent', () => loading = true)
        Livewire.hook('message.processed', () => loading = false)
    "
    x-show="loading"
    x-cloak
    class="fixed inset-0 z-[9999] flex items-start justify-center pointer-events-none"
>
    <div class="mt-6 rounded-xl bg-white/80 dark:bg-gray-900/80 p-3 shadow pointer-events-auto">
        <x-filament::loading-indicator class="h-6 w-6" />
    </div>
</div>

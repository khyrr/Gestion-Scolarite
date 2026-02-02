<x-filament-panels::page>
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-section-content p-6">
            @include('filament.pages.timetable-preview', [
                'classe' => $classe,
                'courses' => $courses
            ])
        </div>
    </div>
</x-filament-panels::page>
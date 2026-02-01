<x-filament-widgets::widget>
    <div class="fi-section-activity-timeline space-y-6">
        {{-- Section Heading --}}
        <h2 class="text-[20px] font-normal text-gray-950 dark:text-white px-2">
            {{ __('app.fil_activite') }}
        </h2>

        {{-- Container with actual Border-Left for the stem chain --}}
        <div class="relative ml-6 md:ml-8 mt-8 border-l-[1.5px] border-gray-200 dark:border-white/10 pb-6">
            <div class="space-y-8">
                @foreach($this->getActivities() as $activity)
                    @php
                        $colorClass = match($activity->action) {
                            'create' => 'text-success-600 dark:text-success-400',
                            'delete' => 'text-danger-600 dark:text-danger-400',
                            'update' => 'text-warning-600 dark:text-warning-400',
                            default => 'text-gray-600',
                        };
                        
                        $symbol = match($activity->action) {
                            'create' => '+',
                            'delete' => '-',
                            default => '•',
                        };
                    @endphp
                    <div class="relative pl-10 group">
                        {{-- Timeline Icon (Circle) - Centered precisely on the border line --}}
                        <div class="absolute -left-[11px] top-5 z-10 w-[20px] h-[20px] rounded-full bg-white dark:bg-gray-900 border-[1.5px] border-gray-950 dark:border-white shadow-sm group-hover:scale-110 transition-transform"></div>

                        {{-- Card-style Item --}}
                        <div class="flex-1 rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-4 shadow-sm transition-all duration-200 hover:shadow-md hover:ring-1 hover:ring-primary-500/20">
                            <div class="flex items-start justify-between gap-x-4">
                                <div class="flex flex-col gap-y-1">
                                    {{-- Title: Action + Identifier --}}
                                    <div class="flex items-center gap-x-2 text-[15px] font-medium leading-tight">
                                        <span class="text-gray-950 dark:text-white">
                                            {{ __("app.{$activity->action}") }}
                                        </span>
                                        <span @class(['font-bold', $colorClass])>
                                            {{ $symbol }} {{ $activity->resource }}
                                        </span>
                                    </div>

                                    {{-- Metadata --}}
                                    <div class="text-[13px] text-gray-500 dark:text-gray-400 flex items-center flex-wrap gap-x-1.5 mt-0.5">
                                        <x-filament::link
                                            :href="App\Filament\Resources\ActivityLogResource::getUrl('view', ['record' => $activity])"
                                            class="text-primary-600 dark:text-primary-400 hover:underline font-bold"
                                        >
                                            #{{ $activity->id }}
                                        </x-filament::link>
                                        
                                        <span class="opacity-50">•</span>
                                        
                                        <span>
                                            {{ __('app.par') }} {{ $activity->user_type }}
                                        </span>

                                        @if($activity->description)
                                            <span class="opacity-50">•</span>
                                            <span class="italic text-gray-400 dark:text-gray-500 truncate max-w-[200px]">
                                                {{ $activity->description }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Timestamp --}}
                                <div class="text-[12px] font-medium text-gray-400 dark:text-gray-500 tabular-nums shrink-0 pt-0.5">
                                    {{ $activity->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(count($this->getActivities()) === 0)
            <div class="flex flex-col items-center justify-center p-12 text-center text-gray-400">
                <p class="text-sm font-medium">
                    {{ __('app.no_logs') }}
                </p>
            </div>
        @endif
        
        <div class="flex justify-center pt-2">
            <x-filament::link
                :href="App\Filament\Resources\ActivityLogResource::getUrl()"
                size="sm"
                icon="heroicon-m-chevron-right"
                icon-position="after"
                class="text-gray-400 hover:text-primary-600 transition-colors font-semibold"
            >
                {{ __('app.voir_tout_historique') }}
            </x-filament::link>
        </div>
    </div>
</x-filament-widgets::widget>

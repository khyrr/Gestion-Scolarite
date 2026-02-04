<x-filament-panels::page>
    {{-- Evaluation Information Panel --}}
    <div class="mb-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.evaluation') }}</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $this->getEvaluationData()['titre'] }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ $this->getEvaluationData()['type'] }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.matiere') }}</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $this->getEvaluationData()['matiere'] }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ __('app.classe') }}: {{ $this->getEvaluationData()['classe'] }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.bareme') }}</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                    / {{ $this->getEvaluationData()['note_max'] }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ __('app.coefficient') }}: {{ $this->getEvaluationData()['coefficient'] }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.progression') }}</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $this->getEvaluationData()['graded_count'] }} / {{ $this->getEvaluationData()['total_students'] }}
                </p>
                <div class="mt-2">
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                        @php
                            $total = $this->getEvaluationData()['total_students'];
                            $percentage = $total > 0 ? ($this->getEvaluationData()['graded_count'] / $total) * 100 : 0;
                        @endphp
                        <div class="h-full bg-primary-600" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Instructions --}}
    <div class="mb-4 rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
        <div class="flex items-start">
            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            <div class="ml-3">
                <p class="text-sm text-blue-800 dark:text-blue-300">
                    <strong>{{ __('app.instructions') }}:</strong>
                    {{ __('app.cliquer_cellule_modifier') }}
                    {{ __('app.notes_sauvegardees_automatiquement') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Grade Entry Table --}}
    <div class="filament-tables-container">
        {{ $this->table }}
    </div>
</x-filament-panels::page>

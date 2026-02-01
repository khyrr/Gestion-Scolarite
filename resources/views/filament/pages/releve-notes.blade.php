<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
    </form>

    @if($this->id_classe && !$this->id_etudiant)
        @php
            $ranking = $this->classRanking;
            $isRtl = app()->getLocale() == 'ar';
        @endphp

        <div class="mt-8 space-y-4" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <x-heroicon-o-trophy class="w-6 h-6 text-yellow-500" />
                    {{ __('app.classement_classe') }}
                </h3>
            </div>

            <div class="overflow-hidden rounded-xl  dark:border-gray-800 shadow-sm bg-white dark:bg-gray-900">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 w-16">{{ __('app.rang') }}</th>
                            <th class="p-4 text-{{ $isRtl ? 'right' : 'left' }} text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.etudiant') }}</th>
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.moyenne') }}</th>
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.mention') }}</th>
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200 w-24"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($ranking as $index => $rank)
                            <tr class="hover:bg-gray-100 dark:hover:bg-white/5 transition-colors duration-200 {{ $rank->id_etudiant == $this->id_etudiant ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}">
                                <td class="p-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold 
                                        {{ $index == 0 ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : '' }}
                                        {{ $index == 1 ? 'bg-gray-100 text-gray-700 border border-gray-200' : '' }}
                                        {{ $index == 2 ? 'bg-orange-100 text-orange-700 border border-orange-200' : '' }}
                                        {{ $index > 2 ? 'text-gray-500' : '' }}">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $rank->nom_complet }}</span>
                                        <span class="text-xs text-gray-500 font-mono">{{ $rank->matricule }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="text-sm font-bold {{ $rank->moyenne >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($rank->moyenne, 2) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="text-xs px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                        {{ $rank->mention }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <x-filament::button 
                                        wire:click="selectStudent({{ $rank->id_etudiant }})"
                                        size="xs"
                                        color="gray"
                                        icon="heroicon-o-eye"
                                    >
                                        {{ __('app.voir') }}
                                    </x-filament::button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($this->id_etudiant)
        @php
            $etudiant = $this->etudiant;
            $notes = $this->notes;
            $moyenne = $this->moyenne;
            $isRtl = app()->getLocale() == 'ar';
        @endphp

        <div class="mt-6 space-y-6" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
            <!-- Header & Action -->
            <div class="p-6 bg-white dark:bg-gray-900 rounded-xl  dark:border-gray-800 shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center text-primary-600 dark:text-primary-400 text-2xl font-bold">
                            {{ (substr($etudiant->nom ?? '', 0, 1) . substr($etudiant->prenom ?? '', 0, 1)) ?: 'N/A' }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $etudiant->nom }} {{ $etudiant->prenom }}
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ __('app.matricule') }}: <span class="font-mono font-bold text-primary-600">{{ $etudiant->matricule }}</span> | 
                                {{ __('app.classe') }}: <span class="font-bold">{{ $etudiant->classe->nom_classe ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <x-filament::button 
                        wire:click="printReleve" 
                        icon="heroicon-o-printer"
                        color="success"
                        size="lg"
                    >
                        {{ __('app.imprimer_releve') }}
                    </x-filament::button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl  dark:border-gray-800 shadow-sm">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.moyenne_generale') }}</p>
                    <p class="text-3xl font-bold mt-1 {{ $moyenne >= 10 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($moyenne, 2) }} <span class="text-lg text-gray-400">/ 20</span>
                    </p>
                </div>
                
                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl  dark:border-gray-800 shadow-sm">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.mention') }}</p>
                    <p class="text-3xl font-bold mt-1 text-primary-600">
                        {{ $this->getMention($moyenne) }}
                    </p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl  dark:border-gray-800 shadow-sm">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.nombre_evaluations') }}</p>
                    <p class="text-3xl font-bold mt-1 text-gray-900 dark:text-white">
                        {{ $notes->count() }}
                    </p>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden rounded-xl  dark:border-gray-800 shadow-sm bg-white dark:bg-gray-900">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                            <th class="p-4 text-{{ $isRtl ? 'right' : 'left' }} text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.matiere') }}</th>
                            <th class="p-4 text-{{ $isRtl ? 'right' : 'left' }} text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.evaluation') }}</th>
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.note') }}</th>
                            <th class="p-4 text-center text-sm font-bold text-gray-700 dark:text-gray-200">{{ __('app.remarques') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($notes as $note)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="p-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $note->evaluation->matiere->nom_matiere ?? 'N/A' }}
                                </td>
                                <td class="p-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $note->evaluation->titre ?? __('app.evaluation') }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-bold {{ $note->note >= 10 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                            {{ number_format($note->note, 2) }} / 20
                                        </span>
                                        @if(isset($note->is_absence) && $note->is_absence)
                                            <span class="text-[10px] uppercase font-bold text-red-500 dark:text-red-400">
                                                {{ __('app.absent_ou_non_note') }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-center text-sm italic text-gray-500 dark:text-gray-500">
                                    {{ $note->commentaire ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 italic">
                                    {{ __('app.no_notes_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-filament-panels::page>

@extends('admin.layouts.dashboard')

@section('title', __('app.cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.cours') }}</li>
@endsection

@section('header-actions')
@admin
<a href="{{ route('admin.cours.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i>
    <span class="d-none d-lg-inline ms-2">{{ __('app.ajouter_cours') }}</span>
</a>
@endadmin
@endsection

@section('content')
<div class="google-container">
    <!-- Page Header -->
    <!-- <div class="google-page-header">
        
    </div> -->

    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $cours->total() }}</div>
            <div class="google-stat-label">{{ __('app.total_cours') }}</div>
        </div>

        <div class="google-stat-item">
            <div class="google-stat-value">{{ $cours->pluck('matiere')->unique()->count() }}</div>
            <div class="google-stat-label">{{ __('app.matieres') }}</div>
        </div>

        <div class="google-stat-item">
            <div class="google-stat-value">
                {{ $cours->where('jour', strtolower(now()->locale('fr_FR')->dayName))->count() }}</div>
            <div class="google-stat-label">{{ __('app.aujourdhui') }}</div>
        </div>

        <a href="{{ route('admin.cours.spectacle') }}" class="google-stat-item google-stat-link">
            <div class="google-stat-value" style="font-size: 0.875rem; font-weight: 500;">
                {{ __('app.voir_emploi_temps') }}</div>
            <div class="google-stat-label">{{ __('app.emploi_du_temps') }}</div>
        </a>
    </div>

    <!-- Filters -->
    @if($cours->count() > 0)
        <x-filters.layout>
            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.jour') }}</label>
                <x-custom-datalist name="day_filter" :options="[
        ['id' => 'lundi', 'name' => __('app.lundi')],
        ['id' => 'mardi', 'name' => __('app.mardi')],
        ['id' => 'mercredi', 'name' => __('app.mercredi')],
        ['id' => 'jeudi', 'name' => __('app.jeudi')],
        ['id' => 'vendredi', 'name' => __('app.vendredi')],
    ]"
                    option-value="id" option-label="name" placeholder="{{ __('app.tous_les_jours') }}"
                    id="dayFilter" />
            </div>

            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.classe') }}</label>
                <x-custom-datalist name="classe_filter"
                    :options="$cours->pluck('classe')->unique()->filter()->map(fn($c) => ['id' => $c->nom_classe, 'name' => $c->nom_classe])->values()->toArray()" option-value="id" option-label="name"
                    placeholder="{{ __('app.toutes_les_classes') }}" id="classeFilter" />
            </div>

            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.matiere') }}</label>
                <x-custom-datalist name="matiere_filter" :options="$cours->pluck('matiere')->unique()->map(fn($m) => ['id' => $m->code_matiere, 'name' => $m->nom_matiere ?? $m->code_matiere])->values()->toArray()"
                    option-value="id" option-label="name" placeholder="{{ __('app.toutes_les_matieres') }}"
                    id="matiereFilter" />
            </div>

            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.enseignant') }}</label>
                <x-custom-datalist name="enseignant_filter"
                    :options="$cours->pluck('enseignant')->unique()->filter()->map(fn($e) => ['id' => $e->prenom . ' ' . $e->nom, 'name' => $e->prenom . ' ' . $e->nom])->values()->toArray()" option-value="id"
                    option-label="name" placeholder="{{ __('app.tous_les_enseignants') }}" id="enseignantFilter" />
            </div>

            <x-slot name="actions">
                <button class="google-btn google-btn-text"
                    onclick="resetFilters()">{{ __('app.reinitialiser') }}</button>
                <button class="google-btn google-btn-primary"
                    id="applyFiltersBtn">{{ __('app.appliquer_filtres') }}</button>
            </x-slot>
        </x-filters.layout>

        <!-- Courses List -->
        <div class="google-list-container" id="coursListContainer">
            <div class="google-header-actions">
            @if($cours->count() > 0)
                <input type="text" class="google-search-input" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
            @endif

        </div>
            @foreach($cours as $course)
                <div class="google-list-item" data-matiere="{{ $course->matiere->code_matiere }}"
                    data-classe="{{ $course->classe->nom_classe ?? '' }}"
                    data-enseignant="{{ $course->enseignant ? $course->enseignant->prenom . ' ' . $course->enseignant->nom : '' }}"
                    data-jour="{{ $course->jour }}">
                    <div class="google-list-main">
                        <div class="google-list-title">
                            <span class="google-matiere-code">{{ $course->matiere->code_matiere }}</span>
                            <span
                                class="google-matiere-name">{{ $course->matiere->nom_matiere ?? $course->matiere->code_matiere }}</span>
                        </div>
                        <div class="google-list-meta">
                            @if($course->classe)
                                <span class="google-meta-item">{{ $course->classe->nom_classe }}</span>
                            @endif
                            @if($course->enseignant)
                                <span class="google-meta-item">{{ $course->enseignant->prenom }}
                                    {{ $course->enseignant->nom }}</span>
                            @else
                                <span class="google-meta-item google-text-muted">{{ __('app.non_assigne') }}</span>
                            @endif
                            <span class="google-meta-item">{{ ucfirst($course->jour) }}</span>
                            <span class="google-meta-item">
                                {{ \Carbon\Carbon::parse($course->date_debut)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($course->date_fin)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                    <div class="google-list-actions">
                        @include('admin.academic.cours.partials.actions', ['course' => $course])
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($cours->hasPages())
            <div class="google-pagination-wrapper">
                {{ $cours->links('pagination::bootstrap-5') }}
            </div>
        @endif

        <!-- No Results Message -->
        <div id="noResultsMessage" class="google-empty-state" style="display: none;">
            <i class="fas fa-search google-empty-icon" aria-hidden="true"></i>
            <h3 class="google-empty-title">{{ __('app.aucun_resultat') }}</h3>
            <p class="google-empty-text">{{ __('app.essayez_autres_filtres') }}</p>
            <button class="google-btn google-btn-text" onclick="resetFilters()">
                {{ __('app.reinitialiser_filtres') }}
            </button>
        </div>
    @else
    <div class="google-empty-state">
        <i class="fas fa-clipboard-list google-empty-icon" aria-hidden="true"></i>
        <h3 class="google-empty-title">{{ __('app.aucun_cours_trouve') }}</h3>
        <p class="google-empty-text">{{ __('app.no_data') }}</p>
        @admin
        <a href="{{ route('admin.cours.create') }}" class="google-btn google-btn-primary">
            {{ __('app.ajouter_cours') }}
        </a>
        @endadmin
    </div>
    @endif
</div>

@push('scripts')
    <script>
        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const dayFilter = document.getElementById('dayFilter');
        const classeFilter = document.getElementById('classeFilter');
        const matiereFilter = document.getElementById('matiereFilter');
        const enseignantFilter = document.getElementById('enseignantFilter');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const listContainer = document.getElementById('coursListContainer');
        const filterBadge = document.getElementById('filterBadge');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');

        // Helper to get value from custom datalist or regular input
        function getFilterValue(element, inputName) {
            if (!element) return '';
            // If it's the custom datalist wrapper (div)
            if (element.tagName === 'DIV' && element.classList.contains('custom-datalist')) {
                const input = element.querySelector(`input[name="${inputName}"]`);
                return input ? input.value.toLowerCase().trim() : '';
            }
            // If it's a regular input/select
            return element.value ? element.value.toLowerCase().trim() : '';
        }

        function filterList() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const selectedDay = getFilterValue(dayFilter, 'day_filter');
            const selectedClasse = getFilterValue(classeFilter, 'classe_filter');
            const selectedMatiere = getFilterValue(matiereFilter, 'matiere_filter');
            const selectedEnseignant = getFilterValue(enseignantFilter, 'enseignant_filter');

            const items = document.querySelectorAll('.google-list-item');
            let visibleCount = 0;

            items.forEach(item => {
                const matiere = (item.getAttribute('data-matiere') || '').toLowerCase();
                const classe = (item.getAttribute('data-classe') || '').toLowerCase();
                const enseignant = (item.getAttribute('data-enseignant') || '').toLowerCase();
                const jour = (item.getAttribute('data-jour') || '').toLowerCase();
                const itemText = (item.textContent || '').toLowerCase();

                const matchesSearch = searchTerm === '' || itemText.includes(searchTerm);
                const matchesDay = selectedDay === '' || jour.includes(selectedDay);
                const matchesClasse = selectedClasse === '' || classe.includes(selectedClasse);
                const matchesMatiere = selectedMatiere === '' || matiere.includes(selectedMatiere);
                const matchesEnseignant = selectedEnseignant === '' || enseignant.includes(selectedEnseignant);

                if (matchesSearch && matchesDay && matchesClasse && matchesMatiere && matchesEnseignant) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (listContainer && noResultsMessage) {
                if (visibleCount === 0) {
                    listContainer.style.display = 'none';
                    noResultsMessage.style.display = 'block';
                } else {
                    listContainer.style.display = 'block';
                    noResultsMessage.style.display = 'none';
                }
            }

            // Update filter badge
            updateFilterBadge();
        }

        // Update filter badge count
        function updateFilterBadge() {
            let activeFilters = 0;
            if (getFilterValue(dayFilter, 'day_filter')) activeFilters++;
            if (getFilterValue(classeFilter, 'classe_filter')) activeFilters++;
            if (getFilterValue(matiereFilter, 'matiere_filter')) activeFilters++;
            if (getFilterValue(enseignantFilter, 'enseignant_filter')) activeFilters++;

            if (filterBadge) {
                if (activeFilters > 0) {
                    filterBadge.textContent = activeFilters;
                    filterBadge.style.display = 'inline-flex';
                } else {
                    filterBadge.style.display = 'none';
                }
            }
        }

        // Apply filters and close panel (mobile)
        function applyFilters() {
            filterList();
            // Close panel by triggering click on close button
            const closeBtn = document.getElementById('filterCloseBtn');
            if (closeBtn) closeBtn.click();
        }

        // Reset all filters
        function resetFilters() {
            if (searchInput) searchInput.value = '';
            
            // Helper to clear custom datalist
            const clearDatalist = (element) => {
                if (element && element.tagName === 'DIV' && element.classList.contains('custom-datalist')) {
                    const clearBtn = element.querySelector('.datalist-clear');
                    if (clearBtn) {
                        clearBtn.click();
                    } else {
                        // Fallback if no clear button (e.g. empty)
                        const input = element.querySelector('input[type="hidden"]');
                        if (input) input.value = '';
                        const visibleInput = element.querySelector('.datalist-input');
                        if (visibleInput) visibleInput.value = '';
                    }
                } else if (element) {
                    element.value = '';
                }
            };

            clearDatalist(dayFilter);
            clearDatalist(classeFilter);
            clearDatalist(matiereFilter);
            clearDatalist(enseignantFilter);
            
            // Small delay to allow Alpine to update
            setTimeout(filterList, 50);
        }

        // Event listeners for desktop (real-time filtering)
        if (searchInput) searchInput.addEventListener('keyup', filterList);
        
        // Add listeners to the wrapper divs to catch bubbling events
        if (window.innerWidth > 768) {
            [dayFilter, classeFilter, matiereFilter, enseignantFilter].forEach(el => {
                if (el) {
                    el.addEventListener('input', filterList);
                    el.addEventListener('change', filterList);
                    // Also listen for clicks on options which might not trigger change immediately
                    el.addEventListener('click', function(e) {
                        if (e.target.closest('.datalist-option') || e.target.closest('.datalist-clear')) {
                            setTimeout(filterList, 50);
                        }
                    });
                }
            });
        }

        if (applyFiltersBtn) applyFiltersBtn.addEventListener('click', applyFilters);

        // Update badge on load
        updateFilterBadge();
    </script>
@endpush
@endsection
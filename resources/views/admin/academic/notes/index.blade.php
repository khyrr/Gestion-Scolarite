@extends('admin.layouts.dashboard')

@section('title', __('app.notes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.notes') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.rapports.notes.transcript-index') }}" class="btn btn-primary">
            <i class="fas fa-file-alt"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.releve_de_notes') }}</span>
        </a>
        <a href="{{ route('admin.evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-clipboard-list"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.voir_evaluations') }}</span>
        </a>
    </div>
@endsection

@section('content')
<div class="google-container">
    <!-- Page Header -->
    <div class="google-page-header">
        <h1 class="google-page-title">{{ __('app.notes') }}</h1>
        <div class="google-header-actions">
            @if($notes->total() > 0 || request('search'))
                <form method="GET" action="{{ route('admin.notes.index') }}" class="search-form" id="searchForm">
                    <!-- Preserve existing filters -->
                    @if(request('classe_filter'))
                        <input type="hidden" name="classe_filter" value="{{ request('classe_filter') }}">
                    @endif
                    @if(request('evaluation_filter'))
                        <input type="hidden" name="evaluation_filter" value="{{ request('evaluation_filter') }}">
                    @endif
                    @if(request('matiere_filter'))
                        <input type="hidden" name="matiere_filter" value="{{ request('matiere_filter') }}">
                    @endif
                    <input type="search" name="search" class="google-search-input" id="searchInput" 
                           value="{{ request('search') }}" 
                           placeholder="{{ __('app.rechercher') }}...">
                </form>
            @endif
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="google-stats-grid">
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $statistics['total'] }}</div>
            <div class="google-stat-label">{{ __('app.total_notes') }}</div>
        </div>
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $statistics['average'] }}%</div>
            <div class="google-stat-label">{{ __('app.moyenne_generale') }}</div>
        </div>
        <div class="google-stat-item">
            <div class="google-stat-value google-stat-success">{{ $statistics['excellent'] }}</div>
            <div class="google-stat-label">{{ __('app.excellent') }} (≥80%)</div>
        </div>
        <div class="google-stat-item">
            <div class="google-stat-value google-stat-danger">{{ $statistics['poor'] }}</div>
            <div class="google-stat-label">{{ __('app.a_ameliorer') }} (<50%)</div>
        </div>
    </div>

    <!-- Filters -->
    @if($notes->total() > 0 || request()->hasAny(['classe_filter', 'evaluation_filter', 'matiere_filter', 'search']))
        @php
            $activeFilters = collect([
                request('classe_filter'),
                request('evaluation_filter'),
                request('matiere_filter')
            ])->filter()->count();
        @endphp

        
            <form method="GET" action="{{ route('admin.notes.index') }}" id="filterForm" class="contents">
                <x-filters.layout :active-filters="$activeFilters">
                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.classe') }}</label>
                    <x-custom-datalist
                        name="classe_filter"
                        :options="$classes->map(fn($c) => ['id' => $c->nom_classe, 'name' => $c->nom_classe])->toArray()"
                        option-value="id"
                        option-label="name"
                        :selected="request('classe_filter')"
                        placeholder="{{ __('app.toutes_classes') }}"
                        id="classeFilter"
                    />
                </div>

                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.evaluation') }}</label>
                    @php
                        $evaluationOptions = $evaluations->map(function($e) {
                            $label = ($e->matiere->nom_matiere ?? 'N/A') . ' - ' . ($e->titre ?? ucfirst($e->type));
                            return [
                                'id' => $e->id_evaluation,
                                'name' => $label,
                                'search_text' => $label
                            ];
                        })->toArray();
                    @endphp
                    <x-custom-datalist
                        name="evaluation_filter"
                        :options="$evaluationOptions"
                        option-value="id"
                        option-label="name"
                        :selected="request('evaluation_filter')"
                        placeholder="{{ __('app.toutes_evaluations') }}"
                        id="evaluationFilter"
                    />
                </div>

                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.matiere') }}</label>
                    <x-custom-datalist
                        name="matiere_filter"
                        :options="$matieres->map(fn($m) => ['id' => $m->nom_matiere, 'name' => $m->nom_matiere])->toArray()"
                        option-value="id"
                        option-label="name"
                        :selected="request('matiere_filter')"
                        placeholder="{{ __('app.toutes_les_matieres') }}"
                        id="matiereFilter"
                    />
                </div>

                <x-slot:actions>
                    <a href="{{ route('admin.notes.index') }}" class="google-btn google-btn-text">{{ __('app.reinitialiser') }}</a>
                    <button type="submit" class="google-btn google-btn-primary" id="applyFiltersBtn">{{ __('app.appliquer_filtres') }}</button>
                </x-slot:actions>
                        </x-filters.layout>
            </form>

    @endif

    <!-- Notes Table -->
    <div class="google-table-wrapper" id="notesTableContainer">
        @if($notes->count() > 0)
            <x-table.data-table title="{{ __('app.liste_notes') }}" :showSearch="false" :showSort="true"
                :sortOptions="[
                    'etudiant:asc' => __('app.etudiant') . ' A→Z',
                    'etudiant:desc' => __('app.etudiant') . ' Z→A',
                    'classe:asc' => __('app.classe') . ' A→Z',
                    'classe:desc' => __('app.classe') . ' Z→A',
                    'note:asc' => __('app.note') . ' ↑',
                    'note:desc' => __('app.note') . ' ↓',
                ]"
                serverFormId="searchForm">
                <table class="google-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.etudiant') }}</th>
                            <th>{{ __('app.classe') }}</th>
                            <th>{{ __('app.evaluation') }}</th>
                            <th>{{ __('app.matiere') }}</th>
                            <th>{{ __('app.note') }}</th>
                            <th>{{ __('app.appreciation') }}</th>
                            <th class="text-center">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                            @php
                                $noteMax = $note->evaluation->note_max ?? 20;
                                $percentage = ($note->note / $noteMax) * 100;
                                $badgeClass = $percentage >= 80 ? 'success' :
                                    ($percentage >= 60 ? 'primary' :
                                        ($percentage >= 50 ? 'warning' : 'danger'));
                            @endphp
                            <tr data-etudiant="{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}" 
                                data-classe="{{ $note->classe->nom_classe ?? '' }}" 
                                data-evaluation="{{ $note->evaluation->matiere->nom_matiere ?? '' }} - {{ $note->evaluation->titre ?? ucfirst($note->evaluation->type) }}" 
                                data-evaluation-id="{{ $note->evaluation->id_evaluation }}" 
                                data-matiere="{{ $note->matiere->nom_matiere ?? '' }}">
                                <td>
                                    <a href="{{ route('admin.etudiants.show', $note->etudiant) }}" class="google-link">
                                        {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                    </a>
                                </td>
                                <td>
                                    <span class="google-badge">{{ $note->classe->nom_classe ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.evaluations.show', $note->evaluation) }}" class="google-link">
                                        {{ $note->evaluation->titre ?? ucfirst($note->evaluation->type) }}
                                    </a>
                                    <br>
                                    <span class="google-text-secondary">{{ $note->evaluation->date->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <span class="google-badge">{{ $note->matiere->nom_matiere ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="google-badge google-badge-{{ $badgeClass }}">
                                        {{ number_format($note->note, 2) }} / {{ $noteMax }}
                                    </span>
                                    <span class="google-text-secondary">({{ round($percentage) }}%)</span>
                                </td>
                                <td>
                                    @php
                                        if ($percentage >= 80)
                                            $appreciation = __('app.excellent');
                                        elseif ($percentage >= 60)
                                            $appreciation = __('app.bien');
                                        elseif ($percentage >= 50)
                                            $appreciation = __('app.passable');
                                        else
                                            $appreciation = __('app.insuffisant');
                                    @endphp
                                    <span class="google-text-secondary">{{ $appreciation }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="google-action-buttons">
                                        @admin
                                            <a href="{{ route('admin.notes.edit', $note) }}" 
                                               class="google-action-btn" 
                                               title="{{ __('app.modifier') }}"
                                               aria-label="Modifier la note de {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('admin.notes.destroy', $note) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="google-action-btn google-action-delete delete-note" 
                                                        title="{{ __('app.supprimer') }}"
                                                        aria-label="Supprimer la note de {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}"
                                                        data-student-name="{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endadmin
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
                @slot('footer')
                    @if($notes->hasPages())
                        <div class="google-pagination-wrapper">
                            {{ $notes->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                @endslot
            </x-table.data-table>
        @else
            <!-- Empty State -->
            <div class="google-empty-state">
                @if(request()->hasAny(['classe_filter', 'evaluation_filter', 'matiere_filter', 'search']))
                    <!-- Filtered but no results -->
                    <i class="fas fa-frown empty-icon"></i>
                    <h4 class="google-empty-title">{{ __('app.aucun_resultat_trouve') }}</h4>
                    <p class="google-empty-text">
                        Aucune note ne correspond à vos critères de recherche.
                        @if(request('search'))
                            <br>Recherche : <strong>"{{ request('search') }}"</strong>
                        @endif
                        @if(request('classe_filter'))
                            <br>Classe : <strong>{{ request('classe_filter') }}</strong>
                        @endif
                        @if(request('matiere_filter'))
                            <br>Matière : <strong>{{ request('matiere_filter') }}</strong>
                        @endif
                    </p>
                    <div class="google-empty-actions">
                        <a href="{{ route('admin.notes.index') }}" class="google-btn google-btn-primary" aria-label="Réinitialiser tous les filtres">
                            <i class="fas fa-undo" aria-hidden="true"></i>
                            <span>Réinitialiser les filtres</span>
                        </a>
                    </div>
                @else
                    <!-- No notes at all -->
                    <i class="fas fa-clipboard empty-icon" aria-hidden="true"></i>
                    <h4 class="google-empty-title">{{ __('app.aucune_note') }}</h4>
                    <p class="google-empty-text">Aucune note n'a encore été enregistrée dans le système.</p>
                    @admin
                        <div class="google-empty-actions">
                            <a href="{{ route('admin.notes.create') }}" class="google-btn google-btn-primary" aria-label="Ajouter une nouvelle note">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                <span>Ajouter une note</span>
                            </a>
                        </div>
                    @endadmin
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    <script>
    // Form elements
    const searchForm = document.getElementById('searchForm');
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchInput');
    const classeFilter = document.getElementById('classeFilter');
    const evaluationFilter = document.getElementById('evaluationFilter');
    const matiereFilter = document.getElementById('matiereFilter');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const tableContainer = document.getElementById('notesTableContainer');

    // Mobile filter panel elements
    const filterToggleBtn = document.getElementById('filterToggleBtn');
    const filterCloseBtn = document.getElementById('filterCloseBtn');
    const applyFiltersBtn = document.getElementById('applyFiltersBtn');
    const filtersContainer = document.getElementById('filtersContainer');
    const filterOverlay = document.getElementById('filterOverlay');
    const filterBadge = document.getElementById('filterBadge');

    // Auto-submit filter form when datalist changes
    if (filterForm) {
        const filterElements = [classeFilter, evaluationFilter, matiereFilter];
        filterElements.forEach(element => {
            if (element) {
                element.addEventListener('change', function() {
                    // Small delay to ensure value is set
                    setTimeout(() => {
                        filterForm.submit();
                    }, 100);
                });
            }
        });
    }

    // Auto-submit search form on enter or after delay
    if (searchForm && searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            // Auto-submit after 500ms of no typing
            searchTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });
        
        // Also submit on enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchForm.submit();
            }
        });
        
        // Submit on search clear
        searchInput.addEventListener('search', function() {
            searchForm.submit();
        });
    }



    // Delete confirmation
    document.querySelectorAll('.delete-note').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const studentName = this.dataset.studentName;

            if (confirm(`Êtes-vous sûr de vouloir supprimer cette note pour "${studentName}" ?`)) {
                form.submit();
            }
        });
    });
    </script>
@endpush

@push('styles')
    <style>
        /* Page-Specific Layout Styles */
        .search-form {
            display: flex;
            flex: 1;
            max-width: 400px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .google-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .google-search-input {
                flex: 1;
                min-width: 0;
            }


        }
    </style>
@endpush

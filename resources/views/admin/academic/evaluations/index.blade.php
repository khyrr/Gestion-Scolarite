@extends('admin.layouts.dashboard')

@section('title', __('app.evaluations'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.evaluations') }}</li>
@endsection

@section('header-actions')
@admin
<a href="{{ route('admin.evaluations.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i>
    <span class="d-none d-lg-inline ms-2">{{ __('app.nouvelle_evaluation') }}</span>
</a>
@endadmin
@endsection

@section('content')
<div class="google-container">
    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.total_evaluations') }}</div>
            <div class="google-stat-value">{{ $stats['total'] }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.examens') }}</div>
            <div class="google-stat-value">{{ $stats['examens'] }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.controles') }}</div>
            <div class="google-stat-value">{{ $stats['controles'] }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.devoirs') }}</div>
            <div class="google-stat-value">{{ $stats['devoirs'] }}</div>
        </div>
    </div>

    <!-- Evaluations Table -->
    <div class="google-table-wrapper">
        <!-- Filters Form -->
        <form method="GET" action="{{ route('admin.evaluations.index') }}" id="filtersForm">
            <x-filters.layout :active-filters="collect([request('type_filter'), request('classe_filter'), request('matiere_filter')])->filter()->count()">
                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.type') }}</label>
                    <x-custom-datalist
                        name="type_filter"
                        :options="[
                            ['id' => 'examen', 'name' => __('app.examens')],
                            ['id' => 'controle', 'name' => __('app.controles')],
                            ['id' => 'devoir', 'name' => __('app.devoirs')]
                        ]"
                        option-value="id"
                        option-label="name"
                        :selected="request('type_filter')"
                        placeholder="{{ __('app.tous_les_types') }}"
                        id="typeFilter"
                    />
                </div>
                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.classe') }}</label>
                    <x-custom-datalist
                        name="classe_filter"
                        :options="$allClasses->map(fn($c) => ['id' => $c->nom_classe, 'name' => $c->nom_classe])->toArray()"
                        option-value="id"
                        option-label="name"
                        :selected="request('classe_filter')"
                        placeholder="{{ __('app.toutes_les_classes') }}"
                        id="classeFilter"
                    />
                </div>
                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.matiere') }}</label>
                    <x-custom-datalist
                        name="matiere_filter"
                        :options="$allMatieres->map(fn($m) => ['id' => $m->nom_matiere, 'name' => $m->nom_matiere])->toArray()"
                        option-value="id"
                        option-label="name"
                        :selected="request('matiere_filter')"
                        placeholder="{{ __('app.toutes_les_matieres') }}"
                        id="matiereFilter"
                    />
                </div>

                <x-slot name="actions">
                    <a href="{{ route('admin.evaluations.index') }}" class="google-btn google-btn-text">{{ __('app.reinitialiser') }}</a>
                    <button type="submit" class="google-btn google-btn-primary">{{ __('app.appliquer_filtres') }}</button>
                </x-slot>
            </x-filters.layout>
        </form>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.evaluations.index') }}" id="searchForm" class="google-search-form">
            <input type="hidden" name="type_filter" value="{{ request('type_filter') }}">
            <input type="hidden" name="classe_filter" value="{{ request('classe_filter') }}">
            <input type="hidden" name="matiere_filter" value="{{ request('matiere_filter') }}">
            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.rechercher') }}</label>
                <input type="text" class="google-filter-input" name="search" id="searchInput"
                    placeholder="{{ __('app.rechercher') }}..." value="{{ request('search') }}">
            </div>
        </form>

        @if($evaluations->count() > 0)
            <x-table.data-table title="{{ __('app.liste_evaluations') }}" :showSearch="false" :showSort="true"
                :sortOptions="[
                    'date:asc' => __('Date ↑'),
                    'date:desc' => __('Date ↓'),
                    'matiere:asc' => __('Matière A→Z'),
                    'matiere:desc' => __('Matière Z→A'),
                    'classe:asc' => __('Classe A→Z'),
                    'classe:desc' => __('Classe Z→A')
                ]"
                serverFormId="searchForm">
                <table class="google-table" id="evaluationsTable">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>{{ __('app.matiere') }}</th>
                            <th>{{ __('app.type') }}</th>
                            <th>{{ __('app.date') }}</th>
                            <th>{{ __('app.horaire') }}</th>
                            <th>{{ __('app.classe') }}</th>
                            <th style="width: 120px;">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->id_evaluation }}</td>
                                <td>
                                    <span class="google-table-text">{{ $evaluation->matiere_name }}</span>
                                </td>
                                <td>
                                    @if($evaluation->type == 'examen')
                                        <span class="google-badge google-badge-red">{{ ucfirst($evaluation->type) }}</span>
                                    @elseif($evaluation->type == 'controle')
                                        <span class="google-badge google-badge-yellow">{{ ucfirst($evaluation->type) }}</span>
                                    @else
                                        <span class="google-badge google-badge-green">{{ ucfirst($evaluation->type) }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                                </td>
                                <td>
                                    @php
                                        $startTime = $evaluation->date_debut ? \Carbon\Carbon::parse($evaluation->date_debut)->format('H:i') : null;
                                        $endTime = $evaluation->date_fin ? \Carbon\Carbon::parse($evaluation->date_fin)->format('H:i') : null;
                                        $hasValidStart = $startTime && $startTime != '00:00';
                                        $hasValidEnd = $endTime && $endTime != '00:00';
                                    @endphp

                                    @if($hasValidStart && $hasValidEnd)
                                        {{ $startTime }} - {{ $endTime }}
                                    @elseif($hasValidStart)
                                        {{ $startTime }}
                                    @elseif($hasValidEnd)
                                        {{ $endTime }}
                                    @else
                                        <span class="google-text-na">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($evaluation->classe)
                                        <span class="google-badge google-badge-neutral">{{ $evaluation->classe->nom_classe }}</span>
                                    @else
                                        <span class="google-text-na">—</span>
                                    @endif
                                </td>
                                <td>
                                    @include('admin.academic.evaluations.partials.actions', ['evaluation' => $evaluation])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                @slot('footer')
                    @if($evaluations->hasPages())
                        <div class="google-pagination">
                            {{ $evaluations->links() }}
                        </div>
                    @endif
                @endslot
            </x-table.data-table>
        @else
            <!-- Empty State -->
            <div class="google-empty-state">
                @if(request()->hasAny(['type_filter', 'classe_filter', 'matiere_filter', 'search']))
                    <!-- Filtered but no results -->
                    <i class="fas fa-search google-empty-icon" aria-hidden="true"></i>
                    <h4 class="google-empty-title">{{ __('app.aucun_resultat_trouve') }}</h4>
                    <p class="google-empty-text">
                        Aucune évaluation ne correspond à vos critères de recherche.
                        @if(request('search'))
                            <br>Recherche : <strong>"{{ request('search') }}"</strong>
                        @endif
                        @if(request('type_filter'))
                            <br>Type : <strong>{{ ucfirst(request('type_filter')) }}</strong>
                        @endif
                        @if(request('classe_filter'))
                            <br>Classe : <strong>{{ request('classe_filter') }}</strong>
                        @endif
                        @if(request('matiere_filter'))
                            <br>Matière : <strong>{{ request('matiere_filter') }}</strong>
                        @endif
                    </p>
                    <div class="google-empty-actions">
                        <a href="{{ route('admin.evaluations.index') }}" class="google-btn google-btn-primary" aria-label="Réinitialiser tous les filtres">
                            <i class="fas fa-undo" aria-hidden="true"></i>
                            <span>Réinitialiser les filtres</span>
                        </a>
                    </div>
                @else
                    <!-- No evaluations at all -->
                    <i class="fas fa-clipboard empty-icon" aria-hidden="true"></i>
                    <h4 class="google-empty-title">{{ __('app.aucune_evaluation_trouvee') }}</h4>
                    <p class="google-empty-text">Aucune évaluation n'a encore été enregistrée dans le système.</p>
                    @admin
                        <div class="google-empty-actions">
                            <a href="{{ route('admin.evaluations.create') }}" class="google-btn google-btn-primary" aria-label="Ajouter une nouvelle évaluation">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                <span>Ajouter une évaluation</span>
                            </a>
                        </div>
                    @endadmin
                @endif
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        const filtersForm = document.getElementById('filtersForm');
        const typeFilter = document.getElementById('typeFilter');
        const classeFilter = document.getElementById('classeFilter');
        const matiereFilter = document.getElementById('matiereFilter');
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        // Auto-submit filter form when datalist changes
        if (filtersForm) {
            const filterElements = [typeFilter, classeFilter, matiereFilter];
            filterElements.forEach(element => {
                if (element) {
                    element.addEventListener('change', function() {
                        // Small delay to ensure value is set
                        setTimeout(() => {
                            filtersForm.submit();
                        }, 100);
                    });
                }
            });
        }

        // Auto-submit search with debounce
        if (searchForm && searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 500);
            });
        }
    </script>
@endpush
@endsection
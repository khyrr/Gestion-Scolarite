@extends('layouts.dashboard')

@section('title', __('app.evaluations'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.evaluations') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('evaluations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            {{ __('app.nouvelle_evaluation') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="google-container">
    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.total_evaluations') }}</div>
            <div class="google-stat-value">{{ $evaluations->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.examens') }}</div>
            <div class="google-stat-value">{{ $evaluations->where('type', 'examen')->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.controles') }}</div>
            <div class="google-stat-value">{{ $evaluations->where('type', 'controle')->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.devoirs') }}</div>
            <div class="google-stat-value">{{ $evaluations->where('type', 'devoir')->count() }}</div>
        </div>
    </div>

    <!-- Evaluations Table -->
    <div class="google-table-wrapper">
        <!-- Filters -->
        <div class="google-filters">
            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.rechercher') }}</label>
                <input type="text" class="google-filter-input" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
            </div>
            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.type') }}</label>
                <select class="google-filter-select" id="typeFilter">
                    <option value="">{{ __('app.tous_les_types') }}</option>
                    <option value="examen">{{ __('app.examens') }}</option>
                    <option value="controle">{{ __('app.controles') }}</option>
                    <option value="devoir">{{ __('app.devoirs') }}</option>
                </select>
            </div>
            <div class="google-filter-group">
                <label class="google-filter-label">{{ __('app.classe') }}</label>
                <select class="google-filter-select" id="classeFilter">
                    <option value="">{{ __('app.toutes_les_classes') }}</option>
                    @foreach($evaluations->pluck('classe')->unique()->filter() as $classe)
                        <option value="{{ $classe->nom_classe }}">{{ $classe->nom_classe }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($evaluations->count() > 0)
            <div class="google-table-container">
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
                                @include('academic.evaluations.partials.actions', ['evaluation' => $evaluation])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- No Results Message (hidden by default) -->
            <div id="noResultsMessage" class="google-empty-state" style="display: none;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="M21 21l-4.35-4.35"></path>
                </svg>
                <h3>{{ __('app.aucun_resultat') }}</h3>
                <p>{{ __('app.essayez_autres_filtres') }}</p>
                <button class="google-btn google-btn-text" onclick="resetFilters()">
                    {{ __('app.reinitialiser_filtres') }}
                </button>
            </div>
        @else
            <div class="google-empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3>{{ __('app.aucune_evaluation_trouvee') }}</h3>
                <p>{{ __('app.no_data') }}</p>
                @admin
                    <a href="{{ route('evaluations.create') }}" class="google-btn google-btn-primary">
                        {{ __('app.nouvelle_evaluation') }}
                    </a>
                @endadmin
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    :root {
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-blue-light: #e8f0fe;
        --google-gray-50: #f8f9fa;
        --google-gray-100: #f1f3f4;
        --google-gray-200: #e8eaed;
        --google-gray-300: #dadce0;
        --google-gray-500: #9aa0a6;
        --google-gray-600: #80868b;
        --google-gray-700: #5f6368;
        --google-gray-900: #202124;
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    /* Container */
    .google-container {
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    /* Statistics Grid */
    .google-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--google-spacing-lg);
        padding: var(--google-spacing-lg);
    }

    .google-stat-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-lg);
        text-align: center;
    }

    .google-stat-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-sm);
    }

    .google-stat-value {
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
    }

    /* Table Wrapper */
    .google-table-wrapper {
        margin: 0 var(--google-spacing-lg) var(--google-spacing-lg);
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-lg);
    }

    /* Filters */
    .google-filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-lg);
    }

    .google-filter-group {
        display: flex;
        flex-direction: column;
    }

    .google-filter-label {
        font-size: 0.75rem;
        color: var(--google-gray-700);
        margin-bottom: var(--google-spacing-xs);
    }

    .google-filter-input,
    .google-filter-select {
        padding: 8px 12px;
        font-size: 0.875rem;
        color: var(--google-gray-900);
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 4px;
        transition: var(--google-transition);
    }

    .google-filter-input:focus,
    .google-filter-select:focus {
        outline: none;
        border-color: var(--google-blue);
        box-shadow: 0 0 0 1px var(--google-blue);
    }

    /* Table */
    .google-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .google-table {
        width: 100%;
        border-collapse: collapse;
    }

    .google-table thead th {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--google-gray-700);
        text-align: left;
        padding: 12px 16px;
        border-bottom: 1px solid var(--google-gray-300);
        white-space: nowrap;
    }

    .google-table tbody td {
        font-size: 0.875rem;
        color: var(--google-gray-900);
        padding: 12px 16px;
        border-bottom: 1px solid var(--google-gray-200);
        white-space: nowrap;
    }

    .google-table tbody tr:hover {
        background: var(--google-gray-50);
    }

    .google-table-text {
        font-weight: 500;
    }

    /* Badges */
    .google-badge {
        display: inline-block;
        padding: 4px 12px;
        font-size: 0.75rem;
        border-radius: 16px;
        font-weight: 500;
    }

    .google-badge-red {
        background: #fce8e6;
        color: #c5221f;
    }

    .google-badge-yellow {
        background: #fef7e0;
        color: #f9ab00;
    }

    .google-badge-green {
        background: #e6f4ea;
        color: #1e8e3e;
    }

    .google-badge-neutral {
        background: var(--google-gray-100);
        color: var(--google-gray-700);
    }

    .google-text-na {
        color: var(--google-gray-500);
    }

    /* Empty State */
    .google-empty-state {
        text-align: center;
        padding: var(--google-spacing-2xl) var(--google-spacing-lg);
    }

    .google-empty-state svg {
        color: var(--google-gray-500);
        margin-bottom: var(--google-spacing-md);
    }

    .google-empty-state h3 {
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-sm) 0;
    }

    .google-empty-state p {
        font-size: 0.875rem;
        color: var(--google-gray-600);
        margin: 0 0 var(--google-spacing-lg) 0;
    }

    /* Buttons */
    .google-btn {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: var(--google-transition);
        text-decoration: none;
    }

    .google-btn-text {
        background: transparent;
        color: var(--google-blue);
    }

    .google-btn-text:hover {
        background: var(--google-blue-light);
        color: var(--google-blue-hover);
    }

    .google-btn-primary {
        background: var(--google-blue);
        color: white;
    }

    .google-btn-primary:hover {
        background: var(--google-blue-hover);
        box-shadow: var(--google-shadow);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            padding: var(--google-spacing-md);
        }

        .google-stat-value {
            font-size: 1.75rem;
        }

        .google-table-wrapper {
            margin: 0 var(--google-spacing-md) var(--google-spacing-md);
        }

        .google-filters {
            grid-template-columns: 1fr;
        }

        .google-table thead th,
        .google-table tbody td {
            font-size: 0.8125rem;
            padding: 10px 12px;
        }
    }

    @media (max-width: 576px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            padding: var(--google-spacing-md);
            gap: var(--google-spacing-md);
        }

        .google-stat-card {
            padding: var(--google-spacing-md);
        }

        .google-stat-label {
            font-size: 0.6875rem;
        }

        .google-stat-value {
            font-size: 1.5rem;
        }

        .google-table-wrapper {
            padding: var(--google-spacing-md);
            margin: var(--google-spacing-md);
        }

        .google-filters {
            gap: var(--google-spacing-sm);
        }

        .google-filter-label {
            font-size: 0.75rem;
        }

        .google-filter-input,
        .google-filter-select {
            font-size: 0.875rem;
            padding: 8px 12px;
        }

        .google-table thead th {
            font-size: 0.75rem;
            padding: 10px 8px;
        }

        .google-table tbody td {
            font-size: 0.8125rem;
            padding: 10px 8px;
        }

        .google-badge {
            font-size: 0.6875rem;
            padding: 3px 8px;
        }

        .google-empty-state {
            padding: var(--google-spacing-xl) var(--google-spacing-md);
        }

        .google-empty-state svg {
            width: 48px;
            height: 48px;
        }

        .google-empty-state h3 {
            font-size: 1.125rem;
        }

        .google-empty-state p {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .google-stats-grid {
            grid-template-columns: 1fr;
            padding: var(--google-spacing-sm);
            gap: var(--google-spacing-sm);
        }

        .google-stat-card {
            padding: var(--google-spacing-md) var(--google-spacing-sm);
        }

        .google-stat-label {
            font-size: 0.6875rem;
        }

        .google-stat-value {
            font-size: 1.25rem;
        }

        .google-table-wrapper {
            padding: var(--google-spacing-sm);
            margin: var(--google-spacing-sm);
        }

        .google-filters {
            gap: var(--google-spacing-sm);
            margin-bottom: var(--google-spacing-md);
        }

        .google-filter-label {
            font-size: 0.6875rem;
        }

        .google-filter-input,
        .google-filter-select {
            font-size: 0.8125rem;
            padding: 7px 10px;
        }

        .google-table thead th {
            font-size: 0.6875rem;
            padding: 8px 6px;
        }

        .google-table tbody td {
            font-size: 0.75rem;
            padding: 8px 6px;
        }

        .google-table-text {
            font-size: 0.75rem;
        }

        .google-badge {
            font-size: 0.625rem;
            padding: 2px 6px;
        }

        .google-empty-state {
            padding: var(--google-spacing-lg) var(--google-spacing-sm);
        }

        .google-empty-state svg {
            width: 40px;
            height: 40px;
        }

        .google-empty-state h3 {
            font-size: 1rem;
        }

        .google-empty-state p {
            font-size: 0.8125rem;
        }

        .google-btn {
            font-size: 0.8125rem;
            padding: 7px 14px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
// Filter functionality
const searchInput = document.getElementById('searchInput');
const typeFilter = document.getElementById('typeFilter');
const classeFilter = document.getElementById('classeFilter');
const noResultsMessage = document.getElementById('noResultsMessage');
const tableContainer = document.querySelector('.google-table-container');

function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedType = typeFilter.value.toLowerCase();
    const selectedClasse = classeFilter.value.toLowerCase();
    
    const rows = document.querySelectorAll('#evaluationsTable tbody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const matiere = row.cells[1].textContent.toLowerCase();
        const type = row.cells[2].textContent.toLowerCase();
        const date = row.cells[3].textContent.toLowerCase();
        const classe = row.cells[5].textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
        const matchesType = selectedType === '' || type.includes(selectedType);
        const matchesClasse = selectedClasse === '' || classe.includes(selectedClasse);
        
        if (matchesSearch && matchesType && matchesClasse) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    if (visibleCount === 0) {
        tableContainer.style.display = 'none';
        noResultsMessage.style.display = 'block';
    } else {
        tableContainer.style.display = 'block';
        noResultsMessage.style.display = 'none';
    }
}

// Reset all filters
function resetFilters() {
    searchInput.value = '';
    typeFilter.value = '';
    classeFilter.value = '';
    filterTable();
}

// Add event listeners
searchInput.addEventListener('keyup', filterTable);
typeFilter.addEventListener('change', filterTable);
classeFilter.addEventListener('change', filterTable);
</script>
@endpush
@endsection

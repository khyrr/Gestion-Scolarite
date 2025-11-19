@extends('layouts.dashboard')

@section('title', __('app.cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.cours') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('cours.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_cours') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="google-container">
    <!-- Page Header -->
    <div class="google-page-header">
        <h1 class="google-page-title">{{ __('app.cours') }}</h1>
        <div class="google-header-actions">
            @if($cours->count() > 0)
                <input type="text" class="google-search-input" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
            @endif
            
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $cours->count() }}</div>
            <div class="google-stat-label">{{ __('app.total_cours') }}</div>
        </div>
        
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $cours->pluck('matiere')->unique()->count() }}</div>
            <div class="google-stat-label">{{ __('app.matieres') }}</div>
        </div>
        
        <div class="google-stat-item">
            <div class="google-stat-value">{{ $cours->where('jour', strtolower(now()->locale('fr_FR')->dayName))->count() }}</div>
            <div class="google-stat-label">{{ __('app.aujourdhui') }}</div>
        </div>
        
        <a href="{{ route('cours.spectacle') }}" class="google-stat-item google-stat-link">
            <div class="google-stat-value" style="font-size: 0.875rem; font-weight: 500;">{{ __('app.voir_emploi_temps') }}</div>
            <div class="google-stat-label">{{ __('app.emploi_du_temps') }}</div>
        </a>
    </div>

    <!-- Filters -->
    @if($cours->count() > 0)
        <div class="google-filter-wrapper">
            <!-- Mobile Filter Button -->
            <div class="google-filter-mobile-toggle">
                <button class="google-filter-btn" id="filterToggleBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 7H20M7 12H17M10 17H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>{{ __('app.filtres') }}</span>
                    <span class="google-filter-badge" id="filterBadge" style="display: none;">0</span>
                </button>
            </div>

            <!-- Filters Container -->
            <div class="google-filters" id="filtersContainer">
                <div class="google-filters-header">
                <h3 class="google-filters-title">{{ __('app.filtres') }}</h3>
                <button class="google-filter-close" id="filterCloseBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                </div>
                <div class="google-filters-content">
                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.jour') }}</label>
                    <input type="text" class="google-filter-input" id="dayFilter" list="dayList" placeholder="{{ __('app.tous_les_jours') }}">
                    <datalist id="dayList">
                        <option value="lundi">{{ __('app.lundi') }}</option>
                        <option value="mardi">{{ __('app.mardi') }}</option>
                        <option value="mercredi">{{ __('app.mercredi') }}</option>
                        <option value="jeudi">{{ __('app.jeudi') }}</option>
                        <option value="vendredi">{{ __('app.vendredi') }}</option>
                    </datalist>
                </div>

                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.classe') }}</label>
                    <input type="text" class="google-filter-input" id="classeFilter" list="classeList" placeholder="{{ __('app.toutes_les_classes') }}">
                    <datalist id="classeList">
                        @foreach($cours->pluck('classe')->unique()->filter() as $classe)
                            <option value="{{ $classe->nom_classe }}">{{ $classe->nom_classe }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.matiere') }}</label>
                    <input type="text" class="google-filter-input" id="matiereFilter" list="matiereList" placeholder="{{ __('app.toutes_les_matieres') }}">
                    <datalist id="matiereList">
                        @foreach($cours->pluck('matiere')->unique() as $matiere)
                            <option value="{{ $matiere->code_matiere }}">{{ $matiere->nom_matiere ?? $matiere->code_matiere }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="google-filter-group">
                    <label class="google-filter-label">{{ __('app.enseignant') }}</label>
                    <input type="text" class="google-filter-input" id="enseignantFilter" list="enseignantList" placeholder="{{ __('app.tous_les_enseignants') }}">
                    <datalist id="enseignantList">
                        @foreach($cours->pluck('enseignant')->unique()->filter() as $enseignant)
                            <option value="{{ $enseignant->prenom }} {{ $enseignant->nom }}">{{ $enseignant->prenom }} {{ $enseignant->nom }}</option>
                        @endforeach
                    </datalist>
                </div>
                </div>
                <div class="google-filters-actions">
                    <button class="google-btn google-btn-text" onclick="resetFilters()">{{ __('app.reinitialiser') }}</button>
                    <button class="google-btn google-btn-primary" id="applyFiltersBtn">{{ __('app.appliquer_filtres') }}</button>
                </div>
            </div>

            <!-- Filter Overlay -->
            <div class="google-filter-overlay" id="filterOverlay"></div>
        </div>

        <!-- Courses List -->
        <div class="google-list-container" id="coursListContainer">
            @foreach($cours as $course)
                <div class="google-list-item" data-matiere="{{ $course->matiere->code_matiere }}" data-classe="{{ $course->classe->nom_classe ?? '' }}" data-enseignant="{{ $course->enseignant ? $course->enseignant->prenom . ' ' . $course->enseignant->nom : '' }}" data-jour="{{ $course->jour }}">
                    <div class="google-list-main">
                        <div class="google-list-title">
                            <span class="google-matiere-code">{{ $course->matiere->code_matiere }}</span>
                            <span class="google-matiere-name">{{ $course->matiere->nom_matiere ?? $course->matiere->code_matiere }}</span>
                        </div>
                        <div class="google-list-meta">
                            @if($course->classe)
                                <span class="google-meta-item">{{ $course->classe->nom_classe }}</span>
                            @endif
                            @if($course->enseignant)
                                <span class="google-meta-item">{{ $course->enseignant->prenom }} {{ $course->enseignant->nom }}</span>
                            @else
                                <span class="google-meta-item google-text-muted">{{ __('app.non_assigne') }}</span>
                            @endif
                            <span class="google-meta-item">{{ ucfirst($course->jour) }}</span>
                            <span class="google-meta-item">
                                {{ \Carbon\Carbon::parse($course->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($course->date_fin)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                    <div class="google-list-actions">
                        @include('academic.cours.partials.actions', ['course' => $course])
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- No Results Message -->
        <div id="noResultsMessage" class="google-empty-state" style="display: none;">
            <svg class="google-empty-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h3 class="google-empty-title">{{ __('app.aucun_resultat') }}</h3>
            <p class="google-empty-text">{{ __('app.essayez_autres_filtres') }}</p>
            <button class="google-btn google-btn-text" onclick="resetFilters()">
                {{ __('app.reinitialiser_filtres') }}
            </button>
        </div>
    @else
        <div class="google-empty-state">
            <svg class="google-empty-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 14L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h3 class="google-empty-title">{{ __('app.aucun_cours_trouve') }}</h3>
            <p class="google-empty-text">{{ __('app.no_data') }}</p>
            @admin
                <a href="{{ route('cours.create') }}" class="google-btn google-btn-primary">
                    {{ __('app.ajouter_cours') }}
                </a>
            @endadmin
        </div>
    @endif
</div>

@push('styles')
<style>
:root {
    --google-blue: #1a73e8;
    --google-blue-hover: #1967d2;
    --google-blue-light: #e8f0fe;
    
    --google-white: #ffffff;
    --google-gray-50: #f8f9fa;
    --google-gray-100: #f1f3f4;
    --google-gray-200: #e8eaed;
    --google-gray-300: #dadce0;
    --google-gray-400: #bdc1c6;
    --google-gray-500: #9aa0a6;
    --google-gray-600: #80868b;
    --google-gray-700: #5f6368;
    --google-gray-800: #3c4043;
    --google-gray-900: #202124;
    
    --google-font: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    
    --google-spacing-xs: 4px;
    --google-spacing-sm: 8px;
    --google-spacing-md: 16px;
    --google-spacing-lg: 24px;
    --google-spacing-xl: 32px;
    --google-spacing-2xl: 48px;
    
    --google-radius: 8px;
    --google-radius-sm: 4px;
    
    --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
    
    --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
}

/* Container */
.google-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--google-spacing-2xl) var(--google-spacing-md);
}

/* Page Header */
.google-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--google-spacing-xl);
    gap: var(--google-spacing-md);
}

.google-page-title {
    font-family: var(--google-font);
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0;
    letter-spacing: -0.5px;
}

.google-header-actions {
    display: flex;
    gap: var(--google-spacing-md);
    align-items: center;
}

.google-search-input {
    width: 300px;
    padding: 10px 16px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    color: var(--google-gray-900);
    background: var(--google-white);
    border: 1px solid var(--google-gray-300);
    border-radius: 24px;
    outline: none;
    transition: var(--google-transition);
}

.google-search-input:hover {
    border-color: var(--google-gray-400);
}

.google-search-input:focus {
    border-color: var(--google-blue);
    box-shadow: 0 0 0 2px var(--google-blue-light);
}

/* Stats Grid */
.google-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--google-spacing-md);
    margin-bottom: var(--google-spacing-xl);
}

.google-stat-item {
    background: var(--google-white);
    border: 1px solid var(--google-gray-200);
    border-radius: var(--google-radius);
    padding: var(--google-spacing-lg);
    text-align: center;
}

.google-stat-link {
    text-decoration: none;
    cursor: pointer;
    transition: var(--google-transition);
}

.google-stat-link:hover {
    border-color: var(--google-blue);
    box-shadow: var(--google-shadow-1);
}

.google-stat-value {
    font-family: var(--google-font);
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin-bottom: var(--google-spacing-xs);
}

.google-stat-label {
    font-family: var(--google-font);
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--google-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Mobile Filter Toggle */
.google-filter-mobile-toggle {
    display: none;
    margin-bottom: var(--google-spacing-lg);
}

.google-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--google-spacing-sm);
    padding: 10px 16px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--google-gray-700);
    background: var(--google-white);
    border: 2px solid var(--google-gray-300);
    border-radius: var(--google-radius-sm);
    cursor: pointer;
    transition: var(--google-transition);
    position: relative;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.google-filter-btn:hover {
    background: var(--google-gray-50);
    border-color: var(--google-blue);
}

.google-filter-btn:active {
    background: var(--google-gray-100);
}

.google-filter-btn svg {
    flex-shrink: 0;
}

.google-filter-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--google-white);
    background: var(--google-blue);
    border-radius: 10px;
}

/* Filter Overlay */
.google-filter-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: transparent;
    z-index: 998;
}

.google-filter-overlay.active {
    display: block;
}

/* Filters */
.google-filters {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--google-spacing-md);
    margin-bottom: var(--google-spacing-lg);
    background: var(--google-white);
    border: 1px solid var(--google-gray-200);
    border-radius: var(--google-radius);
    padding: var(--google-spacing-lg);
}

.google-filters-header {
    display: none;
}

.google-filters-content {
    display: contents;
}

.google-filters-actions {
    display: none;
}

.google-filter-group {
    display: flex;
    flex-direction: column;
}

.google-filter-label {
    font-family: var(--google-font);
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--google-gray-700);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.google-filter-input {
    padding: 10px 12px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    color: var(--google-gray-900);
    background: var(--google-white);
    border: 1px solid var(--google-gray-300);
    border-radius: var(--google-radius-sm);
    outline: none;
    cursor: text;
    transition: var(--google-transition);
}

.google-filter-input:hover {
    border-color: var(--google-gray-400);
    background: var(--google-gray-50);
}

.google-filter-input:focus {
    border-color: var(--google-blue);
    background: var(--google-white);
    box-shadow: 0 0 0 2px var(--google-blue-light);
}

.google-filter-input::placeholder {
    color: var(--google-gray-500);
    font-style: italic;
}

/* List Container */
.google-list-container {
    background: var(--google-white);
    border: 1px solid var(--google-gray-200);
    border-radius: var(--google-radius);
    overflow: hidden;
}

.google-list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--google-spacing-md) var(--google-spacing-lg);
    border-bottom: 1px solid var(--google-gray-200);
    transition: var(--google-transition);
    gap: var(--google-spacing-md);
}

.google-list-item:last-child {
    border-bottom: none;
}

.google-list-item:hover {
    background: var(--google-gray-50);
}

.google-list-main {
    flex: 1;
    min-width: 0;
}

.google-list-title {
    display: flex;
    align-items: center;
    gap: var(--google-spacing-md);
    margin-bottom: var(--google-spacing-xs);
    flex-wrap: wrap;
}

.google-matiere-code {
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--google-blue);
    background: var(--google-blue-light);
    padding: 4px 10px;
    border-radius: var(--google-radius-sm);
}

.google-matiere-name {
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--google-gray-900);
}

.google-list-meta {
    display: flex;
    gap: var(--google-spacing-md);
    flex-wrap: wrap;
}

.google-meta-item {
    font-family: var(--google-font);
    font-size: 0.75rem;
    color: var(--google-gray-600);
}

.google-text-muted {
    font-style: italic;
    color: var(--google-gray-500);
}

.google-list-actions {
    display: flex;
    gap: var(--google-spacing-sm);
    flex-shrink: 0;
}

/* Buttons */
.google-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 24px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    border-radius: var(--google-radius-sm);
    border: none;
    cursor: pointer;
    transition: var(--google-transition);
    letter-spacing: 0.25px;
    white-space: nowrap;
}

.google-btn-primary {
    background: var(--google-blue);
    color: var(--google-white);
}

.google-btn-primary:hover {
    background: var(--google-blue-hover);
    color: var(--google-white);
    box-shadow: var(--google-shadow-1);
}

.google-btn-text {
    background: transparent;
    color: var(--google-blue);
}

.google-btn-text:hover {
    background: var(--google-blue-light);
    color: var(--google-blue-hover);
}

/* Empty State */
.google-empty-state {
    text-align: center;
    padding: var(--google-spacing-2xl);
    background: var(--google-white);
    border: 1px solid var(--google-gray-200);
    border-radius: var(--google-radius);
}

.google-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto var(--google-spacing-md);
    color: var(--google-gray-400);
}

.google-empty-title {
    font-family: var(--google-font);
    font-size: 1.25rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-sm) 0;
}

.google-empty-text {
    font-family: var(--google-font);
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0 0 var(--google-spacing-lg) 0;
}

/* Responsive */
@media (max-width: 1024px) {
    .google-container {
        padding: var(--google-spacing-xl) var(--google-spacing-md);
    }

    .google-search-input {
        width: 250px;
    }

    .google-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .google-container {
        padding: var(--google-spacing-lg) var(--google-spacing-md);
    }

    .google-page-header {
        flex-direction: column;
        align-items: stretch;
        gap: var(--google-spacing-md);
    }

    .google-page-title {
        font-size: 1.75rem;
    }

    .google-header-actions {
        width: 100%;
        flex-direction: row;
        gap: var(--google-spacing-sm);
    }

    .google-search-input {
        flex: 1;
        min-width: 0;
    }

    .google-stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--google-spacing-sm);
    }

    .google-stat-item {
        padding: var(--google-spacing-md);
    }

    .google-stat-value {
        font-size: 1.5rem;
    }

    .google-stat-label {
        font-size: 0.6875rem;
    }

    /* Filter wrapper for positioning context */
    .google-filter-wrapper {
        position: relative;
        margin-bottom: var(--google-spacing-lg);
    }

    /* Show mobile filter toggle */
    .google-filter-mobile-toggle {
        display: block !important;
    }

    /* Hide desktop filters, show as dropdown on mobile */
    .google-filters {
        display: none !important;
    }

    .google-filters.active {
        display: block !important;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        width: 100%;
        background: white;
        z-index: 999;
        border-radius: var(--google-radius);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--google-gray-200);
        padding: 0;
        animation: slideDown 0.25s cubic-bezier(0.4, 0.0, 0.2, 1);
        overflow: hidden;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .google-filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 12px;
        border-bottom: 1px solid var(--google-gray-200);
        background: var(--google-white);
    }

    .google-filters-title {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .google-filter-close {
        width: 28px;
        height: 28px;
        background: transparent;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--google-gray-600);
        transition: var(--google-transition);
    }

    .google-filter-close svg {
        width: 18px;
        height: 18px;
    }

    .google-filter-close:hover {
        background: var(--google-gray-100);
        color: var(--google-gray-900);
    }

    .google-filter-close:active {
        background: var(--google-gray-200);
    }

    .google-filters-content {
        display: block;
        padding: 12px;
        max-height: 40vh;
        overflow-y: auto;
    }

    .google-filter-group {
        margin-bottom: 10px;
    }

    .google-filter-group:last-child {
        margin-bottom: 0;
    }

    .google-filter-label {
        display: block;
        font-size: 0.625rem;
        font-weight: 500;
        color: var(--google-gray-700);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .google-filter-input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid var(--google-gray-300);
        border-radius: 4px;
        font-size: 0.8125rem;
        background: white;
        font-family: var(--google-font);
        color: var(--google-gray-900);
        transition: var(--google-transition);
    }

    .google-filter-input:hover {
        border-color: var(--google-gray-400);
        background: var(--google-gray-50);
    }

    .google-filter-input:focus {
        outline: none;
        border-color: var(--google-blue);
        background: white;
        box-shadow: 0 0 0 3px var(--google-blue-light);
    }

    .google-filter-input::placeholder {
        color: var(--google-gray-500);
        font-style: italic;
    }

    .google-filters-actions {
        display: flex;
        gap: 8px;
        padding: 10px 12px;
        border-top: 1px solid var(--google-gray-200);
        background: var(--google-gray-50);
    }

    .google-filters-actions .google-btn {
        flex: 1;
        padding: 8px 12px;
        font-size: 0.8125rem;
        font-weight: 500;
    }

    .google-list-item {
        flex-direction: column;
        align-items: stretch;
        padding: var(--google-spacing-md);
        gap: var(--google-spacing-md);
    }

    .google-list-title {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--google-spacing-xs);
    }

    .google-list-meta {
        flex-direction: column;
        gap: var(--google-spacing-xs);
    }

    .google-list-actions {
        width: 100%;
        justify-content: flex-start;
        padding-top: var(--google-spacing-sm);
        border-top: 1px solid var(--google-gray-200);
    }
}

@media (max-width: 480px) {
    .google-container {
        padding: var(--google-spacing-md) var(--google-spacing-sm);
    }

    .google-page-header {
        margin-bottom: var(--google-spacing-lg);
    }

    .google-page-title {
        font-size: 1.5rem;
    }

    .google-stats-grid {
        grid-template-columns: 1fr;
        gap: var(--google-spacing-sm);
        margin-bottom: var(--google-spacing-lg);
    }

    .google-stat-item {
        padding: var(--google-spacing-sm) var(--google-spacing-md);
    }

    .google-stat-value {
        font-size: 1.25rem;
    }

    .google-stat-label {
        font-size: 0.625rem;
    }

    .google-filters {
        width: 100%;
        max-width: 100%;
    }

    .google-filter-select {
        padding: 10px 12px;
        font-size: 0.8125rem;
    }

    .google-list-item {
        padding: var(--google-spacing-sm);
    }

    .google-matiere-code {
        font-size: 0.8125rem;
        padding: 3px 8px;
    }

    .google-matiere-name {
        font-size: 0.8125rem;
    }

    .google-meta-item {
        font-size: 0.6875rem;
    }

    .google-empty-state {
        padding: var(--google-spacing-xl) var(--google-spacing-md);
    }

    .google-empty-icon {
        width: 48px;
        height: 48px;
    }

    .google-empty-title {
        font-size: 1.125rem;
    }

    .google-empty-text {
        font-size: 0.8125rem;
    }
}
</style>
@endpush

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

// Mobile filter panel elements
const filterToggleBtn = document.getElementById('filterToggleBtn');
const filterCloseBtn = document.getElementById('filterCloseBtn');
const applyFiltersBtn = document.getElementById('applyFiltersBtn');
const filtersContainer = document.getElementById('filtersContainer');
const filterOverlay = document.getElementById('filterOverlay');
const filterBadge = document.getElementById('filterBadge');

function filterList() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
    const selectedDay = dayFilter ? dayFilter.value.toLowerCase().trim() : '';
    const selectedClasse = classeFilter ? classeFilter.value.toLowerCase().trim() : '';
    const selectedMatiere = matiereFilter ? matiereFilter.value.toLowerCase().trim() : '';
    const selectedEnseignant = enseignantFilter ? enseignantFilter.value.toLowerCase().trim() : '';
    
    const items = document.querySelectorAll('.google-list-item');
    let visibleCount = 0;
    
    items.forEach(item => {
        const matiere = item.getAttribute('data-matiere').toLowerCase();
        const classe = item.getAttribute('data-classe').toLowerCase();
        const enseignant = item.getAttribute('data-enseignant').toLowerCase();
        const jour = item.getAttribute('data-jour').toLowerCase();
        const itemText = item.textContent.toLowerCase();
        
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
    if (dayFilter && dayFilter.value) activeFilters++;
    if (classeFilter && classeFilter.value) activeFilters++;
    if (matiereFilter && matiereFilter.value) activeFilters++;
    if (enseignantFilter && enseignantFilter.value) activeFilters++;
    
    if (filterBadge) {
        if (activeFilters > 0) {
            filterBadge.textContent = activeFilters;
            filterBadge.style.display = 'inline-flex';
        } else {
            filterBadge.style.display = 'none';
        }
    }
}

// Open mobile filter panel
function openFilterPanel() {
    console.log('Opening filter panel');
    console.log('filtersContainer:', filtersContainer);
    if (filtersContainer) {
        filtersContainer.classList.add('active');
        console.log('Added active class');
    }
    if (filterOverlay) {
        filterOverlay.classList.add('active');
    }
}

// Close mobile filter panel
function closeFilterPanel() {
    console.log('Closing filter panel');
    if (filtersContainer) {
        filtersContainer.classList.remove('active');
    }
    if (filterOverlay) {
        filterOverlay.classList.remove('active');
    }
}

// Apply filters and close panel (mobile)
function applyFilters() {
    filterList();
    closeFilterPanel();
}

// Reset all filters
function resetFilters() {
    if (searchInput) searchInput.value = '';
    if (dayFilter) dayFilter.value = '';
    if (classeFilter) classeFilter.value = '';
    if (matiereFilter) matiereFilter.value = '';
    if (enseignantFilter) enseignantFilter.value = '';
    filterList();
}

// Event listeners for desktop (real-time filtering)
if (searchInput) searchInput.addEventListener('keyup', filterList);
if (window.innerWidth > 768) {
    if (dayFilter) {
        dayFilter.addEventListener('input', filterList);
        dayFilter.addEventListener('change', filterList);
    }
    if (classeFilter) {
        classeFilter.addEventListener('input', filterList);
        classeFilter.addEventListener('change', filterList);
    }
    if (matiereFilter) {
        matiereFilter.addEventListener('input', filterList);
        matiereFilter.addEventListener('change', filterList);
    }
    if (enseignantFilter) {
        enseignantFilter.addEventListener('input', filterList);
        enseignantFilter.addEventListener('change', filterList);
    }
}

// Event listeners for mobile filter panel
console.log('Setting up event listeners');
console.log('filterToggleBtn:', filterToggleBtn);
console.log('filterCloseBtn:', filterCloseBtn);

if (filterToggleBtn) {
    filterToggleBtn.addEventListener('click', function(e) {
        console.log('Filter button clicked!');
        e.preventDefault();
        e.stopPropagation();
        openFilterPanel();
    });
}

if (filterCloseBtn) filterCloseBtn.addEventListener('click', closeFilterPanel);
if (applyFiltersBtn) applyFiltersBtn.addEventListener('click', applyFilters);
if (filterOverlay) filterOverlay.addEventListener('click', closeFilterPanel);

// Update badge on load
updateFilterBadge();
</script>
@endpush
@endsection

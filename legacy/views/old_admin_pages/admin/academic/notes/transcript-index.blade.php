@extends('admin.layouts.dashboard')

@section('title', __('app.releve_de_notes'))

@section('breadcrumbs')
    <x-breadcrumb>
        <x-breadcrumb-item href="{{ route('admin.dashboard') }}">{{ __('app.tableau_de_bord') }}</x-breadcrumb-item>
        <x-breadcrumb-item active>{{ __('app.releve_de_notes') }}</x-breadcrumb-item>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="transcript-search-container">
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">{{ __('app.releve_de_notes') }}</h1>
            <p class="page-subtitle">{{ __('app.rechercher_etudiant') }}</p>
        </div>

        <!-- Search Interface -->
        <div class="search-wrapper">
            <div class="search-card">
                <form method="GET" action="{{ route('admin.rapports.notes.transcript-index') }}" class="search-form">
                    <div class="search-inputs">
                        <div class="search-field">
                            <input type="text" name="search" class="search-input" value="{{ request('search') }}"
                                placeholder="{{ __('app.rechercher_par_nom_matricule') }}" autocomplete="off"
                                id="studentSearch">
                        </div>
                        <div class="search-field">
                            <x-custom-datalist name="classe" :options="$classes" option-value="id_classe"
                                option-label="nom_classe" placeholder="{{ __('app.toutes_les_classes') }}"
                                :selected="request('classe')" />
                        </div>
                        <button type="submit" class="search-button" aria-label="{{ __('app.rechercher') }}">
                            <i class="fas fa-search search-icon"></i>
                            <span>{{ __('app.rechercher') }}</span>
                        </button>
                    </div>

                    @if(request()->hasAny(['search', 'classe']))
                        <div class="clear-filters">
                            <a href="{{ route('admin.rapports.notes.transcript-index') }}" class="clear-link">
                                {{ __('app.effacer_les_filtres') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Results -->
        @if(request()->filled('search') || request()->filled('classe'))
            <div class="results-container">
                @if($etudiants->count() > 0)
                    <div class="results-header">
                        <span class="results-count">{{ $etudiants->total() }} résultat(s) trouvé(s)</span>
                    </div>

                    <!-- Student Cards -->
                    <div class="student-grid">
                        @foreach($etudiants as $etudiant)
                            <div class="student-card">
                                <div class="student-info">
                                    <a href="{{ route('admin.etudiants.show', $etudiant->matricule) }}" class="student-name">
                                        {{ $etudiant->nom }} {{ $etudiant->prenom }}
                                    </a>
                                    <p class="student-meta">
                                        {{ $etudiant->matricule }}
                                        @if($etudiant->classe)
                                            <span class="meta-separator">•</span> {{ $etudiant->classe->nom_classe }}
                                        @endif
                                    </p>
                                </div>
                                <div class="student-actions">
                                    <a href="{{ route('admin.rapports.notes.transcript.full', $etudiant) }}" class="action-button primary">
                                        {{ __('app.releve_complet') }}
                                    </a>
                                    <div class="dropdown-wrapper">
                                        <button class="action-button secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ __('app.par_trimestre') }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.rapports.notes.transcript', ['etudiant' => $etudiant, 'trimestre' => 1]) }}">{{ __('app.premier_trimestre') }}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.rapports.notes.transcript', ['etudiant' => $etudiant, 'trimestre' => 2]) }}">{{ __('app.deuxieme_trimestre') }}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.rapports.notes.transcript', ['etudiant' => $etudiant, 'trimestre' => 3]) }}">{{ __('app.troisieme_trimestre') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($etudiants->hasPages())
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Affichage de <strong>{{ $etudiants->firstItem() }}</strong> à
                                <strong>{{ $etudiants->lastItem() }}</strong> sur <strong>{{ $etudiants->total() }}</strong> étudiants
                            </div>
                            <nav class="pagination-nav">
                                {{ $etudiants->onEachSide(1)->withQueryString()->links() }}
                            </nav>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-frown empty-icon"></i>
                        <h3 class="empty-title">{{ __('app.aucun_resultat') }}</h3>
                        <p class="empty-text">{{ __('app.aucun_etudiant_correspond') }}</p>
                        <a href="{{ route('admin.rapports.notes.transcript-index') }}" class="empty-action">
                            {{ __('app.nouvelle_recherche') }}
                        </a>
                    </div>
                @endif
            </div>
        @else
            <!-- Welcome State -->
            <div class="welcome-state">
                 <i class="fas fa-search welcome-icon"></i>
                <h2 class="welcome-title">{{ __('app.recherchez_un_etudiant') }}</h2>
                <p class="welcome-text">{{ __('app.utilisez_la_barre_de_recherche') }}</p>

                <!-- Quick Access by Class -->
                @if($classes->count() > 0)
                    <div class="quick-access">
                        <h3 class="quick-access-title">{{ __('app.acces_rapide_par_classe') }}</h3>
                        <div class="class-grid">
                            @foreach($classes->take(6) as $classe)
                                <a href="{{ route('admin.rapports.notes.transcript-index', ['classe' => $classe->id_classe]) }}"
                                    class="class-chip">
                                    {{ $classe->nom_classe }}
                                </a>
                            @endforeach
                        </div>
                        @if($classes->count() > 6)
                            <p class="more-classes">+ {{ $classes->count() - 6 }} {{ __('app.autres_classes') }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>

    <style>
        /* Page-Specific Styles */
        .transcript-search-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 400;
            color: var(--text-primary);
            margin: 0 0 var(--spacing-xs);
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            font-size: clamp(0.875rem, 2vw, 1rem);
            color: var(--text-secondary);
            margin: 0;
        }

        /* Search Card */
        .search-wrapper {
            max-width: 800px;
            margin: 0 auto var(--spacing-xl);
        }

        .search-card {
            background: var(--bg-surface);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            padding: var(--spacing-lg);
            transition: box-shadow 0.2s ease;
        }

        .search-card:focus-within {
            box-shadow: var(--shadow-md);
        }

        .search-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }

        .search-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: var(--spacing-sm);
        }

        .search-field {
            position: relative;
        }

        .search-input,
        .search-select {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: var(--bg-surface);
            color: var(--text-primary);
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .search-input:focus,
        .search-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
        }

        .search-button {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .search-button:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        .search-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .clear-filters {
            text-align: center;
        }

        .clear-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }

        .clear-link:hover {
            color: var(--primary-color);
        }

        /* Results */
        .results-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .results-header {
            margin-bottom: var(--spacing-md);
        }

        .results-count {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Student Grid */
        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .student-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: var(--spacing-lg);
            transition: all 0.2s ease;
        }

        .student-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--primary-color);
        }

        .student-info {
            margin-bottom: var(--spacing-md);
        }

        .student-name {
            display: block;
            font-size: 1.125rem;
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
            margin-bottom: var(--spacing-xs);
            transition: color 0.2s ease;
        }

        .student-name:hover {
            color: var(--primary-color);
        }

        .student-meta {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .meta-separator {
            margin: 0 0.25rem;
        }

        .student-actions {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius-sm);
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .action-button.primary {
            background: var(--primary-color);
            color: white;
        }

        .action-button.primary:hover {
            background: var(--primary-hover);
        }

        .action-button.secondary {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .action-button.secondary:hover {
            background: var(--bg-hover);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-md);
            margin-top: var(--spacing-xl);
            padding-top: var(--spacing-lg);
            border-top: 1px solid var(--border-color);
        }

        .pagination-info {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Empty State */
        .empty-state,
        .welcome-state {
            text-align: center;
            padding: var(--spacing-xl) var(--spacing-md);
        }

        .empty-title,
        .welcome-title {
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--text-primary);
            margin: 0 0 var(--spacing-sm);
        }

        .empty-text,
        .welcome-text {
            font-size: 1rem;
            color: var(--text-secondary);
            margin: 0 0 var(--spacing-lg);
        }

        .empty-action {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .empty-action:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        /* Quick Access */
        .quick-access {
            max-width: 600px;
            margin: var(--spacing-xl) auto 0;
        }

        .quick-access-title {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-primary);
            margin: 0 0 var(--spacing-md);
        }

        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: var(--spacing-sm);
        }

        .class-chip {
            padding: 0.625rem 1rem;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            text-decoration: none;
            text-align: center;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .class-chip:hover {
            background: var(--bg-hover);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .more-classes {
            margin-top: var(--spacing-sm);
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .transcript-search-container {
                padding: var(--spacing-md) var(--spacing-sm);
            }

            .page-title {
                font-size: 1.75rem;
            }

            .page-subtitle {
                font-size: 0.875rem;
            }

            .search-inputs {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .search-button {
                width: 100%;
                justify-content: center;
            }

            .search-button span {
                display: inline;
            }

            .student-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .student-card {
                padding: var(--spacing-md);
            }

            .student-actions {
                flex-direction: column;
                gap: var(--spacing-xs);
            }

            .action-button {
                width: 100%;
                justify-content: center;
            }

            .dropdown-wrapper {
                width: 100%;
            }

            .dropdown-wrapper .action-button {
                width: 100%;
            }

            .class-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-xs);
            }

            .class-chip {
                padding: 0.5rem 0.75rem;
                font-size: 0.8125rem;
            }

            .pagination-wrapper {
                flex-direction: column;
                gap: var(--spacing-sm);
            }

            .pagination-info {
                text-align: center;
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.8125rem;
            }

            .search-card {
                padding: var(--spacing-md);
            }

            .search-input,
            .search-select {
                padding: 0.625rem 0.875rem;
                font-size: 0.875rem;
            }

            .search-button {
                padding: 0.625rem 1rem;
                font-size: 0.875rem;
            }

            .student-card {
                padding: var(--spacing-sm);
            }

            .student-name {
                font-size: 1rem;
            }

            .student-meta {
                font-size: 0.8125rem;
            }

            .action-button {
                padding: 0.5rem 0.875rem;
                font-size: 0.8125rem;
            }

            .results-count {
                font-size: 0.8125rem;
            }

            .class-grid {
                grid-template-columns: 1fr;
            }

            .welcome-icon,
            .empty-icon {
                width: 3rem;
                height: 3rem;
            }

            .welcome-title,
            .empty-title {
                font-size: 1.25rem;
            }

            .welcome-text,
            .empty-text {
                font-size: 0.875rem;
            }

            .quick-access-title {
                font-size: 0.875rem;
            }

            .more-classes {
                font-size: 0.8125rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('studentSearch');
            const form = searchInput.closest('form');
        const submitBtn = form.querySelector('.search-button');

        // Submit form on Enter key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });

        // Focus search on page load if no results
        @if(!request()->hasAny(['search', 'classe']))
            searchInput.focus();
        @endif

        // Keyboard shortcut: Ctrl/Cmd + K to focus search
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
                searchInput.select();
            }

            // Escape to clear search
            if (e.key === 'Escape' && document.activeElement === searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
        });

        // Add loading state to search button
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<svg class="icon icon-md animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="2" stroke-opacity="0.75" stroke-linecap="round"/></svg><span>Recherche...</span>';

            // Re-enable after 3 seconds as fallback
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }, 3000);
        });
    });
    </script>

        @push('styles')
            <style>
                /* Clean pagination styling */
                .pagination {
                    display: flex;
                    gap: 0.25rem;
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }

                .pagination .page-link {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-width: 2.5rem;
                    height: 2.5rem;
                    padding: 0.5rem;
                    border: 1px solid var(--border-color);
                    color: var(--text-primary);
                    border-radius: var(--radius-sm);
                    text-decoration: none;
                    transition: all 0.2s;
                    font-size: 0.875rem;
                }

                .pagination .page-link:hover {
                    background-color: var(--bg-hover);
                    border-color: var(--primary-color);
                    color: var(--primary-color);
                }

                .pagination .page-item.active .page-link {
                    background-color: var(--primary-color);
                    border-color: var(--primary-color);
                    color: white;
                    font-weight: 500;
                }

                .pagination .page-item.disabled .page-link {
                    background-color: var(--bg-hover);
                    border-color: var(--border-color);
                    color: var(--text-tertiary);
                    cursor: not-allowed;
                }

                @keyframes spin {
                    to {
                        transform: rotate(360deg);
                    }
                }

                .animate-spin {
                    animation: spin 1s linear infinite;
                }
            </style>
        @endpush
@endsection
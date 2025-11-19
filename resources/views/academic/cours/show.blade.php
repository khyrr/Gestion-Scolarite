@extends('layouts.dashboard')

@section('title', $cours->nom_cours)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ $cours->nom_cours }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('cours.edit', $cours) }}" class="btn btn-warning">
                {{ __('app.modifier') }}
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                {{ __('app.supprimer') }}
            </button>
        @endadmin
    </div>
@endsection

@section('content')
<div class="google-container">
    <!-- Page Header -->
    <div class="google-page-header">
        <div>
            <h1 class="google-page-title">{{ $cours->nom_cours }}</h1>
            <div class="google-page-meta">
                <span class="google-meta-badge">{{ ucfirst($cours->jour) }}</span>
                @if($cours->date_debut && $cours->date_fin)
                    <span class="google-meta-text">{{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}</span>
                @endif
            </div>
        </div>
        <div class="google-header-actions">
            <a href="{{ route('cours.index') }}" class="google-btn google-btn-text">
                {{ __('app.retour') }}
            </a>
            @admin
                <a href="{{ route('cours.edit', $cours) }}" class="google-btn google-btn-text">
                    {{ __('app.modifier') }}
                </a>
                <button type="button" class="google-btn google-btn-text" data-bs-toggle="modal" data-bs-target="#deleteModal" style="color: #d93025;">
                    {{ __('app.supprimer') }}
                </button>
            @endadmin
        </div>
    </div>

    <div class="google-layout">
        <!-- Course Details -->
        <div class="google-sidebar">
            <div class="google-detail-card">
                <div class="google-section-title">{{ __('app.details_cours') }}</div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.matiere') }}</div>
                    <div class="google-detail-value">{{ $cours->matiere->nom_matiere ?? 'N/A' }}</div>
                </div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.classe') }}</div>
                    <div class="google-detail-value">{{ $cours->classe->nom_classe ?? 'N/A' }}</div>
                </div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.enseignant') }}</div>
                    <div class="google-detail-value">{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</div>
                </div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.horaire') }}</div>
                    <div class="google-detail-value">
                        @if($cours->date_debut && $cours->date_fin)
                            {{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.duree') }}</div>
                    <div class="google-detail-value">
                        @if($cours->date_debut && $cours->date_fin)
                            {{ \Carbon\Carbon::parse($cours->date_debut)->diffInMinutes(\Carbon\Carbon::parse($cours->date_fin)) }} {{ __('app.minutes') }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                
                <div class="google-detail-item">
                    <div class="google-detail-label">{{ __('app.salle') }}</div>
                    <div class="google-detail-value">{{ $cours->salle ?? 'N/A' }}</div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="google-quick-links">
                <div class="google-section-title">{{ __('app.liens_rapides') }}</div>
                <div class="google-links-list">
                    @if($cours->classe)
                        <a href="{{ route('classes.show', $cours->classe) }}" class="google-link-item">
                            {{ __('app.voir_classe') }}
                        </a>
                    @endif
                    @if($cours->enseignant)
                        <a href="{{ route('enseignants.show', $cours->enseignant) }}" class="google-link-item">
                            {{ __('app.voir_enseignant') }}
                        </a>
                    @endif
                    <a href="{{ route('cours.spectacle') }}?classe={{ $cours->id_classe }}" class="google-link-item">
                        {{ __('app.voir_emploi_temps') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Description & Summary -->
        <div class="google-main">
            <div class="google-content-card">
                <div class="google-section-title">{{ __('app.description') }}</div>
                
                @if($cours->description)
                    <p class="google-description-text">{{ $cours->description }}</p>
                @else
                    <div class="google-empty-state">
                        <svg class="google-empty-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p class="google-empty-text">{{ __('app.aucune_description') }}</p>
                    </div>
                @endif
            </div>

            <!-- Course Information Summary -->
            <div class="google-content-card">
                <div class="google-section-title">{{ __('app.resume') }}</div>
                
                <div class="google-summary-grid">
                    <div class="google-summary-item">
                        <div class="google-summary-label">{{ __('app.matiere') }}</div>
                        <div class="google-summary-value">{{ $cours->matiere->nom_matiere ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="google-summary-item">
                        <div class="google-summary-label">{{ __('app.classe') }}</div>
                        <div class="google-summary-value">{{ $cours->classe->nom_classe ?? 'N/A' }}</div>
                        <div class="google-summary-meta">{{ $cours->classe->etudiants->count() ?? 0 }} {{ __('app.etudiants') }}</div>
                    </div>
                    
                    <div class="google-summary-item">
                        <div class="google-summary-label">{{ __('app.enseignant') }}</div>
                        <div class="google-summary-value">{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</div>
                    </div>
                    
                    <div class="google-summary-item">
                        <div class="google-summary-label">{{ __('app.planning') }}</div>
                        <div class="google-summary-value text-capitalize">{{ $cours->jour }}</div>
                        <div class="google-summary-meta">
                            @if($cours->date_debut && $cours->date_fin)
                                {{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
    --google-gray-400: #bdc1c6;
    --google-gray-500: #9aa0a6;
    --google-gray-600: #80868b;
    --google-gray-700: #5f6368;
    --google-gray-800: #3c4043;
    --google-gray-900: #202124;
    --google-spacing-xs: 4px;
    --google-spacing-sm: 8px;
    --google-spacing-md: 16px;
    --google-spacing-lg: 24px;
    --google-spacing-xl: 32px;
    --google-spacing-2xl: 48px;
    --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
    --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
}

/* Container */
.google-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--google-spacing-lg);
}

/* Page Header */
.google-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--google-spacing-xl);
}

.google-page-title {
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-sm) 0;
}

.google-page-meta {
    display: flex;
    gap: var(--google-spacing-md);
    align-items: center;
}

.google-meta-badge {
    display: inline-flex;
    padding: 4px 12px;
    background: var(--google-gray-100);
    color: var(--google-gray-700);
    border-radius: 16px;
    font-size: 0.875rem;
    font-weight: 400;
}

.google-meta-text {
    font-size: 0.875rem;
    color: var(--google-gray-600);
}

.google-header-actions {
    display: flex;
    gap: var(--google-spacing-sm);
}

/* Layout */
.google-layout {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: var(--google-spacing-xl);
}

/* Sidebar */
.google-sidebar {
    display: flex;
    flex-direction: column;
    gap: var(--google-spacing-lg);
}

/* Detail Card */
.google-detail-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-lg);
}

.google-section-title {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--google-gray-900);
    margin-bottom: var(--google-spacing-md);
}

.google-detail-item {
    padding: var(--google-spacing-md) 0;
    border-bottom: 1px solid var(--google-gray-200);
}

.google-detail-item:last-child {
    border-bottom: none;
}

.google-detail-label {
    font-size: 0.75rem;
    color: var(--google-gray-600);
    margin-bottom: var(--google-spacing-xs);
}

.google-detail-value {
    font-size: 0.875rem;
    color: var(--google-gray-900);
}

/* Quick Links */
.google-quick-links {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-lg);
}

.google-links-list {
    display: flex;
    flex-direction: column;
    gap: var(--google-spacing-xs);
}

.google-link-item {
    display: block;
    padding: var(--google-spacing-sm) var(--google-spacing-md);
    color: var(--google-blue);
    text-decoration: none;
    font-size: 0.875rem;
    border-radius: 4px;
    transition: var(--google-transition);
}

.google-link-item:hover {
    background: var(--google-gray-100);
    color: var(--google-blue-hover);
}

/* Main Content */
.google-main {
    display: flex;
    flex-direction: column;
    gap: var(--google-spacing-lg);
}

.google-content-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-xl);
}

.google-description-text {
    font-size: 0.875rem;
    line-height: 1.6;
    color: var(--google-gray-700);
    margin: 0;
}

.google-empty-state {
    text-align: center;
    padding: var(--google-spacing-2xl) var(--google-spacing-lg);
}

.google-empty-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto var(--google-spacing-md);
    color: var(--google-gray-400);
}

.google-empty-text {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0;
}

/* Summary Grid */
.google-summary-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--google-spacing-xl);
}

.google-summary-item {
    padding: var(--google-spacing-lg);
    background: var(--google-gray-50);
    border-radius: 8px;
}

.google-summary-label {
    font-size: 0.75rem;
    color: var(--google-gray-600);
    margin-bottom: var(--google-spacing-xs);
}

.google-summary-value {
    font-size: 1rem;
    font-weight: 500;
    color: var(--google-gray-900);
    margin-bottom: var(--google-spacing-xs);
}

.google-summary-meta {
    font-size: 0.75rem;
    color: var(--google-gray-600);
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

/* Responsive */
@media (max-width: 768px) {
    .google-layout {
        grid-template-columns: 1fr;
    }

    .google-page-header {
        flex-direction: column;
        gap: var(--google-spacing-md);
    }

    .google-header-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .google-summary-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .google-container {
        padding: var(--google-spacing-md);
    }

    .google-content-card {
        padding: var(--google-spacing-lg);
    }

    .google-page-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--google-spacing-sm);
    }
}
</style>
@endpush

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('app.confirmer_suppression') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression_cours') }}
                </div>
                <p>{{ __('app.cours') }}: <strong>{{ $cours->nom_cours }}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.annuler') }}</button>
                <form action="{{ route('cours.destroy', $cours) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('app.supprimer') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

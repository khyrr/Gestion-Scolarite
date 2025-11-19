@extends('layouts.dashboard')

@section('title', __('app.voir_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.voir') }} - {{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    @admin
        <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="google-container">
    <div class="google-profile-wrapper">
        <!-- Profile Summary -->
        <div class="google-profile-sidebar">
            <div class="google-profile-card">
                <div class="google-profile-header">
                    <div class="google-profile-avatar">
                        {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                    </div>
                    <h2 class="google-profile-name">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h2>
                    <p class="google-profile-role">{{ __('app.etudiant') }}</p>
                    <div class="google-matricule-badge">{{ $etudiant->matricule }}</div>
                </div>

                <div class="google-profile-stats">
                    <div class="google-stat-item">
                        <div class="google-stat-label">{{ __('app.classe') }}</div>
                        <div class="google-stat-value">{{ $etudiant->classe?->nom_classe ?? 'N/A' }}</div>
                    </div>
                    <div class="google-stat-divider"></div>
                    <div class="google-stat-item">
                        <div class="google-stat-label">{{ __('app.genre') }}</div>
                        <div class="google-stat-value">{{ __('app.' . $etudiant->genre) ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="google-profile-main">
            <div class="google-info-card">
                <h3 class="google-section-title">{{ __('app.informations_generales') }}</h3>
                
                <div class="google-info-grid">
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.nom_complet') }}</div>
                        <div class="google-info-value">{{ $etudiant->prenom }} {{ $etudiant->nom }}</div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.matricule') }}</div>
                        <div class="google-info-value">{{ $etudiant->matricule }}</div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.email') }}</div>
                        <div class="google-info-value">
                            @if($etudiant->email)
                                <a href="mailto:{{ $etudiant->email }}" class="google-link">{{ $etudiant->email }}</a>
                            @else
                                <span class="google-text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.telephone') }}</div>
                        <div class="google-info-value">
                            @if($etudiant->telephone)
                                <a href="tel:{{ $etudiant->telephone }}" class="google-link">{{ $etudiant->telephone }}</a>
                            @else
                                <span class="google-text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.date_naissance') }}</div>
                        <div class="google-info-value">
                            @if($etudiant->date_naissance)
                                {{ \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') }}
                            @else
                                <span class="google-text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.date_inscription') }}</div>
                        <div class="google-info-value">{{ $etudiant->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    
                    <div class="google-info-item google-full-width">
                        <div class="google-info-label">{{ __('app.adresse') }}</div>
                        <div class="google-info-value">
                            @if($etudiant->adresse)
                                {{ $etudiant->adresse }}
                            @else
                                <span class="google-text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Info Card -->
            <div class="google-info-card">
                <h3 class="google-section-title">{{ __('app.informations_academiques') }}</h3>
                
                <div class="google-academic-stats">
                    <div class="google-academic-stat">
                        <div class="google-academic-label">{{ __('app.classe') }}</div>
                        <div class="google-academic-value">{{ $etudiant->classe?->nom_classe ?? 'Non assigné' }}</div>
                    </div>
                    
                    <div class="google-academic-stat">
                        <div class="google-academic-label">{{ __('app.evaluations') }}</div>
                        <div class="google-academic-value">0</div>
                    </div>
                    
                    <div class="google-academic-stat">
                        <div class="google-academic-label">{{ __('app.moyenne_generale') }}</div>
                        <div class="google-academic-value">-</div>
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

    .google-profile-wrapper {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: var(--google-spacing-lg);
        padding: var(--google-spacing-lg);
    }

    /* Profile Sidebar */
    .google-profile-sidebar {
        display: flex;
        flex-direction: column;
    }

    .google-profile-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-xl);
    }

    .google-profile-header {
        text-align: center;
    }

    .google-profile-avatar {
        width: 96px;
        height: 96px;
        background: var(--google-blue);
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: var(--google-spacing-md);
    }

    .google-profile-name {
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-xs) 0;
    }

    .google-profile-role {
        font-size: 0.875rem;
        color: var(--google-gray-600);
        margin: 0 0 var(--google-spacing-md) 0;
    }

    .google-matricule-badge {
        display: inline-block;
        padding: 4px 12px;
        background: var(--google-gray-100);
        color: var(--google-gray-700);
        border-radius: 16px;
        font-size: 0.75rem;
        font-family: monospace;
    }

    .google-profile-stats {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: var(--google-spacing-md);
        margin-top: var(--google-spacing-lg);
        padding-top: var(--google-spacing-lg);
        border-top: 1px solid var(--google-gray-300);
    }

    .google-stat-item {
        text-align: center;
    }

    .google-stat-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-xs);
    }

    .google-stat-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--google-gray-900);
    }

    .google-stat-divider {
        width: 1px;
        background: var(--google-gray-300);
    }

    /* Profile Main */
    .google-profile-main {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-lg);
    }

    .google-info-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-xl);
    }

    .google-section-title {
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-lg) 0;
    }

    .google-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--google-spacing-lg);
    }

    .google-info-item {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-xs);
    }

    .google-info-item.google-full-width {
        grid-column: 1 / -1;
    }

    .google-info-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
    }

    .google-info-value {
        font-size: 0.875rem;
        color: var(--google-gray-900);
    }

    .google-link {
        color: var(--google-blue);
        text-decoration: none;
    }

    .google-link:hover {
        color: var(--google-blue-hover);
        text-decoration: underline;
    }

    .google-text-na {
        color: var(--google-gray-500);
        font-style: italic;
    }

    /* Academic Stats */
    .google-academic-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--google-spacing-lg);
    }

    .google-academic-stat {
        text-align: center;
        padding: var(--google-spacing-lg);
        background: var(--google-gray-50);
        border-radius: 4px;
    }

    .google-academic-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-xs);
    }

    .google-academic-value {
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--google-gray-900);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .google-profile-wrapper {
            grid-template-columns: 280px 1fr;
        }
    }

    @media (max-width: 768px) {
        .google-profile-wrapper {
            grid-template-columns: 1fr;
            padding: var(--google-spacing-md);
        }

        .google-info-grid {
            grid-template-columns: 1fr;
        }

        .google-academic-stats {
            grid-template-columns: 1fr;
        }

        .google-profile-stats {
            grid-template-columns: 1fr;
        }

        .google-stat-divider {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .google-profile-wrapper {
            padding: var(--google-spacing-sm);
        }

        .google-profile-card,
        .google-info-card {
            padding: var(--google-spacing-lg);
        }

        .google-profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 1.75rem;
        }

        .google-profile-name {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

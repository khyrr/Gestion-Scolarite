@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.voir') }} - {{ $enseignants->prenom }} {{ $enseignants->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    @admin
        <a href="{{ route('enseignants.edit', $enseignants->id_enseignant) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="google-container">
    <div class="google-detail-wrapper">
        <!-- Profile Summary -->
        <div class="google-detail-sidebar">
            <div class="google-profile-card">
                <div class="google-profile-header">
                    <div class="google-profile-avatar">
                        {{ substr($enseignants->prenom, 0, 1) }}{{ substr($enseignants->nom, 0, 1) }}
                    </div>
                    <h4 class="google-profile-name">{{ $enseignants->prenom }} {{ $enseignants->nom }}</h4>
                    <!-- <p class="google-profile-role">
                        @if($enseignants->matieres && $enseignants->matieres->count() > 0)
                            {{ __('app.' . $enseignants->matieres->pluck('code_matiere')->join(', app.')) }}
                        @else
                            {{ __('app.aucune_matiere') }}
                        @endif
                    </p> -->
                    <span class="google-role-badge">{{ __('app.enseignant') }}</span>
                </div>

                <div class="google-profile-stats">
                    <div class="google-stat-item">
                        <div class="google-stat-label">{{ __('app.id_enseignant') }}</div>
                        <div class="google-stat-value">{{ $enseignants->id_enseignant }}</div>
                    </div>
                    <div class="google-stat-item">
                        <div class="google-stat-label">{{ __('app.classes_assignees') }}</div>
                        <div class="google-stat-value">
                            @if($enseignants->classes && $enseignants->classes->count() > 0)
                                {{ $enseignants->classes->count() }}
                            @else
                                0
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="google-detail-main">
            <div class="google-info-card">
                <h5 class="google-section-title">{{ __('app.informations_personnelles') }}</h5>
                
                <div class="google-info-grid">
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.nom_complet') }}</div>
                        <div class="google-info-value">{{ $enseignants->prenom }} {{ $enseignants->nom }}</div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.email') }}</div>
                        <div class="google-info-value">
                            <a href="mailto:{{ $enseignants->email }}" class="google-link">
                                {{ $enseignants->email }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.telephone') }}</div>
                        <div class="google-info-value">
                            <a href="tel:{{ $enseignants->telephone }}" class="google-link">
                                {{ $enseignants->telephone }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.matieres_enseignees') }}</div>
                        <div class="google-info-value">
                            @if($enseignants->matieres && $enseignants->matieres->count() > 0)
                                @foreach($enseignants->matieres as $matiere)
                                    <span class="google-badge google-badge-blue">{{ __('app.' . $matiere->code_matiere) }}</span>
                                @endforeach
                            @else
                                <span class="google-text-na">{{ __('app.aucune_matiere') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.classes_assignees') }}</div>
                        <div class="google-info-value">
                            @if($enseignants->classes && $enseignants->classes->count() > 0)
                                @foreach($enseignants->classes as $classe)
                                    <span class="google-badge google-badge-neutral">{{ $classe->nom_classe }}</span>
                                @endforeach
                            @else
                                <span class="google-text-na">{{ __('app.aucune_classe_assignee') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="google-info-item">
                        <div class="google-info-label">{{ __('app.date_ajout') }}</div>
                        <div class="google-info-value">{{ $enseignants->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Activity Card -->
            <div class="google-activity-card">
                <h5 class="google-section-title">{{ __('app.activite_pedagogique') }}</h5>
                
                <div class="google-activity-stats">
                    <div class="google-activity-stat">
                        <div class="google-activity-label">{{ __('app.cours_dispenses') }}</div>
                        <div class="google-activity-value">0</div>
                    </div>
                    
                    <div class="google-activity-stat">
                        <div class="google-activity-label">{{ __('app.evaluations_creees') }}</div>
                        <div class="google-activity-value">0</div>
                    </div>
                    
                    <div class="google-activity-stat">
                        <div class="google-activity-label">{{ __('app.classes') }}</div>
                        <div class="google-activity-value">{{ $enseignants->classes ? $enseignants->classes->count() : 0 }}</div>
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
    --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
}

.google-container {
    max-width: 100%;
    margin: 0;
    padding: 0;
}

.google-detail-wrapper {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: var(--google-spacing-lg);
    padding: var(--google-spacing-lg);
}

.google-detail-sidebar {
    display: flex;
    flex-direction: column;
    gap: var(--google-spacing-lg);
}

.google-detail-main {
    display: flex;
    flex-direction: column;
    gap: var(--google-spacing-lg);
}

/* Profile Card */
.google-profile-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-lg);
}

.google-profile-header {
    text-align: center;
    margin-bottom: var(--google-spacing-lg);
}

.google-profile-avatar {
    width: 80px;
    height: 80px;
    background: var(--google-blue);
    color: white;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 500;
    margin-bottom: var(--google-spacing-md);
}

.google-profile-name {
    font-size: 1.25rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-xs) 0;
}

.google-profile-role {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0 0 var(--google-spacing-md) 0;
}

.google-role-badge {
    display: inline-block;
    padding: 4px 12px;
    background: #e8f0fe;
    color: var(--google-blue);
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
}

.google-profile-stats {
    display: flex;
    flex-direction: column;
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
    font-size: 1rem;
    font-weight: 500;
    color: var(--google-gray-900);
}

/* Info Card */
.google-info-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-lg);
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

.google-info-label {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--google-gray-600);
}

.google-info-value {
    font-size: 0.875rem;
    color: var(--google-gray-900);
}

.google-link {
    color: var(--google-blue);
    text-decoration: none;
    transition: var(--google-transition);
}

.google-link:hover {
    color: var(--google-blue-hover);
    text-decoration: underline;
}

.google-badge {
    display: inline-block;
    padding: 4px 12px;
    font-size: 0.75rem;
    border-radius: 16px;
    font-weight: 500;
    margin: 2px;
}

.google-badge-blue {
    background: #e8f0fe;
    color: #1a73e8;
}

.google-badge-neutral {
    background: var(--google-gray-100);
    color: var(--google-gray-700);
}

.google-text-na {
    color: var(--google-gray-500);
    font-style: italic;
}

/* Activity Card */
.google-activity-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-lg);
}

.google-activity-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--google-spacing-md);
}

.google-activity-stat {
    text-align: center;
    padding: var(--google-spacing-md);
    background: var(--google-gray-50);
    border-radius: 4px;
}

.google-activity-label {
    font-size: 0.75rem;
    color: var(--google-gray-600);
    margin-bottom: var(--google-spacing-xs);
}

.google-activity-value {
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--google-gray-900);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .google-detail-wrapper {
        grid-template-columns: 280px 1fr;
        padding: var(--google-spacing-md);
    }
}

@media (max-width: 768px) {
    .google-detail-wrapper {
        grid-template-columns: 1fr;
        padding: var(--google-spacing-md);
    }

    .google-info-grid {
        grid-template-columns: 1fr;
    }

    .google-activity-stats {
        grid-template-columns: repeat(3, 1fr);
    }

    .google-profile-card,
    .google-info-card,
    .google-activity-card {
        padding: var(--google-spacing-md);
    }

    .google-profile-avatar {
        width: 64px;
        height: 64px;
        font-size: 1.5rem;
    }

    .google-profile-name {
        font-size: 1.125rem;
    }
}

@media (max-width: 480px) {
    .google-detail-wrapper {
        padding: var(--google-spacing-sm);
    }

    .google-profile-card,
    .google-info-card,
    .google-activity-card {
        padding: var(--google-spacing-sm);
    }

    .google-profile-avatar {
        width: 56px;
        height: 56px;
        font-size: 1.25rem;
    }

    .google-section-title {
        font-size: 1rem;
    }

    .google-activity-stats {
        gap: var(--google-spacing-sm);
    }

    .google-activity-stat {
        padding: var(--google-spacing-sm);
    }

    .google-activity-label {
        font-size: 0.625rem;
    }

    .google-activity-value {
        font-size: 1.125rem;
    }
}
</style>
@endpush

@extends('admin.layouts.dashboard')

@section('title', __('app.voir_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.voir') }} - {{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    @admin
        <a href="{{ route('admin.etudiants.edit', $etudiant) }}" class="btn btn-primary">
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


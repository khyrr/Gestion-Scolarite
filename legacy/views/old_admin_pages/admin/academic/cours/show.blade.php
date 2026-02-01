@extends('admin.layouts.dashboard')

@section('title', $cours->nom_cours)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ $cours->nom_cours }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.cours.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.retour') }}</span>
        </a>
        @admin
            <a href="{{ route('admin.cours.edit', $cours) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                <span class="d-none d-lg-inline ms-2">{{ __('app.modifier') }}</span>
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash"></i>
                <span class="d-none d-lg-inline ms-2">{{ __('app.supprimer') }}</span>
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
            <a href="{{ route('admin.cours.index') }}" class="google-btn google-btn-text">
                {{ __('app.retour') }}
            </a>
            @admin
                <a href="{{ route('admin.cours.edit', $cours) }}" class="google-btn google-btn-text">
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
                        <a href="{{ route('admin.classes.show', $cours->classe) }}" class="google-link-item">
                            {{ __('app.voir_classe') }}
                        </a>
                    @endif
                    @if($cours->enseignant)
                        <a href="{{ route('admin.enseignants.show', $cours->enseignant) }}" class="google-link-item">
                            {{ __('app.voir_enseignant') }}
                        </a>
                    @endif
                    <a href="{{ route('admin.cours.spectacle') }}?classe={{ $cours->id_classe }}" class="google-link-item">
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
                        <i class="fas fa-info-circle google-empty-icon" aria-hidden="true"></i>
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
                <form action="{{ route('admin.cours.destroy', $cours) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('app.supprimer') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

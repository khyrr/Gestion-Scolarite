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
    <div class="row">
        <!-- Course Details -->
        <div class="col-lg-4">
            <div class="detail-card">
                <div class="detail-header">
                    <div class="detail-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h5 class="detail-title">{{ __('app.details_cours') }}</h5>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.nom_cours') }}</div>
                    <div class="detail-value">{{ $cours->nom_cours }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.matiere') }}</div>
                    <div class="detail-value">{{ $cours->matiere->nom_matiere ?? 'N/A' }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.classe') }}</div>
                    <div class="detail-value">{{ $cours->classe->nom_classe ?? 'N/A' }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.enseignant') }}</div>
                    <div class="detail-value">{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.jour') }}</div>
                    <div class="detail-value"><span class="day-badge">{{ ucfirst($cours->jour) }}</span></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.horaire') }}</div>
                    <div class="detail-value time-range">
                        @if($cours->date_debut && $cours->date_fin)
                            <span class="time-start">{{ \Carbon\Carbon::parse($cours->date_debut)->format('H:i') }}</span>
                            <span class="time-separator">→</span>
                            <span class="time-end">{{ \Carbon\Carbon::parse($cours->date_fin)->format('H:i') }}</span>
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.duree') }}</div>
                    <div class="detail-value">
                        @if($cours->date_debut && $cours->date_fin)
                            <span class="duration-badge">{{ \Carbon\Carbon::parse($cours->date_debut)->diffInMinutes(\Carbon\Carbon::parse($cours->date_fin)) }} {{ __('app.minutes') }}</span>
                        @else
                            N/A
                        @endif
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">{{ __('app.salle') }}</div>
                    <div class="detail-value">{{ $cours->salle ?? 'N/A' }}</div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="quick-links-card">
                <h6 class="quick-links-title">{{ __('app.liens_rapides') }}</h6>
                <div class="quick-links-grid">
                    @if($cours->classe)
                        <a href="{{ route('classes.show', $cours->classe) }}" class="quick-link">
                            <i class="fas fa-users"></i>
                            <span>{{ __('app.voir_classe') }}</span>
                        </a>
                    @endif
                    @if($cours->enseignant)
                        <a href="{{ route('enseignants.show', $cours->enseignant) }}" class="quick-link">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>{{ __('app.voir_enseignant') }}</span>
                        </a>
                    @endif
                    <a href="{{ route('cours.spectacle') }}?classe={{ $cours->id_classe }}" class="quick-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('app.voir_emploi_temps') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Description & Summary -->
        <div class="col-lg-8">
            <div class="description-card">
                <div class="card-header-section">
                    <h5 class="card-title">{{ __('app.description') }}</h5>
                </div>
                
                @if($cours->description)
                    <p class="description-text">{{ $cours->description }}</p>
                @else
                    <div class="empty-description">
                        <div class="empty-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <p class="empty-text">{{ __('app.aucune_description') }}</p>
                    </div>
                @endif
            </div>

            <!-- Course Information Summary -->
            <div class="summary-card">
                <div class="card-header-section">
                    <h5 class="card-title">{{ __('app.resume') }}</h5>
                </div>
                
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="summary-content">
                            <div class="summary-label">{{ __('app.matiere') }}</div>
                            <div class="summary-value">{{ $cours->matiere->nom_matiere ?? 'N/A' }}</div>
                        </div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-icon" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="summary-content">
                            <div class="summary-label">{{ __('app.classe') }}</div>
                            <div class="summary-value">{{ $cours->classe->nom_classe ?? 'N/A' }}</div>
                            <div class="summary-meta">{{ $cours->classe->etudiants->count() ?? 0 }} {{ __('app.etudiants') }}</div>
                        </div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-icon" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="summary-content">
                            <div class="summary-label">{{ __('app.enseignant') }}</div>
                            <div class="summary-value">{{ $cours->enseignant->prenom ?? '' }} {{ $cours->enseignant->nom ?? 'Non assigné' }}</div>
                        </div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-icon" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="summary-content">
                            <div class="summary-label">{{ __('app.planning') }}</div>
                            <div class="summary-value text-capitalize">{{ $cours->jour }}</div>
                            <div class="summary-meta">
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
    --md-primary: #0d6efd;
    --md-gray-50: #fafafa;
    --md-gray-100: #f5f5f5;
    --md-gray-200: #eeeeee;
    --md-gray-300: #e0e0e0;
    --md-gray-400: #bdbdbd;
    --md-gray-500: #9e9e9e;
    --md-gray-600: #757575;
    --md-gray-700: #616161;
    --md-gray-800: #424242;
    --md-gray-900: #212529;
    --md-radius: 12px;
    --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
    --md-shadow-lg: 0 8px 16px rgba(0,0,0,0.12);
}

/* Detail Card */
.detail-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 28px;
    box-shadow: var(--md-shadow);
    margin-bottom: 24px;
}

.detail-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--md-gray-200);
}

.detail-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.detail-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.detail-item {
    padding: 16px 0;
    border-bottom: 1px solid var(--md-gray-200);
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--md-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.detail-value {
    font-size: 14px;
    font-weight: 500;
    color: var(--md-gray-900);
}

.time-range {
    display: flex;
    align-items: center;
    gap: 8px;
}

.time-start {
    color: #198754;
    font-weight: 600;
}

.time-separator {
    color: var(--md-gray-400);
}

.time-end {
    color: #dc3545;
    font-weight: 600;
}

.day-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: rgba(108, 117, 125, 0.1);
    color: var(--md-gray-700);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

.duration-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: rgba(13, 110, 253, 0.1);
    color: var(--md-primary);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

/* Quick Links Card */
.quick-links-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 24px;
    box-shadow: var(--md-shadow);
}

.quick-links-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quick-links-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: var(--md-gray-50);
    border-radius: 8px;
    text-decoration: none;
    color: var(--md-gray-800);
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s;
}

.quick-link:hover {
    background: var(--md-primary);
    color: white;
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
}

.quick-link i {
    font-size: 16px;
}

/* Description Card */
.description-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
    margin-bottom: 24px;
}

.card-header-section {
    margin-bottom: 20px;
}

.card-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.description-text {
    font-size: 14px;
    line-height: 1.8;
    color: var(--md-gray-700);
}

.empty-description {
    text-align: center;
    padding: 48px 24px;
}

.empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 16px;
    background: var(--md-gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-icon i {
    font-size: 24px;
    color: var(--md-gray-400);
}

.empty-text {
    font-size: 14px;
    color: var(--md-gray-600);
    margin: 0;
}

/* Summary Card */
.summary-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.summary-item {
    display: flex;
    gap: 16px;
}

.summary-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
}

.summary-content {
    flex: 1;
}

.summary-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--md-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.summary-value {
    font-size: 16px;
    font-weight: 600;
    color: var(--md-gray-900);
    margin-bottom: 2px;
}

.summary-meta {
    font-size: 12px;
    color: var(--md-gray-600);
}

/* RTL Support */
[dir="rtl"] .detail-header,
[dir="rtl"] .summary-item,
[dir="rtl"] .quick-link {
    flex-direction: row-reverse;
}

[dir="rtl"] .time-range {
    flex-direction: row-reverse;
}

[dir="rtl"] .time-separator {
    transform: scaleX(-1);
}

[dir="rtl"] .quick-link:hover {
    transform: translateX(-4px);
}

/* Responsive */
@media (max-width: 991px) {
    .summary-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767px) {
    .detail-card,
    .description-card,
    .summary-card {
        padding: 20px;
    }
    
    .quick-links-card {
        padding: 20px;
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

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
<div class="container-fluid">
    <div class="row">
        <!-- Profile Summary -->
        <div class="col-lg-4">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                    </div>
                    <h4 class="profile-name">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                    <p class="profile-role">{{ __('app.etudiant') }}</p>
                    <span class="role-badge">
                        <i class="bi bi-person-badge"></i>
                        {{ $etudiant->matricule }}
                    </span>
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                            <i class="bi bi-door-open"></i>
                        </div>
                        <div class="stat-content-mini">
                            <div class="stat-label-mini">{{ __('app.classe') }}</div>
                            <div class="stat-value-mini">{{ $etudiant->classe?->nom_classe ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, {{ $etudiant->genre == 'masculin' ? '#0dcaf0 0%, #0aa2c0' : '#d63384 0%, #c22773' }} 100%);">
                            <i class="bi bi-gender-{{ $etudiant->genre == 'masculin' ? 'male' : 'female' }}"></i>
                        </div>
                        <div class="stat-content-mini">
                            <div class="stat-label-mini">{{ __('app.genre') }}</div>
                            <div class="stat-value-mini">{{ ucfirst($etudiant->genre ?? 'N/A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="col-lg-8">
            <div class="info-card">
                <div class="card-header-section">
                    <div class="card-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <h5 class="card-title">{{ __('app.informations_generales') }}</h5>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">{{ __('app.nom_complet') }}</div>
                        <div class="info-value">{{ $etudiant->prenom }} {{ $etudiant->nom }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.matricule') }}</div>
                        <div class="info-value">
                            <span class="matricule-badge">{{ $etudiant->matricule }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.email') }}</div>
                        <div class="info-value">
                            @if($etudiant->email)
                                <a href="mailto:{{ $etudiant->email }}" class="contact-link">
                                    <i class="bi bi-envelope"></i>
                                    {{ $etudiant->email }}
                                </a>
                            @else
                                <span class="text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.telephone') }}</div>
                        <div class="info-value">
                            @if($etudiant->telephone)
                                <a href="tel:{{ $etudiant->telephone }}" class="contact-link">
                                    <i class="bi bi-telephone"></i>
                                    {{ $etudiant->telephone }}
                                </a>
                            @else
                                <span class="text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.date_naissance') }}</div>
                        <div class="info-value">
                            @if($etudiant->date_naissance)
                                <span class="date-badge">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.date_inscription') }}</div>
                        <div class="info-value">
                            <span class="date-badge">
                                <i class="bi bi-calendar-check"></i>
                                {{ $etudiant->created_at->format('d/m/Y à H:i') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="info-item full-width">
                        <div class="info-label">{{ __('app.adresse') }}</div>
                        <div class="info-value">
                            @if($etudiant->adresse)
                                <i class="bi bi-geo-alt"></i>
                                {{ $etudiant->adresse }}
                            @else
                                <span class="text-na">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Info Card -->
            <div class="academic-card">
                <div class="card-header-section">
                    <div class="card-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h5 class="card-title">{{ __('app.informations_academiques') }}</h5>
                </div>
                
                <div class="academic-stats">
                    <div class="academic-stat">
                        <div class="academic-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                            <i class="bi bi-door-open"></i>
                        </div>
                        <div class="academic-info">
                            <div class="academic-label">{{ __('app.classe') }}</div>
                            <div class="academic-value">{{ $etudiant->classe?->nom_classe ?? 'Non assigné' }}</div>
                        </div>
                    </div>
                    
                    <div class="academic-stat">
                        <div class="academic-icon" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div class="academic-info">
                            <div class="academic-label">{{ __('app.evaluations') }}</div>
                            <div class="academic-value">0</div>
                        </div>
                    </div>
                    
                    <div class="academic-stat">
                        <div class="academic-icon" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="academic-info">
                            <div class="academic-label">{{ __('app.moyenne_generale') }}</div>
                            <div class="academic-value">-</div>
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
    --md-gray-600: #757575;
    --md-gray-700: #616161;
    --md-gray-900: #212529;
    --md-radius: 12px;
    --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
    --md-shadow-lg: 0 8px 16px rgba(0,0,0,0.12);
}

/* Profile Card */
.profile-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
    margin-bottom: 24px;
}

.profile-header {
    text-align: center;
}

.profile-avatar {
    width: 96px;
    height: 96px;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.profile-name {
    font-size: 22px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin-bottom: 8px;
}

.profile-role {
    font-size: 15px;
    color: var(--md-gray-600);
    margin-bottom: 16px;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 16px;
    background: rgba(13, 110, 253, 0.1);
    color: var(--md-primary);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

[dir="rtl"] .role-badge {
    flex-direction: row-reverse;
}

.profile-stats {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 16px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--md-gray-200);
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

[dir="rtl"] .stat-item {
    flex-direction: row-reverse;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon i {
    font-size: 18px;
    color: white;
}

.stat-content-mini {
    flex: 1;
}

.stat-label-mini {
    font-size: 11px;
    color: var(--md-gray-600);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value-mini {
    font-size: 14px;
    font-weight: 600;
    color: var(--md-gray-900);
}

.stat-divider {
    width: 1px;
    background: var(--md-gray-200);
}

/* Info Card */
.info-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
    margin-bottom: 24px;
}

.card-header-section {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--md-gray-200);
}

[dir="rtl"] .card-header-section {
    flex-direction: row-reverse;
}

.card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--md-primary) 0%, #0a58ca 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.card-icon i {
    font-size: 20px;
    color: white;
}

.card-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--md-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 14px;
    font-weight: 500;
    color: var(--md-gray-900);
}

.contact-link {
    color: var(--md-primary);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

[dir="rtl"] .contact-link {
    flex-direction: row-reverse;
}

.contact-link:hover {
    color: var(--md-primary);
    transform: translateX(4px);
}

[dir="rtl"] .contact-link:hover {
    transform: translateX(-4px);
}

.matricule-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: var(--md-gray-100);
    color: var(--md-gray-700);
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    font-family: monospace;
}

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--md-gray-700);
    font-size: 13px;
}

[dir="rtl"] .date-badge {
    flex-direction: row-reverse;
}

.text-na {
    color: var(--md-gray-600);
    font-style: italic;
}

/* Academic Card */
.academic-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
}

.academic-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.academic-stat {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    background: var(--md-gray-50);
    border-radius: 10px;
    transition: all 0.3s;
}

[dir="rtl"] .academic-stat {
    flex-direction: row-reverse;
}

.academic-stat:hover {
    background: white;
    box-shadow: var(--md-shadow);
    transform: translateY(-2px);
}

.academic-icon {
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

.academic-info {
    flex: 1;
}

.academic-label {
    font-size: 11px;
    color: var(--md-gray-600);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.academic-value {
    font-size: 20px;
    font-weight: 700;
    color: var(--md-gray-900);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .academic-stats {
        gap: 16px;
    }
}

@media (max-width: 992px) {
    .info-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .academic-stats {
        grid-template-columns: 1fr;
        gap: 12px;
    }
}

@media (max-width: 768px) {
    .profile-card,
    .info-card,
    .academic-card {
        padding: 24px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }
    
    .profile-name {
        font-size: 20px;
    }
    
    .profile-stats {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .stat-divider {
        display: none;
    }
    
    .stat-item {
        padding: 12px;
        background: var(--md-gray-50);
        border-radius: 8px;
    }
    
    .card-header-section {
        gap: 12px;
    }
    
    .card-icon {
        width: 36px;
        height: 36px;
    }
    
    .card-icon i {
        font-size: 18px;
    }
    
    .card-title {
        font-size: 16px;
    }
    
    .academic-stat {
        padding: 16px;
    }
    
    .academic-icon {
        width: 44px;
        height: 44px;
        font-size: 18px;
    }
    
    .academic-value {
        font-size: 18px;
    }
}

@media (max-width: 576px) {
    .profile-card,
    .info-card,
    .academic-card {
        padding: 20px;
    }
    
    .profile-avatar {
        width: 72px;
        height: 72px;
        font-size: 28px;
    }
    
    .profile-name {
        font-size: 18px;
    }
    
    .info-item {
        gap: 6px;
    }
    
    .info-label {
        font-size: 11px;
    }
    
    .info-value {
        font-size: 13px;
    }
}

@media (max-width: 400px) {
    .profile-card,
    .info-card,
    .academic-card {
        padding: 16px;
    }
    
    .profile-avatar {
        width: 64px;
        height: 64px;
        font-size: 24px;
    }
    
    .card-title {
        font-size: 15px;
    }
}
</style>
@endpush

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
<div class="container-fluid">
    <div class="row">
        <!-- Profile Summary -->
        <div class="col-lg-4">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ substr($enseignants->prenom, 0, 1) }}{{ substr($enseignants->nom, 0, 1) }}
                    </div>
                    <h4 class="profile-name">{{ $enseignants->prenom }} {{ $enseignants->nom }}</h4>
                    <p class="profile-role">{{ $enseignants->matiere }}</p>
                    <span class="role-badge">{{ __('app.enseignant') }}</span>
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $enseignants->id_enseignant }}</div>
                        <div class="stat-label">ID Enseignant</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $enseignants->classe ? $enseignants->classe->nom_classe : 'N/A' }}</div>
                        <div class="stat-label">Classe assignée</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="col-lg-8">
            <div class="info-card">
                <div class="card-header-section">
                    <h5 class="card-title">{{ __('app.informations_personnelles') }}</h5>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">{{ __('app.nom_complet') }}</div>
                        <div class="info-value">{{ $enseignants->prenom }} {{ $enseignants->nom }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.email') }}</div>
                        <div class="info-value">
                            <a href="mailto:{{ $enseignants->email }}" class="contact-link">
                                <i class="bi bi-envelope"></i>
                                {{ $enseignants->email }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.telephone') }}</div>
                        <div class="info-value">
                            <a href="tel:{{ $enseignants->telephone }}" class="contact-link">
                                <i class="bi bi-telephone"></i>
                                {{ $enseignants->telephone }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.matiere_enseignee') }}</div>
                        <div class="info-value">
                            <span class="subject-badge">{{ $enseignants->matiere }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.classe_assignee') }}</div>
                        <div class="info-value">
                            @if($enseignants->classe)
                                <span class="class-badge">{{ $enseignants->classe->nom_classe }}</span>
                            @else
                                <span class="unassigned-text">{{ __('app.aucune_classe_assignee') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">{{ __('app.date_ajout') }}</div>
                        <div class="info-value">{{ $enseignants->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Activity Card -->
            <div class="activity-card">
                <div class="card-header-section">
                    <h5 class="card-title">{{ __('app.activite_pedagogique') }}</h5>
                </div>
                
                <div class="activity-stats">
                    <div class="activity-stat">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-value">0</div>
                            <div class="activity-label">{{ __('app.cours_dispenses') }}</div>
                        </div>
                    </div>
                    
                    <div class="activity-stat">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-value">0</div>
                            <div class="activity-label">{{ __('app.evaluations_creees') }}</div>
                        </div>
                    </div>
                    
                    <div class="activity-stat">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-value">{{ $enseignants->classe ? $enseignants->classe->etudiants()->count() : 0 }}</div>
                            <div class="activity-label">{{ __('app.etudiants') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="quote-section">
                    <div class="quote-icon">
                        <i class="bi bi-quote"></i>
                    </div>
                    <blockquote class="quote-text">
                        <p>"{{ __('app.mission_educative_quote') }}"</p>
                        <footer>{{ __('app.mission_educative') }}</footer>
                    </blockquote>
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
    padding: 6px 16px;
    background: rgba(13, 110, 253, 0.1);
    color: var(--md-primary);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.profile-stats {
    display: flex;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--md-gray-200);
}

.stat-item {
    flex: 1;
    text-align: center;
}

.stat-value {
    font-size: 20px;
    font-weight: 700;
    color: var(--md-primary);
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    color: var(--md-gray-600);
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
    margin-bottom: 24px;
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

.contact-link:hover {
    color: var(--md-primary);
    transform: translateX(4px);
}

.subject-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: rgba(13, 110, 253, 0.1);
    color: var(--md-primary);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.class-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: var(--md-gray-100);
    color: var(--md-gray-700);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.unassigned-text {
    color: var(--md-gray-500);
    font-style: italic;
}

/* Activity Card */
.activity-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
}

.activity-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.activity-stat {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    background: var(--md-gray-50);
    border-radius: 10px;
    transition: all 0.3s;
}

.activity-stat:hover {
    background: white;
    box-shadow: var(--md-shadow);
    transform: translateY(-2px);
}

.activity-icon {
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

.activity-info {
    flex: 1;
}

.activity-value {
    font-size: 24px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin-bottom: 2px;
}

.activity-label {
    font-size: 11px;
    color: var(--md-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Quote Section */
.quote-section {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.02) 100%);
    border-left: 4px solid var(--md-primary);
    border-radius: 8px;
    padding: 24px;
    display: flex;
    gap: 20px;
}

.quote-icon {
    width: 40px;
    height: 40px;
    background: var(--md-primary);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
}

.quote-text {
    flex: 1;
    margin: 0;
}

.quote-text p {
    font-size: 14px;
    font-style: italic;
    color: var(--md-gray-700);
    margin-bottom: 8px;
    line-height: 1.6;
}

.quote-text footer {
    font-size: 12px;
    color: var(--md-gray-600);
    font-style: normal;
}

/* RTL Support */
[dir="rtl"] .contact-link:hover {
    transform: translateX(-4px);
}

[dir="rtl"] .quote-section {
    border-left: none;
    border-right: 4px solid var(--md-primary);
    flex-direction: row-reverse;
}

[dir="rtl"] .activity-stat {
    flex-direction: row-reverse;
}

/* Responsive Design */
/* Large Tablets and Small Laptops (≤1200px) */
@media (max-width: 1200px) {
    .profile-stats {
        gap: 20px;
    }
    
    .activity-stats {
        gap: 16px;
    }
}

/* Tablets (≤992px) */
@media (max-width: 992px) {
    .info-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .activity-stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .profile-stats {
        justify-content: center;
    }
}

/* Small Tablets (≤768px) */
@media (max-width: 768px) {
    .profile-card,
    .info-card,
    .activity-card {
        padding: 24px;
        border-radius: 10px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }
    
    .profile-name {
        font-size: 22px;
    }
    
    .profile-role {
        font-size: 14px;
    }
    
    .stat-value {
        font-size: 22px;
    }
    
    .card-header h6 {
        font-size: 16px;
    }
    
    .activity-stats {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .quote-section {
        flex-direction: column;
        gap: 16px;
        padding: 20px;
    }
    
    .quote-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
}

/* Mobile Devices (≤576px) */
@media (max-width: 576px) {
    .profile-card,
    .info-card,
    .activity-card {
        padding: 20px;
    }
    
    .profile-avatar {
        width: 72px;
        height: 72px;
        font-size: 28px;
    }
    
    .profile-name {
        font-size: 20px;
    }
    
    .profile-stats {
        flex-direction: column;
        gap: 12px;
        width: 100%;
    }
    
    .stat-item {
        width: 100%;
        text-align: center;
        padding: 12px;
        background: var(--md-gray-50);
        border-radius: 8px;
    }
    
    .stat-divider {
        display: none;
    }
    
    .info-item {
        gap: 8px;
    }
    
    .info-label {
        font-size: 12px;
    }
    
    .info-value {
        font-size: 14px;
    }
    
    .card-header {
        padding: 16px 20px;
        gap: 12px;
    }
    
    .card-icon {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }
    
    .card-header h6 {
        font-size: 15px;
    }
    
    .activity-stat-icon {
        width: 44px;
        height: 44px;
        font-size: 20px;
    }
    
    .activity-stat-value {
        font-size: 20px;
    }
    
    .activity-stat-label {
        font-size: 12px;
    }
}

/* Extra Small Devices (≤400px) */
@media (max-width: 400px) {
    .profile-card,
    .info-card,
    .activity-card {
        padding: 16px;
    }
    
    .profile-name {
        font-size: 18px;
    }
    
    .profile-avatar {
        width: 64px;
        height: 64px;
        font-size: 24px;
    }
    
    .card-header h6 {
        font-size: 14px;
    }
}
</style>
@endpush

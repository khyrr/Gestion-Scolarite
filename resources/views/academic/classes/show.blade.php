@extends('layouts.dashboard')

@section('title', $classe->nom_classe)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $classe->nom_classe }}</li>
@endsection

@section('header-actions')
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('administrateur')))
        <a href="{{ route('classes.edit', $classe->id_classe) }}" class="btn btn-primary">
            {{ __('app.modifier') }}
        </a>
    @endif
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-primary-subtle">
                    <i class="fas fa-user-graduate stats-icon text-primary"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.etudiants_inscrits') }}</p>
                    <h3 class="stats-value">{{ $classe->etudiants->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-success-subtle">
                    <i class="fas fa-book stats-icon text-success"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.cours_assignes') }}</p>
                    <h3 class="stats-value">{{ $classe->cours->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-info-subtle">
                    <i class="fas fa-clipboard-check stats-icon text-info"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.evaluations') }}</p>
                    <h3 class="stats-value">{{ $classe->evaluations->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-warning-subtle">
                    <i class="fas fa-layer-group stats-icon text-warning"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.niveau') }}</p>
                    <h3 class="stats-value">{{ $classe->niveau }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Class Details Card -->
        <div class="col-lg-4">
            <div class="detail-card">
                <div class="detail-card-header">
                    <h5 class="detail-card-title">{{ __('app.details_classe') }}</h5>
                </div>
                <div class="detail-card-body">
                    <div class="detail-item">
                        <div class="detail-label">{{ __('app.nom_classe') }}</div>
                        <div class="detail-value">{{ $classe->nom_classe }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">{{ __('app.niveau') }}</div>
                        <div class="detail-value">
                            <span class="level-badge">{{ $classe->niveau }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">{{ __('app.date_creation') }}</div>
                        <div class="detail-value detail-date">
                            <i class="fas fa-calendar-plus me-2"></i>
                            {{ $classe->created_at?->format('d/m/Y H:i') ?? 'N/A' }}
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">{{ __('app.date_modification') }}</div>
                        <div class="detail-value detail-date">
                            <i class="fas fa-calendar-edit me-2"></i>
                            {{ $classe->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students List Card -->
        <div class="col-lg-8">
            <div class="detail-card">
                <div class="detail-card-header">
                    <h5 class="detail-card-title">
                        {{ __('app.etudiants_de_la_classe') }}
                        <span class="count-badge">{{ $classe->etudiants->count() }}</span>
                    </h5>
                    @admin
                        <a href="{{ route('etudiants.create', ['classe' => $classe->id_classe]) }}" class="btn btn-primary btn-sm-modern">
                            <i class="fas fa-plus me-2"></i>{{ __('app.ajouter_etudiant') }}
                        </a>
                    @endadmin
                </div>
                
                <div class="detail-card-body p-0">
                    @if($classe->etudiants->count() > 0)
                        <div class="modern-table-wrapper">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.nom_complet') }}</th>
                                        <th>{{ __('app.email') }}</th>
                                        <th>{{ __('app.telephone') }}</th>
                                        <th class="text-end">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classe->etudiants as $student)
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        {{ strtoupper(substr($student->prenom, 0, 1) . substr($student->nom, 0, 1)) }}
                                                    </div>
                                                    <span class="student-name">{{ $student->prenom }} {{ $student->nom }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($student->email)
                                                    <a href="mailto:{{ $student->email }}" class="contact-link">
                                                        <i class="fas fa-envelope me-2"></i>{{ $student->email }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student->telephone)
                                                    <a href="tel:{{ $student->telephone }}" class="contact-link">
                                                        <i class="fas fa-phone me-2"></i>{{ $student->telephone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('etudiants.show', $student) }}" class="btn-action">
                                                    {{ __('app.voir') }}
                                                    <i class="fas fa-arrow-right ms-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state-inline">
                            <div class="empty-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h6 class="empty-title">{{ __('app.aucun_etudiant_inscrit') }}</h6>
                            <p class="empty-text">{{ __('app.classe_sans_etudiants') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    @if($classe->cours->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="detail-card">
                <div class="detail-card-header">
                    <h5 class="detail-card-title">
                        {{ __('app.cours_de_la_classe') }}
                        <span class="count-badge">{{ $classe->cours->count() }}</span>
                    </h5>
                </div>
                
                <div class="detail-card-body">
                    <div class="row g-3">
                        @foreach($classe->cours as $cours)
                            <div class="col-lg-4 col-md-6">
                                <div class="course-card">
                                    <div class="course-header">
                                        <div class="course-icon">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                        <h6 class="course-title">{{ $cours->nom_cours }}</h6>
                                    </div>
                                    <div class="course-body">
                                        <div class="course-teacher">
                                            <i class="fas fa-chalkboard-teacher me-2"></i>
                                            <span>{{ $cours->enseignant?->nom_enseignant ?? __('app.non_assigne') }}</span>
                                        </div>
                                    </div>
                                    <div class="course-footer">
                                        <a href="{{ route('cours.show', $cours->id_cours) }}" class="btn-course-view">
                                            {{ __('app.voir_le_cours') }}
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('styles')
<style>
    /* ===== Material Design Variables ===== */
    :root {
        --md-primary: #0d6efd;
        --md-primary-hover: #0b5ed7;
        --md-success: #198754;
        --md-info: #0dcaf0;
        --md-warning: #ffc107;
        
        --md-gray-50: #fafafa;
        --md-gray-100: #f5f5f5;
        --md-gray-200: #eeeeee;
        --md-gray-300: #e0e0e0;
        --md-gray-400: #bdbdbd;
        --md-gray-500: #9e9e9e;
        --md-gray-600: #757575;
        --md-gray-700: #616161;
        --md-gray-800: #424242;
        --md-gray-900: #212121;
        
        --md-radius: 12px;
        --md-radius-sm: 8px;
        --md-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --md-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        --md-shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
        --md-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== Statistics Cards ===== */
    .stats-card {
        background: white;
        border-radius: var(--md-radius);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: var(--md-shadow-sm);
        transition: var(--md-transition);
        border: 1px solid var(--md-gray-200);
    }
    
    .stats-card:hover {
        box-shadow: var(--md-shadow);
        transform: translateY(-2px);
    }
    
    .stats-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: var(--md-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .stats-icon {
        font-size: 1.5rem;
    }
    
    .stats-content {
        flex: 1;
        min-width: 0;
    }
    
    .stats-label {
        font-size: 0.875rem;
        color: var(--md-gray-600);
        margin: 0 0 0.25rem 0;
        font-weight: 500;
    }
    
    .stats-value {
        font-size: 2rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0;
        line-height: 1;
    }

    /* ===== Detail Cards ===== */
    .detail-card {
        background: white;
        border-radius: var(--md-radius);
        border: 1px solid var(--md-gray-200);
        box-shadow: var(--md-shadow-sm);
        overflow: hidden;
        transition: var(--md-transition);
    }
    
    .detail-card:hover {
        box-shadow: var(--md-shadow);
    }
    
    .detail-card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--md-gray-200);
        background: var(--md-gray-50);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }
    
    .detail-card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        padding: 0 0.5rem;
        background: var(--md-primary);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 100px;
    }
    
    .detail-card-body {
        padding: 1.5rem;
    }

    /* ===== Detail Items ===== */
    .detail-item {
        padding: 1rem 0;
        border-bottom: 1px solid var(--md-gray-200);
    }
    
    .detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .detail-item:first-child {
        padding-top: 0;
    }
    
    .detail-label {
        font-size: 0.875rem;
        color: var(--md-gray-600);
        margin-bottom: 0.5rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        font-size: 1rem;
        color: var(--md-gray-900);
        font-weight: 500;
    }
    
    .detail-date {
        display: flex;
        align-items: center;
        color: var(--md-gray-700);
    }
    
    .detail-date i {
        color: var(--md-gray-500);
    }
    
    .level-badge {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        background: rgba(13, 110, 253, 0.1);
        color: var(--md-primary);
        font-size: 0.875rem;
        font-weight: 700;
        border-radius: 100px;
        letter-spacing: 0.3px;
    }

    /* ===== Modern Table ===== */
    .modern-table-wrapper {
        overflow-x: auto;
    }
    
    .modern-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .modern-table thead {
        background: var(--md-gray-50);
    }
    
    .modern-table thead th {
        padding: 1rem 1.5rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--md-gray-700);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--md-gray-200);
    }
    
    .modern-table tbody tr {
        border-bottom: 1px solid var(--md-gray-200);
        transition: var(--md-transition);
    }
    
    .modern-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .modern-table tbody tr:hover {
        background: var(--md-gray-50);
    }
    
    .modern-table tbody td {
        padding: 1rem 1.5rem;
        font-size: 0.875rem;
        color: var(--md-gray-800);
    }
    
    /* Student Info in Table */
    .student-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .student-name {
        font-weight: 600;
        color: var(--md-gray-900);
    }
    
    .contact-link {
        color: var(--md-gray-700);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--md-transition);
    }
    
    .contact-link:hover {
        color: var(--md-primary);
    }
    
    .contact-link i {
        font-size: 0.75rem;
        color: var(--md-gray-500);
    }
    
    .btn-action {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: var(--md-primary);
        color: white;
        text-decoration: none;
        border-radius: var(--md-radius-sm);
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--md-transition);
        border: none;
    }
    
    .btn-action:hover {
        background: var(--md-primary-hover);
        color: white;
        transform: translateX(4px);
    }
    
    .btn-action i {
        font-size: 0.75rem;
        transition: var(--md-transition);
    }
    
    .btn-sm-modern {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: var(--md-radius-sm);
        transition: var(--md-transition);
    }
    
    .btn-sm-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    /* ===== Empty State Inline ===== */
    .empty-state-inline {
        padding: 3rem 2rem;
        text-align: center;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        background: var(--md-gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-icon i {
        font-size: 2rem;
        color: var(--md-gray-400);
    }
    
    .empty-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--md-gray-700);
        margin-bottom: 0.5rem;
    }
    
    .empty-text {
        font-size: 0.875rem;
        color: var(--md-gray-600);
        margin: 0;
    }

    /* ===== Course Cards ===== */
    .course-card {
        background: white;
        border: 1px solid var(--md-gray-200);
        border-radius: var(--md-radius);
        overflow: hidden;
        transition: var(--md-transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .course-card:hover {
        box-shadow: var(--md-shadow);
        transform: translateY(-4px);
        border-color: var(--md-primary);
    }
    
    .course-header {
        padding: 1.25rem;
        background: var(--md-gray-50);
        border-bottom: 1px solid var(--md-gray-200);
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .course-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--md-radius-sm);
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .course-icon i {
        font-size: 1.125rem;
    }
    
    .course-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0;
        line-height: 1.4;
    }
    
    .course-body {
        padding: 1.25rem;
        flex: 1;
    }
    
    .course-teacher {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: var(--md-gray-700);
    }
    
    .course-teacher i {
        color: var(--md-gray-500);
    }
    
    .course-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--md-gray-200);
        background: white;
    }
    
    .btn-course-view {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.625rem 1rem;
        background: var(--md-primary);
        color: white;
        text-decoration: none;
        border-radius: var(--md-radius-sm);
        font-weight: 500;
        font-size: 0.875rem;
        transition: var(--md-transition);
    }
    
    .btn-course-view:hover {
        background: var(--md-primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    .btn-course-view i {
        font-size: 0.75rem;
        transition: var(--md-transition);
    }
    
    .btn-course-view:hover i {
        transform: translateX(4px);
    }

    /* ===== RTL Support ===== */
    [dir="rtl"] .contact-link i {
        margin-right: 0;
        margin-left: 0.5rem;
    }
    
    [dir="rtl"] .btn-action:hover {
        transform: translateX(-4px);
    }
    
    [dir="rtl"] .btn-course-view:hover i {
        transform: translateX(-4px);
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 1399.98px) {
        .stats-value {
            font-size: 1.75rem;
        }
    }
    
    @media (max-width: 991.98px) {
        .stats-card {
            padding: 1.25rem;
        }
        
        .stats-icon-wrapper {
            width: 48px;
            height: 48px;
        }
        
        .stats-icon {
            font-size: 1.25rem;
        }
        
        .stats-value {
            font-size: 1.5rem;
        }
        
        .detail-card-header {
            padding: 1.25rem;
        }
        
        .detail-card-body {
            padding: 1.25rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.875rem 1rem;
        }
    }
    
    @media (max-width: 767.98px) {
        .stats-card {
            padding: 1rem;
        }
        
        .detail-card-header {
            padding: 1rem;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .detail-card-body {
            padding: 1rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.75rem;
            font-size: 0.8125rem;
        }
        
        .student-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.625rem;
        }
        
        .course-header {
            padding: 1rem;
        }
        
        .course-body {
            padding: 1rem;
        }
        
        .course-footer {
            padding: 0.875rem 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .stats-value {
            font-size: 1.5rem;
        }
        
        .modern-table {
            font-size: 0.75rem;
        }
        
        .student-info {
            gap: 0.5rem;
        }
        
        .empty-state-inline {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush

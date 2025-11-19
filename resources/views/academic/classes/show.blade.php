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
    <!-- Page Header -->
    <div class="google-page-header">
        <h1 class="google-page-title">{{ $classe->nom_classe }}</h1>
        <span class="google-level-badge">{{ __('app.niveau') }} {{ $classe->niveau }}</span>
    </div>

    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.etudiants_inscrits') }}</div>
            <div class="google-stat-value">{{ $classe->etudiants->count() }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.cours_assignes') }}</div>
            <div class="google-stat-value">{{ $classe->cours->count() }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.evaluations') }}</div>
            <div class="google-stat-value">{{ $classe->evaluations->count() }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.date_creation') }}</div>
            <div class="google-stat-value">{{ $classe->created_at?->format('d/m/Y') ?? 'N/A' }}</div>
        </div>
    </div>

    <!-- Students Section -->
    <div class="google-section">
        <div class="google-section-header">
            <h2 class="google-section-title">{{ __('app.etudiants_de_la_classe') }}</h2>
            @admin
                <a href="{{ route('etudiants.create', ['classe' => $classe->id_classe]) }}" class="google-btn google-btn-primary">
                    {{ __('app.ajouter_etudiant') }}
                </a>
            @endadmin
        </div>
        
        <div class="google-content-card">
            @if($classe->etudiants->count() > 0)
                @foreach($classe->etudiants as $student)
                    <div class="google-list-item" onclick="window.location.href='{{ route('etudiants.show', $student) }}'">
                        <div class="google-student-info">
                            <div class="google-avatar">
                                {{ strtoupper(substr($student->prenom, 0, 1) . substr($student->nom, 0, 1)) }}
                            </div>
                            <div class="google-student-details">
                                <div class="google-student-name">{{ $student->prenom }} {{ $student->nom }}</div>
                                <div class="google-student-contact">
                                    @if($student->email)
                                        <span>{{ $student->email }}</span>
                                    @endif
                                    @if($student->email && $student->telephone)
                                        <span class="google-separator">•</span>
                                    @endif
                                    @if($student->telephone)
                                        <span>{{ $student->telephone }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="google-icon-btn" onclick="event.stopPropagation(); window.location.href='{{ route('etudiants.show', $student) }}'">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            @else
                <div class="google-empty-state">
                    <div class="google-empty-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 class="google-empty-title">{{ __('app.aucun_etudiant_inscrit') }}</h3>
                    <p class="google-empty-text">{{ __('app.classe_sans_etudiants') }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Courses Section -->
    @if($classe->cours->count() > 0)
    <div class="google-section">
        <div class="google-section-header">
            <h2 class="google-section-title">{{ __('app.cours_de_la_classe') }}</h2>
        </div>
        
        <div class="google-courses-grid">
            @foreach($classe->cours as $cours)
                <div class="google-course-item" onclick="window.location.href='{{ route('cours.show', $cours->id_cours) }}'">
                    <div class="google-course-content">
                        <h3 class="google-course-name">{{ $cours->nom_cours }}</h3>
                        <p class="google-course-teacher">{{ $cours->enseignant?->nom_enseignant ?? __('app.non_assigne') }}</p>
                    </div>
                    <button class="google-icon-btn" onclick="event.stopPropagation(); window.location.href='{{ route('cours.show', $cours->id_cours) }}'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection

@push('styles')
<style>
    /* ===== Google Design Variables ===== */
    :root {
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-blue-light: #e8f0fe;
        
        --google-white: #ffffff;
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
        
        --google-font: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-spacing-2xl: 48px;
        
        --google-radius: 8px;
        --google-radius-sm: 4px;
        
        --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
        --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
        
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    /* ===== Page Header ===== */
    .google-page-header {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-xl);
        flex-wrap: wrap;
    }
    
    .google-page-title {
        font-family: var(--google-font);
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    
    .google-level-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        background: var(--google-blue-light);
        color: var(--google-blue);
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 100px;
        letter-spacing: 0.3px;
    }

    /* ===== Statistics Grid ===== */
    .google-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-2xl);
    }
    
    .google-stat-card {
        background: var(--google-white);
        border: 1px solid var(--google-gray-200);
        border-radius: var(--google-radius);
        padding: var(--google-spacing-lg);
        transition: var(--google-transition);
    }
    
    .google-stat-card:hover {
        box-shadow: var(--google-shadow-1);
        border-color: var(--google-gray-300);
    }
    
    .google-stat-label {
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--google-gray-700);
        margin-bottom: var(--google-spacing-sm);
        text-transform: capitalize;
    }
    
    .google-stat-value {
        font-family: var(--google-font);
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
        line-height: 1;
    }

    /* ===== Section ===== */
    .google-section {
        margin-bottom: var(--google-spacing-2xl);
    }
    
    .google-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--google-spacing-lg);
        gap: var(--google-spacing-md);
    }
    
    .google-section-title {
        font-family: var(--google-font);
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0;
        letter-spacing: -0.3px;
    }
    
    /* ===== Content Card ===== */
    .google-content-card {
        background: var(--google-white);
        border: 1px solid var(--google-gray-200);
        border-radius: var(--google-radius);
        overflow: hidden;
    }

    /* ===== List Item ===== */
    .google-list-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--google-spacing-lg);
        border-bottom: 1px solid var(--google-gray-200);
        transition: var(--google-transition);
        cursor: pointer;
        gap: var(--google-spacing-md);
    }
    
    .google-list-item:last-child {
        border-bottom: none;
    }
    
    .google-list-item:hover {
        background: var(--google-gray-50);
    }
    
    .google-student-info {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-md);
        flex: 1;
        min-width: 0;
    }
    
    .google-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--google-blue);
        color: var(--google-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 500;
        flex-shrink: 0;
    }
    
    .google-student-details {
        flex: 1;
        min-width: 0;
    }
    
    .google-student-name {
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin-bottom: 2px;
    }
    
    .google-student-contact {
        font-family: var(--google-font);
        font-size: 0.8125rem;
        color: var(--google-gray-600);
        display: flex;
        align-items: center;
        gap: var(--google-spacing-sm);
        flex-wrap: wrap;
    }
    
    .google-separator {
        color: var(--google-gray-400);
    }

    /* ===== Icon Button ===== */
    .google-icon-btn {
        width: 36px;
        height: 36px;
        border: none;
        background: transparent;
        color: var(--google-gray-600);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--google-transition);
        cursor: pointer;
        flex-shrink: 0;
        padding: 0;
    }
    
    .google-icon-btn:hover {
        background: var(--google-gray-200);
        color: var(--google-gray-900);
    }
    
    /* ===== Buttons ===== */
    .google-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 24px;
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        border-radius: var(--google-radius-sm);
        border: none;
        cursor: pointer;
        transition: var(--google-transition);
        letter-spacing: 0.25px;
        white-space: nowrap;
    }
    
    .google-btn-primary {
        background: var(--google-blue);
        color: var(--google-white);
    }
    
    .google-btn-primary:hover {
        background: var(--google-blue-hover);
        color: var(--google-white);
        box-shadow: var(--google-shadow-1);
    }

    /* ===== Empty State ===== */
    .google-empty-state {
        padding: var(--google-spacing-2xl) var(--google-spacing-lg);
        text-align: center;
    }
    
    .google-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto var(--google-spacing-lg);
        color: var(--google-gray-400);
    }
    
    .google-empty-title {
        font-family: var(--google-font);
        font-size: 1.25rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-sm) 0;
    }
    
    .google-empty-text {
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--google-gray-700);
        margin: 0;
    }

    /* ===== Courses Grid ===== */
    .google-courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--google-spacing-md);
    }
    
    .google-course-item {
        background: var(--google-white);
        border: 1px solid var(--google-gray-200);
        border-radius: var(--google-radius);
        padding: var(--google-spacing-lg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--google-spacing-md);
        transition: var(--google-transition);
        cursor: pointer;
    }
    
    .google-course-item:hover {
        box-shadow: var(--google-shadow-1);
        border-color: var(--google-gray-300);
        background: var(--google-gray-50);
    }
    
    .google-course-content {
        flex: 1;
        min-width: 0;
    }
    
    .google-course-name {
        font-family: var(--google-font);
        font-size: 1rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-xs) 0;
    }
    
    .google-course-teacher {
        font-family: var(--google-font);
        font-size: 0.8125rem;
        color: var(--google-gray-600);
        margin: 0;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .google-page-title {
            font-size: 1.5rem;
        }
        
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .google-stat-value {
            font-size: 1.5rem;
        }
        
        .google-section-title {
            font-size: 1.25rem;
        }
        
        .google-section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .google-list-item {
            padding: var(--google-spacing-md);
        }
        
        .google-avatar {
            width: 36px;
            height: 36px;
            font-size: 0.75rem;
        }
        
        .google-courses-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .google-page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .google-page-title {
            font-size: 1.25rem;
        }
        
        .google-stats-grid {
            grid-template-columns: 1fr;
        }
        
        .google-stat-value {
            font-size: 1.75rem;
        }
        
        .google-section-title {
            font-size: 1.125rem;
        }
        
        .google-list-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .google-student-info {
            width: 100%;
        }
        
        .google-icon-btn {
            align-self: flex-end;
        }
        
        .google-empty-state {
            padding: var(--google-spacing-xl) var(--google-spacing-md);
        }
        
        .google-btn {
            width: 100%;
        }
    }
</style>
@endpush

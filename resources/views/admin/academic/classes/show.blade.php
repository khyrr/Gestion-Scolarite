@extends('admin.layouts.dashboard')

@section('title', $classe->nom_classe)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $classe->nom_classe }}</li>
@endsection

@section('header-actions')
    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('administrateur')))
        <a href="{{ route('admin.classes.edit', $classe->id_classe) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.modifier') }}</span>
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
                <a href="{{ route('admin.etudiants.create', ['classe' => $classe->id_classe]) }}" class="google-btn google-btn-primary">
                    {{ __('app.ajouter_etudiant') }}
                </a>
            @endadmin
        </div>
        
        <div class="google-content-card">
            @if($classe->etudiants->count() > 0)
                @foreach($classe->etudiants as $student)
                    <div class="google-list-item" onclick="window.location.href='{{ route('admin.etudiants.show', $student) }}'">
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
                        <button class="google-icon-btn" onclick="event.stopPropagation(); window.location.href='{{ route('admin.etudiants.show', $student) }}'" aria-label="Voir l'étudiant {{ $student->prenom }} {{ $student->nom }}">
                            <x-icon name="ui/chevron-right" :size="20" :decorative="true" />
                        </button>
                    </div>
                @endforeach
            @else
                <div class="google-empty-state">
                    <div class="google-empty-icon">
                        <x-icon name="empty-states/search-empty" size="3xl" :decorative="true" />
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
                <div class="google-course-item" onclick="window.location.href='{{ route('admin.cours.show', $cours->id_cours) }}'">
                    <div class="google-course-content">
                        <h3 class="google-course-name">{{ $cours->nom_cours }}</h3>
                        <p class="google-course-teacher">{{ $cours->enseignant?->nom_enseignant ?? __('app.non_assigne') }}</p>
                    </div>
                    <button class="google-icon-btn" onclick="event.stopPropagation(); window.location.href='{{ route('admin.cours.show', $cours->id_cours) }}'" aria-label="Voir le cours {{ $cours->nom_cours }}">
                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection

@push('styles')
<style>
    /* Page-Specific Components */
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
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin-bottom: 2px;
    }
    
    .google-student-contact {
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

    .google-courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--google-spacing-md);
    }
    
    .google-course-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--google-spacing-md);
    }
    
    .google-course-content {
        flex: 1;
        min-width: 0;
    }
    
    .google-course-name {
        font-size: 1rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-xs) 0;
    }
    
    .google-course-teacher {
        font-size: 0.8125rem;
        color: var(--google-gray-600);
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
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
    }
</style>
@endpush

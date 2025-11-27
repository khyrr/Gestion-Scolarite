@extends('admin.layouts.dashboard')

@section('title', __('app.classes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.classes') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus google-icon" aria-hidden="true"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.ajouter_classe') }}</span>
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Page Header with Search -->
    <div class="google-page-header">
        <div class="google-header-content">
            <div class="google-header-text">
                <h1 class="google-page-title">{{ __('app.classes') }}</h1>
                <p class="google-page-subtitle">{{ __('app.liste_classes') }}</p>
            </div>
            <div class="google-search-wrapper">
                <div class="google-search-box">
                    <i class="fas fa-search google-search-icon" aria-hidden="true"></i>
                    <input type="text" id="classSearch" class="google-search-input" placeholder="{{ __('app.rechercher_une_classe') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="google-stats-grid">
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.total_classes') }}</div>
            <div class="google-stat-value">{{ $classes->count() }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.total_etudiants') }}</div>
            <div class="google-stat-value">{{ $classes->sum('etudiants_count') }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.niveau_minimum') }}</div>
            <div class="google-stat-value">{{ $classes->min('niveau') ?? 0 }}</div>
        </div>
        
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.niveau_maximum') }}</div>
            <div class="google-stat-value">{{ $classes->max('niveau') ?? 0 }}</div>
        </div>
    </div>

    @if($classes->count() > 0)
        <!-- Classes List -->
        <div class="google-list-container">
            @foreach($classes as $item)
                <div class="google-list-item" onclick="window.location.href='{{ route('admin.classes.show', $item->id_classe) }}'">
                    <div class="google-list-main">
                        <div class="google-list-header">
                            <h3 class="google-list-title">{{ $item->nom_classe }}</h3>
                            <span class="google-level-badge">{{ __('app.niveau') }} {{ $item->niveau }}</span>
                        </div>
                        
                        <div class="google-list-stats">
                            <div class="google-stat-pill">
                                <span class="google-stat-pill-value">{{ $item->etudiants->count() }}</span>
                                <span class="google-stat-pill-label">{{ __('app.etudiants') }}</span>
                            </div>
                            <div class="google-stat-pill">
                                <span class="google-stat-pill-value">{{ $item->enseignants_count ?? 0 }}</span>
                                <span class="google-stat-pill-label">{{ __('app.enseignants') }}</span>
                            </div>
                            <div class="google-stat-pill">
                                <span class="google-stat-pill-value">{{ $item->cours_count ?? 0 }}</span>
                                <span class="google-stat-pill-label">{{ __('app.cours') }}</span>
                            </div>
                            <div class="google-stat-pill">
                                <span class="google-stat-pill-value">{{ $item->evaluations->count() }}</span>
                                <span class="google-stat-pill-label">{{ __('app.evaluations') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="google-list-actions">
                        <a href="{{ route('admin.classes.show', $item->id_classe) }}" class="google-action-btn" onclick="event.stopPropagation()" aria-label="Voir la classe {{ $item->nom_classe }}">
                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown">
                            <button class="google-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Actions pour la classe {{ $item->nom_classe }}" onclick="event.stopPropagation()">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <circle cx="10" cy="4" r="1.5"/>
                                    <circle cx="10" cy="10" r="1.5"/>
                                    <circle cx="10" cy="16" r="1.5"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end google-dropdown">
                                <li>
                                    <a class="dropdown-item google-dropdown-item" href="{{ route('admin.classes.show', $item->id_classe) }}">
                                        {{ __('app.voir') }}
                                    </a>
                                </li>
                                @admin
                                <li>
                                    <a class="dropdown-item google-dropdown-item" href="{{ route('admin.classes.edit', $item->id_classe) }}">
                                        {{ __('app.modifier') }}
                                    </a>
                                </li>
                                <li><hr class="google-dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.classes.destroy', $item->id_classe) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="dropdown-item google-dropdown-item google-dropdown-item-danger delete-class" data-class-name="{{ $item->nom_classe }}">
                                            {{ __('app.supprimer') }}
                                        </button>
                                    </form>
                                </li>
                                @endadmin
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="google-empty-state">
            <div class="google-empty-icon">
                <i class="fas fa-clipboard-list google-empty-icon" aria-hidden="true"></i>
            </div>
            <h2 class="google-empty-title">{{ __('app.no_data') }}</h2>
            <p class="google-empty-text">{{ __('app.aucune_classe_creee') }}</p>
            @admin
                <a href="{{ route('admin.classes.create') }}" class="google-btn google-btn-primary">
                    {{ __('app.creer_premiere_classe') }}
                </a>
            @endadmin
        </div>
    @endif
@endsection

@push('styles')
<style>
    /* Page-Specific Layout */
    .google-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--google-gray-500);
        pointer-events: none;
    }
    
    .google-search-input {
        padding: 10px 16px 10px 48px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .google-list-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .google-list-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
    
    @media (max-width: 480px) {
        .google-list-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-sm);
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-class').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const className = this.dataset.className;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer la classe "${className}" ?`)) {
                form.submit();
            }
        });
    });

    // Search functionality
    const searchInput = document.getElementById('classSearch');
    if (searchInput) {
        // Store original values
        const statCards = document.querySelectorAll('.google-stat-card .google-stat-value');
        const originalValues = {
            totalClasses: statCards[0] ? statCards[0].textContent : '0',
            totalStudents: statCards[1] ? statCards[1].textContent : '0',
            minLevel: statCards[2] ? statCards[2].textContent : '0',
            maxLevel: statCards[3] ? statCards[3].textContent : '0'
        };

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            const listItems = document.querySelectorAll('.google-list-item');
            
            if (!searchTerm) {
                // Reset to original state
                listItems.forEach(item => item.style.display = '');
                if (statCards[0]) statCards[0].textContent = originalValues.totalClasses;
                if (statCards[1]) statCards[1].textContent = originalValues.totalStudents;
                if (statCards[2]) statCards[2].textContent = originalValues.minLevel;
                if (statCards[3]) statCards[3].textContent = originalValues.maxLevel;
                return;
            }

            let visibleCount = 0;
            let totalStudents = 0;
            let levels = [];
            
            listItems.forEach(function(item) {
                const title = item.querySelector('.google-list-title').textContent.toLowerCase();
                const badge = item.querySelector('.google-level-badge').textContent.toLowerCase();
                const searchableText = title + ' ' + badge;
                
                if (searchableText.includes(searchTerm)) {
                    item.style.display = '';
                    visibleCount++;
                    
                    // Extract student count
                    const studentsPill = item.querySelector('.google-stat-pill-value');
                    if (studentsPill) {
                        totalStudents += parseInt(studentsPill.textContent) || 0;
                    }
                    
                    // Extract level
                    const levelMatch = badge.match(/\d+/);
                    if (levelMatch) {
                        levels.push(parseInt(levelMatch[0]));
                    }
                } else {
                    item.style.display = 'none';
                }
            });

            // Update statistics
            if (statCards[0]) statCards[0].textContent = visibleCount;
            if (statCards[1]) statCards[1].textContent = totalStudents;
            if (statCards[2]) statCards[2].textContent = levels.length > 0 ? Math.min(...levels) : 0;
            if (statCards[3]) statCards[3].textContent = levels.length > 0 ? Math.max(...levels) : 0;
        });
    }
});
</script>
@endpush
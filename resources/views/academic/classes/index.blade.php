@extends('layouts.dashboard')

@section('title', __('app.classes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.classes') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('classes.create') }}" class="google-btn google-btn-primary">
            {{ __('app.ajouter_classe') }}
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
                    <svg class="google-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21l-4.35-4.35"/>
                    </svg>
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
                <div class="google-list-item" onclick="window.location.href='{{ route('classes.show', $item->id_classe) }}'">
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
                        <a href="{{ route('classes.show', $item->id_classe) }}" class="google-action-btn" onclick="event.stopPropagation()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </a>
                        <div class="dropdown">
                            <button class="google-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <circle cx="10" cy="4" r="1.5"/>
                                    <circle cx="10" cy="10" r="1.5"/>
                                    <circle cx="10" cy="16" r="1.5"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end google-dropdown">
                                <li>
                                    <a class="dropdown-item google-dropdown-item" href="{{ route('classes.show', $item->id_classe) }}">
                                        {{ __('app.voir') }}
                                    </a>
                                </li>
                                @admin
                                <li>
                                    <a class="dropdown-item google-dropdown-item" href="{{ route('classes.edit', $item->id_classe) }}">
                                        {{ __('app.modifier') }}
                                    </a>
                                </li>
                                <li><hr class="google-dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('classes.destroy', $item->id_classe) }}" method="POST" class="d-inline">
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
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>
            <h2 class="google-empty-title">{{ __('app.no_data') }}</h2>
            <p class="google-empty-text">{{ __('app.aucune_classe_creee') }}</p>
            @admin
                <a href="{{ route('classes.create') }}" class="google-btn google-btn-primary">
                    {{ __('app.creer_premiere_classe') }}
                </a>
            @endadmin
        </div>
    @endif
@endsection

@push('styles')
<style>
    /* ===== Google Design System Variables ===== */
    :root {
        /* Colors - Google Palette */
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-blue-light: #e8f0fe;
        --google-red: #d93025;
        --google-red-hover: #c5221f;
        
        /* Neutrals */
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
        
        /* Typography */
        --google-font: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        
        /* Spacing */
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-spacing-2xl: 48px;
        
        /* Border Radius */
        --google-radius: 8px;
        --google-radius-sm: 4px;
        --google-radius-lg: 12px;
        
        /* Shadows - Subtle Google style */
        --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
        --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
        
        /* Transitions */
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    /* ===== Page Header ===== */
    .google-page-header {
        margin-bottom: var(--google-spacing-2xl);
    }
    
    .google-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--google-spacing-xl);
    }
    
    .google-header-text {
        flex: 0 0 auto;
    }
    
    .google-page-title {
        font-family: var(--google-font);
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-sm) 0;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    
    .google-page-subtitle {
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--google-gray-700);
        margin: 0;
    }

    /* ===== Search Bar ===== */
    .google-search-wrapper {
        flex: 1;
        max-width: 480px;
    }
    
    .google-search-box {
        position: relative;
        width: 100%;
    }
    
    .google-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--google-gray-500);
        pointer-events: none;
    }
    
    .google-search-input {
        width: 100%;
        padding: 10px 16px 10px 48px;
        font-family: var(--google-font);
        font-size: 0.875rem;
        color: var(--google-gray-900);
        background: var(--google-white);
        border: 1px solid var(--google-gray-300);
        border-radius: 100px;
        transition: var(--google-transition);
        outline: none;
    }
    
    .google-search-input::placeholder {
        color: var(--google-gray-500);
    }
    
    .google-search-input:focus {
        border-color: var(--google-blue);
        box-shadow: 0 0 0 2px var(--google-blue-light);
    }
    
    .google-search-input:hover {
        border-color: var(--google-gray-400);
    }

    /* ===== Statistics Grid ===== */
    .google-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
        font-size: 2.25rem;
        font-weight: 400;
        color: var(--google-gray-900);
        line-height: 1;
    }

    /* ===== List Container ===== */
    .google-list-container {
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
        padding: var(--google-spacing-lg) var(--google-spacing-xl);
        border-bottom: 1px solid var(--google-gray-200);
        transition: var(--google-transition);
        cursor: pointer;
        gap: var(--google-spacing-lg);
    }
    
    .google-list-item:last-child {
        border-bottom: none;
    }
    
    .google-list-item:hover {
        background: var(--google-gray-50);
    }
    
    .google-list-main {
        flex: 1;
        min-width: 0;
    }
    
    .google-list-header {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-md);
        flex-wrap: wrap;
    }
    
    .google-list-title {
        font-family: var(--google-font);
        font-size: 1.125rem;
        font-weight: 500;
        color: var(--google-gray-900);
        margin: 0;
        letter-spacing: -0.2px;
    }
    
    .google-level-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        background: var(--google-blue-light);
        color: var(--google-blue);
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 100px;
        letter-spacing: 0.3px;
    }
    
    .google-list-stats {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-lg);
        flex-wrap: wrap;
    }
    
    .google-stat-pill {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }
    
    .google-stat-pill-value {
        font-family: var(--google-font);
        font-size: 1.125rem;
        font-weight: 500;
        color: var(--google-gray-900);
    }
    
    .google-stat-pill-label {
        font-family: var(--google-font);
        font-size: 0.8125rem;
        font-weight: 400;
        color: var(--google-gray-600);
    }
    
    .google-list-actions {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-sm);
        flex-shrink: 0;
    }
    
    .google-action-btn {
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
        text-decoration: none;
    }
    
    .google-action-btn:hover {
        background: var(--google-gray-200);
        color: var(--google-gray-900);
    }
    
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

    /* ===== Dropdown ===== */
    .google-dropdown {
        border: 1px solid var(--google-gray-200);
        box-shadow: var(--google-shadow-2);
        border-radius: var(--google-radius);
        padding: var(--google-spacing-sm) 0;
        min-width: 160px;
    }
    
    .google-dropdown-item {
        padding: 12px var(--google-spacing-md);
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--google-gray-900);
        transition: var(--google-transition);
        background: none;
        border: none;
        width: 100%;
        text-align: left;
    }
    
    .google-dropdown-item:hover {
        background: var(--google-gray-100);
        color: var(--google-gray-900);
    }
    
    .google-dropdown-item-danger {
        color: var(--google-red);
    }
    
    .google-dropdown-item-danger:hover {
        background: rgba(217, 48, 37, 0.08);
        color: var(--google-red-hover);
    }
    
    .google-dropdown-divider {
        margin: var(--google-spacing-sm) 0;
        border-top: 1px solid var(--google-gray-200);
    }

    /* ===== Empty State ===== */
    .google-empty-state {
        background: var(--google-white);
        border: 1px solid var(--google-gray-200);
        border-radius: var(--google-radius);
        padding: var(--google-spacing-2xl) var(--google-spacing-lg);
        text-align: center;
        max-width: 480px;
        margin: 0 auto;
    }
    
    .google-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto var(--google-spacing-lg);
        color: var(--google-gray-400);
    }
    
    .google-empty-title {
        font-family: var(--google-font);
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-sm) 0;
    }
    
    .google-empty-text {
        font-family: var(--google-font);
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--google-gray-700);
        margin: 0 0 var(--google-spacing-lg) 0;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .google-header-content {
            flex-direction: column;
            align-items: stretch;
            gap: var(--google-spacing-md);
        }
        
        .google-search-wrapper {
            max-width: 100%;
        }
        
        .google-page-title {
            font-size: 1.5rem;
        }
        
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-md);
        }
        
        .google-stat-value {
            font-size: 1.75rem;
        }
        
        .google-list-item {
            flex-direction: column;
            align-items: flex-start;
            padding: var(--google-spacing-md);
        }
        
        .google-list-actions {
            width: 100%;
            justify-content: flex-end;
        }
        
        .google-list-stats {
            gap: var(--google-spacing-md);
        }
        
        .google-stat-pill-value {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .google-page-header {
            margin-bottom: var(--google-spacing-lg);
        }
        
        .google-stats-grid {
            grid-template-columns: 1fr;
            margin-bottom: var(--google-spacing-lg);
        }
        
        .google-stat-card {
            padding: var(--google-spacing-md);
        }
        
        .google-list-item {
            padding: var(--google-spacing-md);
        }
        
        .google-list-header {
            margin-bottom: var(--google-spacing-sm);
        }
        
        .google-list-title {
            font-size: 1rem;
        }
        
        .google-list-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-sm);
            width: 100%;
        }
        
        .google-empty-state {
            padding: var(--google-spacing-xl) var(--google-spacing-md);
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
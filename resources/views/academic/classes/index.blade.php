@extends('layouts.dashboard')

@section('title', __('app.classes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.classes') }}</li>
@endsection



@section('header-actions')
    @admin
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            {{ __('app.add_class') }}
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Statistics Cards - Material Design -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-primary-subtle">
                    <i class="fas fa-school stats-icon text-primary"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.total_classes') }}</p>
                    <h3 class="stats-value">{{ $classes->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-success-subtle">
                    <i class="fas fa-user-graduate stats-icon text-success"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.total_etudiants') }}</p>
                    <h3 class="stats-value">{{ $classes->sum('etudiants_count') }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-info-subtle">
                    <i class="fas fa-layer-group stats-icon text-info"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.niveau_minimum') }}</p>
                    <h3 class="stats-value">{{ $classes->min('niveau') ?? 0 }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper bg-warning-subtle">
                    <i class="fas fa-chart-line stats-icon text-warning"></i>
                </div>
                <div class="stats-content">
                    <p class="stats-label">{{ __('app.niveau_maximum') }}</p>
                    <h3 class="stats-value">{{ $classes->max('niveau') ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes Section Header -->
    <div class="section-header mb-4">
        <h5 class="section-title">{{ __('app.liste_classes') }}</h5>
    </div>

    @if($classes->count() > 0)
        <div class="row g-4">
            @foreach($classes as $item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="class-card">
                        <!-- Card Header -->
                        <div class="class-card-header">
                            <div class="class-info">
                                <h6 class="class-name">{{ $item->nom_classe }}</h6>
                                <span class="class-badge">{{ __('app.niveau') }} {{ $item->niveau }}</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn-icon-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end material-dropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('classes.show', $item->id_classe) }}">
                                            <i class="fas fa-eye me-2"></i>{{ __('app.voir') }}
                                        </a>
                                    </li>
                                    @admin
                                    <li>
                                        <a class="dropdown-item" href="{{ route('classes.edit', $item->id_classe) }}">
                                            <i class="fas fa-edit me-2"></i>{{ __('app.modifier') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('classes.destroy', $item->id_classe) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item text-danger delete-class" data-class-name="{{ $item->nom_classe }}">
                                                <i class="fas fa-trash-alt me-2"></i>{{ __('app.supprimer') }}
                                            </button>
                                        </form>
                                    </li>
                                    @endadmin
                                </ul>
                            </div>
                        </div>

                        <!-- Card Stats -->
                        <div class="class-stats">
                            <div class="stat-item">
                                <i class="fas fa-user-graduate stat-icon"></i>
                                <div class="stat-details">
                                    <span class="stat-value">{{ $item->etudiants->count() }}</span>
                                    <span class="stat-label">{{ __('app.etudiants') }}</span>
                                </div>
                            </div>
                            
                            <div class="stat-item">
                                <i class="fas fa-chalkboard-teacher stat-icon"></i>
                                <div class="stat-details">
                                    <span class="stat-value">{{ $item->enseignants_count ?? 0 }}</span>
                                    <span class="stat-label">{{ __('app.enseignants') }}</span>
                                </div>
                            </div>
                            
                            <div class="stat-item">
                                <i class="fas fa-book stat-icon"></i>
                                <div class="stat-details">
                                    <span class="stat-value">{{ $item->cours_count ?? 0 }}</span>
                                    <span class="stat-label">{{ __('app.cours') }}</span>
                                </div>
                            </div>
                            
                            <div class="stat-item">
                                <i class="fas fa-clipboard-check stat-icon"></i>
                                <div class="stat-details">
                                    <span class="stat-value">{{ $item->evaluations->count() }}</span>
                                    <span class="stat-label">{{ __('app.evaluations') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="class-card-footer">
                            <a href="{{ route('classes.show', $item->id_classe) }}" class="btn-view-details">
                                {{ __('app.voir_details') }}
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-school"></i>
            </div>
            <h4 class="empty-state-title">{{ __('app.no_data') }}</h4>
            <p class="empty-state-text">{{ __('app.aucune_classe_creee') }}</p>
            @admin
                <a href="{{ route('classes.create') }}" class="btn btn-primary btn-elevated">
                    <i class="fas fa-plus me-2"></i>{{ __('app.creer_premiere_classe') }}
                </a>
            @endadmin
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
        --md-danger: #dc3545;
        
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
        letter-spacing: 0.2px;
    }
    
    .stats-value {
        font-size: 2rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0;
        line-height: 1;
    }

    /* ===== Section Header ===== */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0;
        letter-spacing: -0.3px;
    }

    /* ===== Class Cards ===== */
    .class-card {
        background: white;
        border-radius: var(--md-radius);
        border: 1px solid var(--md-gray-200);
        overflow: hidden;
        transition: var(--md-transition);
        box-shadow: var(--md-shadow-sm);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .class-card:hover {
        box-shadow: var(--md-shadow-lg);
        transform: translateY(-4px);
        border-color: var(--md-gray-300);
    }
    
    .class-card-header {
        padding: 1.25rem 1.25rem 1rem;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        border-bottom: 1px solid var(--md-gray-200);
    }
    
    .class-info {
        flex: 1;
        min-width: 0;
    }
    
    .class-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.2px;
    }
    
    .class-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(13, 110, 253, 0.1);
        color: var(--md-primary);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 100px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    
    .btn-icon-menu {
        width: 32px;
        height: 32px;
        border: none;
        background: transparent;
        color: var(--md-gray-600);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--md-transition);
        cursor: pointer;
        flex-shrink: 0;
    }
    
    .btn-icon-menu:hover {
        background: var(--md-gray-100);
        color: var(--md-gray-900);
    }
    
    .btn-icon-menu:active {
        transform: scale(0.95);
    }

    /* ===== Class Stats Grid ===== */
    .class-stats {
        padding: 1.25rem;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        flex: 1;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: var(--md-gray-50);
        border-radius: var(--md-radius-sm);
        transition: var(--md-transition);
    }
    
    .stat-item:hover {
        background: var(--md-gray-100);
    }
    
    .stat-icon {
        font-size: 1.25rem;
        color: var(--md-gray-500);
        flex-shrink: 0;
    }
    
    .stat-details {
        flex: 1;
        min-width: 0;
    }
    
    .stat-value {
        display: block;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--md-gray-900);
        line-height: 1.2;
    }
    
    .stat-label {
        display: block;
        font-size: 0.75rem;
        color: var(--md-gray-600);
        margin-top: 2px;
        font-weight: 500;
    }

    /* ===== Card Footer ===== */
    .class-card-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--md-gray-200);
        background: var(--md-gray-50);
    }
    
    .btn-view-details {
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
        border: none;
        letter-spacing: 0.3px;
    }
    
    .btn-view-details:hover {
        background: var(--md-primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    .btn-view-details:active {
        transform: translateY(0);
    }
    
    .btn-view-details i {
        font-size: 0.875rem;
        transition: var(--md-transition);
    }
    
    .btn-view-details:hover i {
        transform: translateX(4px);
    }

    /* ===== Material Dropdown ===== */
    .material-dropdown {
        border: none;
        box-shadow: var(--md-shadow-lg);
        border-radius: var(--md-radius-sm);
        padding: 0.5rem 0;
        min-width: 180px;
    }
    
    .material-dropdown .dropdown-item {
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        color: var(--md-gray-700);
        transition: var(--md-transition);
        display: flex;
        align-items: center;
    }
    
    .material-dropdown .dropdown-item:hover {
        background: var(--md-gray-100);
        color: var(--md-gray-900);
    }
    
    .material-dropdown .dropdown-item:active {
        background: var(--md-gray-200);
    }
    
    .material-dropdown .dropdown-item i {
        font-size: 0.875rem;
        width: 20px;
    }
    
    .material-dropdown .dropdown-divider {
        margin: 0.5rem 0;
        border-color: var(--md-gray-200);
    }

    /* ===== Empty State ===== */
    .empty-state {
        background: white;
        border-radius: var(--md-radius);
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: var(--md-shadow-sm);
        border: 1px solid var(--md-gray-200);
    }
    
    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--md-gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-state-icon i {
        font-size: 2.5rem;
        color: var(--md-gray-400);
    }
    
    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--md-gray-900);
        margin-bottom: 0.5rem;
    }
    
    .empty-state-text {
        font-size: 1rem;
        color: var(--md-gray-600);
        margin-bottom: 2rem;
    }
    
    .btn-elevated {
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.25);
        transition: var(--md-transition);
    }
    
    .btn-elevated:hover {
        box-shadow: 0 4px 16px rgba(13, 110, 253, 0.35);
        transform: translateY(-2px);
    }

    /* ===== RTL Support ===== */
    [dir="rtl"] .stats-icon-wrapper {
        margin-left: 1.25rem;
        margin-right: 0;
    }
    
    [dir="rtl"] .btn-view-details i {
        margin-right: 0.5rem;
        margin-left: 0;
    }
    
    [dir="rtl"] .btn-view-details:hover i {
        transform: translateX(-4px);
    }
    
    [dir="rtl"] .material-dropdown .dropdown-item i {
        margin-right: 0;
        margin-left: 0.5rem;
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
    }
    
    @media (max-width: 767.98px) {
        .stats-card {
            padding: 1rem;
        }
        
        .stats-label {
            font-size: 0.8125rem;
        }
        
        .class-card-header {
            padding: 1rem;
        }
        
        .class-stats {
            padding: 1rem;
            gap: 0.75rem;
        }
        
        .stat-item {
            padding: 0.625rem;
        }
        
        .class-card-footer {
            padding: 0.875rem 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .stats-value {
            font-size: 1.5rem;
        }
        
        .class-name {
            font-size: 1rem;
        }
        
        .stat-value {
            font-size: 1.125rem;
        }
        
        .empty-state {
            padding: 3rem 1.5rem;
        }
        
        .empty-state-icon {
            width: 64px;
            height: 64px;
        }
        
        .empty-state-icon i {
            font-size: 2rem;
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
});
</script>
@endpush

@extends('layouts.dashboard')

@section('title', __('app.etudiants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.etudiants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
            {{ __('app.add_student') }}
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <i class="bi bi-people"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.total_etudiants') }}</div>
                <div class="stats-value">{{ $etudiants->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                <i class="bi bi-gender-male"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.etudiants_hommes') }}</div>
                <div class="stats-value">{{ $etudiants->where('genre', 'masculin')->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #d63384 0%, #c22773 100%);">
                <i class="bi bi-gender-female"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.etudiantes_femmes') }}</div>
                <div class="stats-value">{{ $etudiants->where('genre', 'feminin')->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <i class="bi bi-building"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.classes_actives') }}</div>
                <div class="stats-value">{{ $etudiants->pluck('classe')->unique()->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="table-card">
        <div class="table-header">
            <div>
                <h5 class="table-title">{{ __('app.liste_etudiants') }}</h5>
                <p class="table-subtitle">Gérez les étudiants et leurs informations</p>
            </div>
        </div>

        @if($etudiants->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.nom_complet') }}</th>
                            <th>{{ __('app.email') }}</th>
                            <th>{{ __('app.telephone') }}</th>
                            <th>{{ __('app.classe') }}</th>
                            <th>{{ __('app.genre') }}</th>
                            <th class="text-center">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>
                                    <div class="student-name">
                                        <div class="student-avatar">
                                            {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                                        </div>
                                        <strong>{{ $etudiant->prenom }} {{ $etudiant->nom }}</strong>
                                    </div>
                                </td>
                                <td>
                                    @if($etudiant->email)
                                        <a href="mailto:{{ $etudiant->email }}" class="email-link">
                                            <i class="bi bi-envelope"></i>
                                            {{ $etudiant->email }}
                                        </a>
                                    @else
                                        <span class="text-na">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->telephone)
                                        <a href="tel:{{ $etudiant->telephone }}" class="phone-link">
                                            <i class="bi bi-telephone"></i>
                                            {{ $etudiant->telephone }}
                                        </a>
                                    @else
                                        <span class="text-na">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->classe)
                                        <span class="badge-classe">{{ $etudiant->classe->nom_classe }}</span>
                                    @else
                                        <span class="text-not-assigned">Non assigné</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->genre)
                                        <span class="badge-genre {{ $etudiant->genre == 'masculin' ? 'badge-male' : 'badge-female' }}">
                                            <i class="bi bi-gender-{{ $etudiant->genre == 'masculin' ? 'male' : 'female' }}"></i>
                                            {{ ucfirst($etudiant->genre) }}
                                        </span>
                                    @else
                                        <span class="text-na">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('etudiants.show', $etudiant) }}" 
                                           class="btn-action btn-view" 
                                           title="{{ __('app.voir') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @admin
                                            <a href="{{ route('etudiants.edit', $etudiant) }}" 
                                               class="btn-action btn-edit" 
                                               title="{{ __('app.modifier') }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('etudiants.destroy', $etudiant) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="btn-action btn-delete delete-student" 
                                                        title="{{ __('app.supprimer') }}"
                                                        data-student-name="{{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endadmin
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h4 class="empty-title">{{ __('app.no_data') }}</h4>
                <p class="empty-text">{{ __('app.aucun_etudiant_trouve') }}</p>
                @admin
                    <a href="{{ route('etudiants.create') }}" class="btn-empty-action">
                        <i class="bi bi-plus-circle"></i>
                        {{ __('app.ajouter_etudiant') }}
                    </a>
                @endadmin
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #0d6efd;
        --primary-dark: #0a58ca;
        --success-color: #198754;
        --info-color: #0dcaf0;
        --pink-color: #d63384;
        --pink-dark: #c22773;
        --bg-white: #ffffff;
        --bg-light: #f8f9fa;
        --bg-gray-50: #fafafa;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --text-light: #868e96;
        --border-color: #dee2e6;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .stats-card {
        background: var(--bg-white);
        border-radius: 12px;
        padding: 24px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [dir="rtl"] .stats-card {
        flex-direction: row-reverse;
    }

    .stats-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-3px);
    }

    .stats-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stats-icon i {
        font-size: 28px;
        color: var(--bg-white);
    }

    .stats-content {
        flex: 1;
    }

    .stats-label {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 6px;
        font-weight: 500;
    }

    .stats-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    /* Table Card */
    .table-card {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .table-header {
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    [dir="rtl"] .table-header {
        flex-direction: row-reverse;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 4px 0;
    }

    .table-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background: var(--bg-gray-50);
        padding: 16px 20px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border-color);
        white-space: nowrap;
    }

    [dir="rtl"] .modern-table thead th {
        text-align: right;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background: var(--bg-light);
    }

    .modern-table tbody td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
        color: var(--text-dark);
        vertical-align: middle;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Student Name with Avatar */
    .student-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    [dir="rtl"] .student-name {
        flex-direction: row-reverse;
    }

    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* Email and Phone Links */
    .email-link,
    .phone-link {
        color: var(--text-dark);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s ease;
    }

    [dir="rtl"] .email-link,
    [dir="rtl"] .phone-link {
        flex-direction: row-reverse;
    }

    .email-link:hover {
        color: var(--primary-color);
    }

    .phone-link:hover {
        color: var(--success-color);
    }

    .email-link i,
    .phone-link i {
        font-size: 14px;
        opacity: 0.7;
    }

    .text-na {
        color: var(--text-muted);
        font-style: italic;
        font-size: 13px;
    }

    /* Badges */
    .badge-classe {
        display: inline-block;
        padding: 6px 12px;
        background: var(--bg-light);
        color: var(--text-dark);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-genre {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    [dir="rtl"] .badge-genre {
        flex-direction: row-reverse;
    }

    .badge-male {
        background: rgba(13, 202, 240, 0.1);
        color: var(--info-color);
    }

    .badge-female {
        background: rgba(214, 51, 132, 0.1);
        color: var(--pink-color);
    }

    .text-not-assigned {
        color: var(--text-muted);
        font-style: italic;
        font-size: 13px;
    }

    /* Action Buttons */
    .action-buttons {
        display: inline-flex;
        gap: 8px;
        align-items: center;
    }

    [dir="rtl"] .action-buttons {
        flex-direction: row-reverse;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        background: transparent;
    }

    .btn-view {
        color: var(--info-color);
        background: rgba(13, 202, 240, 0.1);
    }

    .btn-view:hover {
        background: rgba(13, 202, 240, 0.2);
        transform: scale(1.1);
    }

    .btn-edit {
        color: var(--primary-color);
        background: rgba(13, 110, 253, 0.1);
    }

    .btn-edit:hover {
        background: rgba(13, 110, 253, 0.2);
        transform: scale(1.1);
    }

    .btn-delete {
        color: #dc3545;
        background: rgba(220, 53, 69, 0.1);
    }

    .btn-delete:hover {
        background: rgba(220, 53, 69, 0.2);
        transform: scale(1.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, var(--bg-light) 0%, var(--bg-gray-50) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 40px;
        color: var(--text-light);
    }

    .empty-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px 0;
    }

    .empty-text {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0 0 24px 0;
    }

    .btn-empty-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [dir="rtl"] .btn-empty-action {
        flex-direction: row-reverse;
    }

    .btn-empty-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        color: var(--bg-white);
    }

    /* Responsive Design */
    @media (max-width: 1400px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .stats-card {
            padding: 20px;
        }
    }

    @media (max-width: 992px) {
        .stats-icon {
            width: 52px;
            height: 52px;
        }
        
        .stats-icon i {
            font-size: 26px;
        }
        
        .stats-value {
            font-size: 26px;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 14px 16px;
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stats-card {
            padding: 16px;
            gap: 12px;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
        }

        .stats-icon i {
            font-size: 22px;
        }

        .stats-value {
            font-size: 22px;
        }

        .table-header {
            padding: 16px 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .table-title {
            font-size: 16px;
        }

        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px 14px;
        }

        .student-avatar {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }

        .badge-classe,
        .badge-genre {
            font-size: 11px;
            padding: 5px 10px;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .stats-icon {
            width: 44px;
            height: 44px;
        }
        
        .stats-icon i {
            font-size: 20px;
        }
        
        .stats-value {
            font-size: 24px;
        }
        
        .table-header {
            padding: 16px;
        }
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modern-table {
            min-width: 800px;
        }
        
        .student-avatar {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }

        .empty-state {
            padding: 50px 20px;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
        }

        .empty-icon i {
            font-size: 28px;
        }
    }

    @media (max-width: 400px) {
        .stats-card {
            padding: 14px;
        }
        
        .stats-icon {
            width: 40px;
            height: 40px;
        }
        
        .stats-icon i {
            font-size: 18px;
        }
        
        .stats-value {
            font-size: 20px;
        }
        
        .student-avatar {
            width: 30px;
            height: 30px;
            font-size: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-student').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const studentName = this.dataset.studentName;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'étudiant "${studentName}" ?`)) {
                form.submit();
            }
        });
    });
});
</script>
@endpush

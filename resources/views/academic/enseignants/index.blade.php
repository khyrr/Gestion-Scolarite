@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_enseignant') }}
        </a>
    @endadmin
@endsection

@section('content')
    <div class="google-container">
        <!-- Statistics Cards -->
        <div class="google-stats-grid">
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.total_enseignants') }}</div>
                <div class="google-stat-value">{{ $enseignant->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.actifs_ce_mois') }}</div>
                <div class="google-stat-value">{{ $enseignant->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.matieres_enseignees') }}</div>
                <div class="google-stat-value">{{ $enseignant->pluck('matieres')->flatten()->unique('id_matiere')->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.classes_assignees') }}</div>
                <div class="google-stat-value">{{ $enseignant->filter(function($e) { return $e->classes->count() > 0; })->count() }}</div>
            </div>
        </div>

        <!-- Enseignants Table -->
        <div class="google-table-wrapper">
            <div class="google-table-header">
                <h2 class="google-table-title">{{ __('app.liste_enseignants') }}</h2>
            </div>

            @if($enseignant->count() > 0)
                <div class="google-table-container">
                    <table class="google-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.nom_complet') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.telephone') }}</th>
                                <th>{{ __('app.matiere') }}</th>
                                <th>{{ __('app.classe') }}</th>
                                <th>{{ __('app.date_ajout') }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignant as $item)
                                <tr>
                                    <td>
                                        <div class="google-teacher-name">
                                            <div class="google-avatar">
                                                {{ substr($item->prenom, 0, 1) }}{{ substr($item->nom, 0, 1) }}
                                            </div>
                                            <span class="google-name">{{ $item->prenom }} {{ $item->nom }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $item->email }}" class="google-link">{{ $item->email }}</a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $item->telephone }}" class="google-link">{{ $item->telephone }}</a>
                                    </td>
                                    <td>
                                        @if($item->matieres && $item->matieres->count() > 0)
                                            <span class="google-badge">{{ __('app.' . $item->matieres->first()->code_matiere) }}</span>
                                            @if($item->matieres->count() > 1)
                                                <span class="google-badge google-badge-more">+{{ $item->matieres->count() - 1 }} {{ __('app.autres') }}</span>
                                            @endif
                                        @else
                                            <span class="google-text-na">{{ __('app.non_assigne') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->classes && $item->classes->count() > 0)
                                            <span class="google-badge">{{ $item->classes->first()->nom_classe }}</span>
                                            @if($item->classes->count() > 1)
                                                <span class="google-badge google-badge-more">+{{ $item->classes->count() - 1 }} {{ __('app.autres') }}</span>
                                            @endif
                                        @else
                                            <span class="google-text-na">{{ __('app.non_assigne') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @include('academic.enseignants.partials.actions', ['teacher' => $item])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($enseignant->hasPages())
                    <div class="google-pagination-wrapper">
                        {{ $enseignant->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="google-empty-state">
                    <svg class="google-empty-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h4 class="google-empty-title">{{ __('app.no_data') }}</h4>
                    <p class="google-empty-text">{{ __('app.aucun_enseignant_ajoute') }}</p>
                    @admin
                        <a href="{{ route('enseignants.create') }}" class="google-btn google-btn-primary">
                            {{ __('app.ajouter_premier_enseignant') }}
                        </a>
                    @endadmin
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
    :root {
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-gray-50: #f8f9fa;
        --google-gray-100: #f1f3f4;
        --google-gray-200: #e8eaed;
        --google-gray-300: #dadce0;
        --google-gray-500: #9aa0a6;
        --google-gray-600: #80868b;
        --google-gray-700: #5f6368;
        --google-gray-900: #202124;
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    .google-container {
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    /* Stats Grid */
    .google-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-xl);
        padding: var(--google-spacing-lg);
    }

    .google-stat-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-lg);
        text-align: center;
    }

    .google-stat-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-sm);
    }

    .google-stat-value {
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
    }

    /* Table Wrapper */
    .google-table-wrapper {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        overflow: hidden;
        margin: 0 var(--google-spacing-lg);
    }

    .google-table-header {
        padding: var(--google-spacing-lg);
        border-bottom: 1px solid var(--google-gray-300);
    }

    .google-table-title {
        font-size: 1.25rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0;
    }

    /* Table */
    .google-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .google-table {
        width: 100%;
        border-collapse: collapse;
    }

    .google-table thead th {
        background: var(--google-gray-50);
        padding: var(--google-spacing-md);
        text-align: left;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--google-gray-700);
        border-bottom: 1px solid var(--google-gray-300);
        white-space: nowrap;
    }

    .google-table tbody tr {
        transition: var(--google-transition);
        border-bottom: 1px solid var(--google-gray-200);
    }

    .google-table tbody tr:hover {
        background: var(--google-gray-50);
    }

    .google-table tbody td {
        padding: var(--google-spacing-md);
        font-size: 0.875rem;
        color: var(--google-gray-900);
        vertical-align: middle;
        white-space: nowrap;
    }

    .google-table tbody tr:last-child {
        border-bottom: none;
    }

    .google-teacher-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .google-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--google-blue);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .google-name {
        font-weight: 400;
        color: var(--google-gray-900);
    }

    .google-link {
        color: var(--google-blue);
        text-decoration: none;
        transition: var(--google-transition);
    }

    .google-link:hover {
        color: var(--google-blue-hover);
        text-decoration: underline;
    }

    .google-badge {
        display: inline-block;
        padding: 4px 12px;
        background: var(--google-gray-100);
        color: var(--google-gray-700);
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 400;
        white-space: nowrap;
        margin: 2px;
    }

    .google-badge-more {
        background: var(--google-gray-200);
        color: var(--google-gray-600);
        font-size: 0.7rem;
    }

    .google-text-na {
        color: var(--google-gray-500);
        font-size: 0.875rem;
    }

    /* Action Buttons */
    .google-action-buttons {
        display: inline-flex;
        gap: var(--google-spacing-xs);
        align-items: center;
    }

    .google-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: var(--google-transition);
        color: var(--google-gray-600);
    }

    .google-action-btn:hover {
        background: var(--google-gray-100);
        color: var(--google-blue);
    }

    .google-action-delete:hover {
        background: var(--google-gray-100);
        color: #d93025;
    }

    /* Empty State */
    .google-empty-state {
        text-align: center;
        padding: var(--google-spacing-2xl);
    }

    .google-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto var(--google-spacing-md);
        color: var(--google-gray-400);
    }

    .google-empty-title {
        font-size: 1rem;
        font-weight: 400;
        color: var(--google-gray-700);
        margin: 0 0 var(--google-spacing-sm) 0;
    }

    .google-empty-text {
        font-size: 0.875rem;
        color: var(--google-gray-600);
        margin: 0 0 var(--google-spacing-lg) 0;
    }

    /* Buttons */
    .google-btn {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: var(--google-transition);
        text-decoration: none;
    }

    .google-btn-primary {
        background: var(--google-blue);
        color: white;
    }

    .google-btn-primary:hover {
        background: var(--google-blue-hover);
        box-shadow: var(--google-shadow-1);
        color: white;
    }

    /* Pagination */
    .google-pagination-wrapper {
        padding: var(--google-spacing-lg);
        border-top: 1px solid var(--google-gray-300);
    }

    .google-pagination-wrapper .pagination {
        margin: 0;
        justify-content: center;
        gap: var(--google-spacing-xs);
    }

    .google-pagination-wrapper .page-link {
        color: var(--google-gray-700);
        background: transparent;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        transition: var(--google-transition);
        padding: 0;
    }

    .google-pagination-wrapper .page-link:hover {
        background: var(--google-gray-100);
        color: var(--google-blue);
    }

    .google-pagination-wrapper .page-item.active .page-link {
        background: var(--google-blue);
        color: white;
        font-weight: 500;
    }

    .google-pagination-wrapper .page-item.disabled .page-link {
        color: var(--google-gray-400);
        background: transparent;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-sm);
            margin-bottom: var(--google-spacing-lg);
            padding: var(--google-spacing-md);
        }

        .google-stat-card {
            padding: var(--google-spacing-md);
        }

        .google-stat-value {
            font-size: 1.5rem;
        }

        .google-table-wrapper {
            border-radius: 4px;
            margin: 0 var(--google-spacing-md);
        }

        .google-table-header {
            padding: var(--google-spacing-md);
        }

        .google-table-title {
            font-size: 1rem;
        }

        .google-table thead th,
        .google-table tbody td {
            padding: var(--google-spacing-sm);
            font-size: 0.75rem;
        }

        .google-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.7rem;
        }

        .google-teacher-name {
            gap: var(--google-spacing-sm);
        }
    }

    @media (max-width: 576px) {
        .google-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-sm);
            padding: var(--google-spacing-sm);
        }

        .google-stat-card {
            padding: var(--google-spacing-sm) var(--google-spacing-md);
        }

        .google-table-wrapper {
            margin: 0 var(--google-spacing-sm);
        }

        .google-stat-label {
            font-size: 0.7rem;
        }

        .google-stat-value {
            font-size: 1.5rem;
        }

        .google-table-header {
            padding: var(--google-spacing-sm) var(--google-spacing-md);
        }

        .google-table-title {
            font-size: 0.9rem;
        }

        .google-table thead th,
        .google-table tbody td {
            padding: var(--google-spacing-xs) var(--google-spacing-sm);
            font-size: 0.7rem;
        }

        .google-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.65rem;
        }

        .google-badge {
            font-size: 0.65rem;
            padding: 2px 8px;
        }

        .google-action-btn {
            width: 32px;
            height: 32px;
        }

        .google-action-btn svg {
            width: 16px;
            height: 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.delete-enseignant').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: "Voulez-vous vraiment supprimer cet enseignant ?",
            text: "Si vous le supprimez, il disparaîtra pour toujours.",
            icon: "warning",
            type: "warning",
            buttons: ["Annuler", "Oui!"],
            confirmButtonColor: '#d33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endpush

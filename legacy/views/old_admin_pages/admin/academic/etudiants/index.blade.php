@extends('admin.layouts.dashboard')

@section('title', __('app.etudiants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.etudiants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('admin.etudiants.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.ajouter_etudiant') }}</span>
        </a>
    @endadmin
@endsection

@section('content')
<div class="google-container">
    <!-- Statistics Grid -->
    <div class="google-stats-grid">
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.total_etudiants') }}</div>
            <div class="google-stat-value">{{ $etudiants->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.etudiants_hommes') }}</div>
            <div class="google-stat-value">{{ $etudiants->where('genre', 'M')->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.etudiantes_femmes') }}</div>
            <div class="google-stat-value">{{ $etudiants->where('genre', 'F')->count() }}</div>
        </div>
        <div class="google-stat-card">
            <div class="google-stat-label">{{ __('app.classes_actives') }}</div>
            <div class="google-stat-value">{{ $etudiants->pluck('classe')->unique()->count() }}</div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="google-table-wrapper">
        <!-- Add server search form so the component can submit search requests and preserve pagination -->
        <form method="GET" action="{{ route('admin.etudiants.index') }}" id="studentsSearchForm" class="d-none">
            {{-- Hidden container for server-side search param, the component will update/submit this form --}}
            <input type="hidden" name="search" value="{{ request('search') }}" />
        </form>

        @if($etudiants->count() > 0)
            <x-table.data-table title="{{ __('app.liste_etudiants') }}" :showSearch="true" searchValue="{{ request('search') }}" serverFormId="studentsSearchForm" :showSort="true"
                :sortOptions="[
                    '0:asc' => __('Nom A→Z'),
                    '0:desc' => __('Nom Z→A'),
                    '3:asc' => __('Classe A→Z'),
                    '3:desc' => __('Classe Z→A')
                ]">
                <table class="google-table">
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
                                    <div class="google-student-name">
                                        <div class="google-avatar">
                                            {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                                        </div>
                                        <span class="google-name">
                                            <a href="{{ route('admin.etudiants.show', $etudiant) }}"> {{ $etudiant->prenom }} {{ $etudiant->nom }}</a>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if($etudiant->email)
                                        <a href="mailto:{{ $etudiant->email }}" class="google-link">
                                            {{ $etudiant->email }}
                                        </a>
                                    @else
                                        <span class="google-text-na">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->telephone)
                                        <a href="tel:{{ $etudiant->telephone }}" class="google-link">
                                            {{ $etudiant->telephone }}
                                        </a>
                                    @else
                                        <span class="google-text-na">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->classe)
                                        <span class="google-badge">{{ $etudiant->classe->nom_classe }}</span>
                                    @else
                                        <span class="google-text-na">Non assigné</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->genre)
                                        <span class="google-badge-genre">
                                            {{ ucfirst($etudiant->genre) }}
                                        </span>
                                    @else
                                        <span class="google-text-na">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="google-action-buttons">
                                        <a href="{{ route('admin.etudiants.show', $etudiant) }}" 
                                           class="google-action-btn" 
                                           title="{{ __('app.voir') }}"
                                           aria-label="Voir l'étudiant {{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>
                                        @admin
                                            <a href="{{ route('admin.etudiants.edit', $etudiant) }}" 
                                               class="google-action-btn" 
                                               title="{{ __('app.modifier') }}"
                                               aria-label="Modifier l'étudiant {{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('admin.etudiants.destroy', $etudiant) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="google-action-btn google-action-delete delete-student" 
                                                        title="{{ __('app.supprimer') }}"
                                                        aria-label="Supprimer l'étudiant {{ $etudiant->prenom }} {{ $etudiant->nom }}"
                                                        data-student-name="{{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
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

                @slot('footer')
                    @if($etudiants->hasPages())
                        <div class="google-pagination-wrapper">
                            {{ $etudiants->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                @endslot
            </x-table.data-table>
        @else
            <div class="google-empty-state">
                <i class="fas fa-user-graduate google-empty-icon" aria-hidden="true"></i>
                <h4 class="google-empty-title">{{ __('app.no_data') }}</h4>
                <p class="google-empty-text">{{ __('app.aucun_etudiant_trouve') }}</p>
                @admin
                    <a href="{{ route('admin.etudiants.create') }}" class="google-btn google-btn-primary">
                        {{ __('app.ajouter_etudiant') }}
                    </a>
                @endadmin
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Page-Specific Components */
    .google-student-name {
        display: flex;
        align-items: center;
        gap: var(--google-spacing-md);
    }

    .google-badge-genre {
        display: inline-block;
        padding: 4px 12px;
        background: var(--google-gray-100);
        color: var(--google-gray-700);
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 400;
        white-space: nowrap;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .google-student-name {
            gap: var(--google-spacing-sm);
        }
    }

    @media (max-width: 576px) {
        .google-badge-genre {
            font-size: 0.65rem;
            padding: 2px 8px;
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

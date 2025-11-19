@extends('layouts.dashboard')

@section('title', __('app.details_evaluation'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">{{ __('app.evaluations') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.details') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('evaluations.edit', $evaluation->id_evaluation) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>
                {{ __('app.modifier') }}
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash me-1"></i>
                {{ __('app.supprimer') }}
            </button>
        @endadmin
    </div>
@endsection

@section('content')
<div class="google-container">
    <div class="google-detail-wrapper">
        <!-- Evaluation Details Sidebar -->
        <div class="google-detail-sidebar">
            <div class="google-detail-card">
                <h3 class="google-section-title">{{ __('app.details_evaluation') }}</h3>
                
                <div class="google-detail-list">
                    <div class="google-detail-item">
                        <div class="google-detail-label">{{ __('app.matiere') }}</div>
                        <div class="google-detail-value">{{ $evaluation->matiere_name }}</div>
                    </div>

                    <div class="google-detail-item">
                        <div class="google-detail-label">{{ __('app.type') }}</div>
                        <div class="google-detail-value">
                            @if($evaluation->type == 'examen')
                                <span class="google-badge google-badge-red">{{ ucfirst($evaluation->type) }}</span>
                            @elseif($evaluation->type == 'controle')
                                <span class="google-badge google-badge-yellow">{{ ucfirst($evaluation->type) }}</span>
                            @else
                                <span class="google-badge google-badge-green">{{ ucfirst($evaluation->type) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="google-detail-item">
                        <div class="google-detail-label">{{ __('app.classe') }}</div>
                        <div class="google-detail-value">
                            @if($evaluation->classe)
                                <span class="google-badge google-badge-neutral">{{ $evaluation->classe->nom_classe }}</span>
                            @else
                                <span class="google-text-na">—</span>
                            @endif
                        </div>
                    </div>

                    <div class="google-detail-item">
                        <div class="google-detail-label">{{ __('app.date') }}</div>
                        <div class="google-detail-value">
                            {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                        </div>
                    </div>

                    @php
                        $startTime = $evaluation->date_debut ? \Carbon\Carbon::parse($evaluation->date_debut)->format('H:i') : null;
                        $endTime = $evaluation->date_fin ? \Carbon\Carbon::parse($evaluation->date_fin)->format('H:i') : null;
                        $hasValidStart = $startTime && $startTime != '00:00';
                        $hasValidEnd = $endTime && $endTime != '00:00';
                    @endphp

                    @if($hasValidStart || $hasValidEnd)
                        <div class="google-detail-item">
                            <div class="google-detail-label">{{ __('app.horaire') }}</div>
                            <div class="google-detail-value">
                                @if($hasValidStart && $hasValidEnd)
                                    {{ $startTime }} - {{ $endTime }}
                                @elseif($hasValidStart)
                                    {{ $startTime }}
                                @else
                                    {{ $endTime }}
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="google-detail-item">
                        <div class="google-detail-label">{{ __('app.note_max') }}</div>
                        <div class="google-detail-value">{{ $evaluation->note_max }}</div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="google-detail-card">
                <h3 class="google-section-title">{{ __('app.statistiques') }}</h3>
                <div class="google-stats-row">
                    <div class="google-mini-stat">
                        <div class="google-mini-stat-label">{{ __('app.total_etudiants') }}</div>
                        <div class="google-mini-stat-value">{{ $evaluation->notes->count() }}</div>
                    </div>
                    <div class="google-mini-stat">
                        <div class="google-mini-stat-label">{{ __('app.moyenne') }}</div>
                        <div class="google-mini-stat-value">
                            {{ $evaluation->notes->avg('note') ? number_format($evaluation->notes->avg('note'), 2) : '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Notes -->
        <div class="google-detail-main">
            <div class="google-detail-card">
                <h3 class="google-section-title">{{ __('app.notes_etudiants') }}</h3>
                
                @if($evaluation->notes->count() > 0)
                    <div class="google-table-container">
                        <table class="google-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>{{ __('app.etudiant') }}</th>
                                    <th>{{ __('app.note') }}</th>
                                    <th>{{ __('app.appreciation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($evaluation->notes->sortBy('etudiant.nom') as $note)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="google-table-text">
                                                {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $percentage = ($note->note / $evaluation->note_max) * 100;
                                            @endphp
                                            <span class="google-note-badge">
                                                {{ number_format($note->note, 2) }} / {{ $evaluation->note_max }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($percentage >= 80)
                                                <span class="google-badge google-badge-green">{{ __('app.excellent') }}</span>
                                            @elseif($percentage >= 60)
                                                <span class="google-badge google-badge-blue">{{ __('app.bien') }}</span>
                                            @elseif($percentage >= 50)
                                                <span class="google-badge google-badge-yellow">{{ __('app.passable') }}</span>
                                            @else
                                                <span class="google-badge google-badge-red">{{ __('app.insuffisant') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="google-empty-state">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3>{{ __('app.aucune_note') }}</h3>
                        <p>{{ __('app.aucune_note_enregistree') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --google-blue: #1a73e8;
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

    .google-detail-wrapper {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: var(--google-spacing-lg);
        padding: var(--google-spacing-lg);
    }

    .google-detail-sidebar {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-lg);
    }

    .google-detail-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-lg);
    }

    .google-section-title {
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-lg) 0;
    }

    .google-detail-list {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-md);
    }

    .google-detail-item {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-xs);
        padding-bottom: var(--google-spacing-md);
        border-bottom: 1px solid var(--google-gray-200);
    }

    .google-detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .google-detail-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
    }

    .google-detail-value {
        font-size: 0.875rem;
        color: var(--google-gray-900);
        font-weight: 500;
    }

    .google-stats-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--google-spacing-md);
    }

    .google-mini-stat {
        text-align: center;
        padding: var(--google-spacing-md);
        background: var(--google-gray-50);
        border-radius: 4px;
    }

    .google-mini-stat-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-xs);
    }

    .google-mini-stat-value {
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--google-gray-900);
    }

    .google-detail-main {
        display: flex;
        flex-direction: column;
    }

    .google-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .google-table {
        width: 100%;
        border-collapse: collapse;
    }

    .google-table thead th {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--google-gray-700);
        text-align: left;
        padding: 12px 16px;
        border-bottom: 1px solid var(--google-gray-300);
        white-space: nowrap;
    }

    .google-table tbody td {
        font-size: 0.875rem;
        color: var(--google-gray-900);
        padding: 12px 16px;
        border-bottom: 1px solid var(--google-gray-200);
        white-space: nowrap;
    }

    .google-table tbody tr:hover {
        background: var(--google-gray-50);
    }

    .google-table-text {
        font-weight: 500;
    }

    .google-note-badge {
        display: inline-block;
        padding: 4px 12px;
        background: var(--google-gray-100);
        color: var(--google-gray-900);
        border-radius: 4px;
        font-size: 0.8125rem;
        font-weight: 500;
    }

    .google-badge {
        display: inline-block;
        padding: 4px 12px;
        font-size: 0.75rem;
        border-radius: 16px;
        font-weight: 500;
    }

    .google-badge-red {
        background: #fce8e6;
        color: #c5221f;
    }

    .google-badge-yellow {
        background: #fef7e0;
        color: #f9ab00;
    }

    .google-badge-green {
        background: #e6f4ea;
        color: #1e8e3e;
    }

    .google-badge-blue {
        background: #e8f0fe;
        color: #1a73e8;
    }

    .google-badge-neutral {
        background: var(--google-gray-100);
        color: var(--google-gray-700);
    }

    .google-text-na {
        color: var(--google-gray-500);
    }

    .google-empty-state {
        text-align: center;
        padding: var(--google-spacing-2xl) var(--google-spacing-lg);
    }

    .google-empty-state svg {
        color: var(--google-gray-500);
        margin-bottom: var(--google-spacing-md);
    }

    .google-empty-state h3 {
        font-size: 1.125rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0 0 var(--google-spacing-sm) 0;
    }

    .google-empty-state p {
        font-size: 0.875rem;
        color: var(--google-gray-600);
        margin: 0;
    }

    @media (max-width: 1024px) {
        .google-detail-wrapper {
            grid-template-columns: 280px 1fr;
        }
    }

    @media (max-width: 768px) {
        .google-detail-wrapper {
            grid-template-columns: 1fr;
            padding: var(--google-spacing-md);
        }

        .google-stats-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .google-detail-wrapper {
            padding: var(--google-spacing-sm);
        }

        .google-detail-card {
            padding: var(--google-spacing-md);
        }

        .google-section-title {
            font-size: 1rem;
        }

        .google-table thead th,
        .google-table tbody td {
            font-size: 0.75rem;
            padding: 8px 10px;
        }

        .google-badge {
            font-size: 0.6875rem;
            padding: 3px 8px;
        }

        .google-mini-stat-value {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">{{ __('app.confirmer_suppression_evaluation') }}</p>
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ __('app.action_irreversible') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('app.annuler') }}
                </button>
                <form method="POST" action="{{ route('evaluations.destroy', $evaluation->id_evaluation) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        {{ __('app.supprimer_definitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

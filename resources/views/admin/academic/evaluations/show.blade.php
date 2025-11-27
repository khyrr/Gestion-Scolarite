@extends('admin.layouts.dashboard')

@section('title', __('app.details_evaluation'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.evaluations.index') }}">{{ __('app.evaluations') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.details') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.retour') }}</span>
        </a>
        @admin
            <a href="{{ route('admin.evaluations.edit', $evaluation->id_evaluation) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                <span class="d-none d-lg-inline ms-2">{{ __('app.modifier') }}</span>
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash"></i>
                <span class="d-none d-lg-inline ms-2">{{ __('app.supprimer') }}</span>
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
                        <i class="fas fa-clipboard empty-icon" aria-hidden="true"></i>
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
    /* Page-Specific Detail Layout */
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

    .google-detail-main {
        display: flex;
        flex-direction: column;
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
    }

    @media (max-width: 480px) {
        .google-detail-wrapper {
            padding: var(--google-spacing-sm);
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
                <form method="POST" action="{{ route('admin.evaluations.destroy', $evaluation->id_evaluation) }}" class="d-inline">
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

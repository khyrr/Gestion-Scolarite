@extends('layouts.dashboard')

@section('title', __('app.notes'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.notes') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('rapports.notes.transcript-index') }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-text me-1"></i> {{ __('app.releve_de_notes') }}
        </a>
        <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-clipboard-list me-1"></i> {{ __('app.voir_evaluations') }}
        </a>
    </div>
@endsection

@section('content')
    <!-- Statistics Cards -->
    @php
        $totalNotes = $notes->total();
        $excellentCount = 0;
        $goodCount = 0;
        $averageCount = 0;
        $poorCount = 0;
        $averageGrade = 0;
        
        foreach($notes as $note) {
            $noteMax = $note->evaluation->note_max ?? 20;
            $percentage = ($note->note / $noteMax) * 100;
            $averageGrade += $percentage;
            
            if ($percentage >= 80) $excellentCount++;
            elseif ($percentage >= 60) $goodCount++;
            elseif ($percentage >= 50) $averageCount++;
            else $poorCount++;
        }
        
        $averageGrade = $totalNotes > 0 ? round($averageGrade / $totalNotes, 1) : 0;
    @endphp
    
    <!-- Quick Stats -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <h3 class="mb-0">{{ $totalNotes }}</h3>
                    <small class="text-muted">Total Notes</small>
                </div>
                <div class="col-md-3 border-start">
                    <h3 class="mb-0">{{ $averageGrade }}%</h3>
                    <small class="text-muted">Moyenne Générale</small>
                </div>
                <div class="col-md-3 border-start">
                    <h3 class="mb-0 text-success">{{ $excellentCount }}</h3>
                    <small class="text-muted">Excellent (≥80%)</small>
                </div>
                <div class="col-md-3 border-start">
                    <h3 class="mb-0 text-danger">{{ $poorCount }}</h3>
                    <small class="text-muted">À Améliorer (<50%)</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('notes.index') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <!-- Search -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small text-muted">{{ __('app.rechercher_etudiant') }}</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Nom ou prénom..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <!-- Class Filter -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small text-muted">{{ __('app.classe') }}</label>
                        <select name="classe" class="form-select">
                            <option value="">{{ __('app.toutes_classes') }}</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id_classe }}" {{ request('classe') == $classe->id_classe ? 'selected' : '' }}>
                                    {{ $classe->nom_classe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Evaluation Filter -->
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label small text-muted">{{ __('app.evaluation') }}</label>
                        <select name="evaluation" class="form-select">
                            <option value="">{{ __('app.toutes_evaluations') }}</option>
                            @foreach($evaluations as $evaluation)
                                <option value="{{ $evaluation->id_evaluation }}" {{ request('evaluation') == $evaluation->id_evaluation ? 'selected' : '' }}>
                                    {{ $evaluation->matiere_name }} - {{ $evaluation->titre ?? ucfirst($evaluation->type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="col-lg-2 col-md-6">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">Filtrer</button>
                            @if(request()->hasAny(['search', 'classe', 'evaluation']))
                                <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary" title="Réinitialiser">
                                    <i class="fas fa-redo"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Notes List -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>{{ __('app.liste_notes') }} ({{ $notes->total() }})</h5>
                @if($notes->count() > 0)
                    <small class="text-muted">
                        {{ $notes->firstItem() }}-{{ $notes->lastItem() }} sur {{ $notes->total() }}
                    </small>
                @endif
            </div>
            @if($notes->count() > 0)
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table table-hover align-middle" style="min-width: 800px;">
                        <thead>
                            <tr class="border-bottom">
                                <th class="text-muted fw-normal">{{ __('app.etudiant') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.classe') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.evaluation') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.matiere') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.note') }}</th>
                                <th class="text-muted fw-normal">{{ __('app.appreciation') }}</th>
                                <th class="text-muted fw-normal text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                @php
                                    $noteMax = $note->evaluation->note_max ?? 20;
                                    $percentage = ($note->note / $noteMax) * 100;
                                    $badgeClass = $percentage >= 80 ? 'success' : 
                                                 ($percentage >= 60 ? 'primary' : 
                                                 ($percentage >= 50 ? 'warning' : 'danger'));
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('etudiants.show', $note->etudiant) }}" class="text-decoration-none">
                                            {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                        </a>
                                    </td>
                                    <td>{{ $note->classe->nom_classe ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('evaluations.show', $note->evaluation) }}" class="text-decoration-none">
                                            {{ $note->evaluation->titre ?? ucfirst($note->evaluation->type) }}
                                        </a>
                                        <br>
                                        <small class="text-muted">{{ $note->evaluation->date->format('d/m/Y') }}</small>
                                    </td>
                                    <td>{{ $note->matiere->nom_matiere ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $badgeClass }}">
                                            {{ number_format($note->note, 2) }} / {{ $noteMax }}
                                        </span>
                                        <small class="text-muted">({{ round($percentage) }}%)</small>
                                    </td>
                                    <td>
                                        @php
                                            if ($percentage >= 80) $appreciation = __('app.excellent');
                                            elseif ($percentage >= 60) $appreciation = __('app.bien');
                                            elseif ($percentage >= 50) $appreciation = __('app.passable');
                                            else $appreciation = __('app.insuffisant');
                                        @endphp
                                        <small class="text-muted">{{ $appreciation }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            @admin
                                                <a href="{{ route('notes.edit', $note) }}" 
                                                   class="btn btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="btn btn-outline-danger delete-note" 
                                                            data-student-name="{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}">
                                                        <i class="fas fa-trash"></i>
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
                
                <!-- Pagination -->
                @if($notes->hasPages())
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="text-muted small">
                                {{ __('app.affichage_de') }} <strong>{{ $notes->firstItem() }}</strong> {{ __('app.a') }} <strong>{{ $notes->lastItem() }}</strong> {{ __('app.sur') }} <strong>{{ $notes->total() }}</strong> {{ __('app.notes') }}
                            </div>
                            <nav aria-label="Pagination">
                                {{ $notes->onEachSide(1)->links() }}
                            </nav>
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">{{ __('app.aucune_note') }}</h4>
                    <p class="text-muted">{{ __('app.aucune_note_trouvee') }}</p>
                    @if(request()->hasAny(['search', 'classe', 'evaluation']))
                        <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary mt-2">
                            {{ __('app.effacer_les_filtres') }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-note').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const studentName = this.dataset.studentName;
            
            if (confirm(`Êtes-vous sûr de vouloir supprimer cette note pour "${studentName}" ?`)) {
                form.submit();
            }
        });
    });
    
    // Auto-submit on select change
    document.querySelectorAll('select[name="classe"], select[name="evaluation"]').forEach(function(select) {
        select.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* Clean pagination styling */
.pagination {
    margin: 0;
    gap: 0.25rem;
}

.pagination .page-link {
    border: 1px solid #dee2e6;
    color: #6c757d;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    margin: 0 2px;
    transition: all 0.2s;
    text-decoration: none;
}

.pagination .page-link:hover {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #0d6efd;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
    font-weight: 500;
}

.pagination .page-item.disabled .page-link {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #adb5bd;
}

/* Better Previous/Next buttons */
.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    font-weight: 600;
}

/* Hide any duplicate pagination info that Laravel might add */
nav[role="navigation"] .hidden,
nav[role="navigation"] .sr-only,
nav[aria-label="Pagination"] p {
    display: none !important;
}

/* Responsive pagination */
@media (max-width: 768px) {
    .pagination {
        font-size: 0.875rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination .page-link {
        padding: 0.375rem 0.625rem;
    }
    
    .pagination .page-item {
        margin: 2px;
    }
}
</style>
@endpush

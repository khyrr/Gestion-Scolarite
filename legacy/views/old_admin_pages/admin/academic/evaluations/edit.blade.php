@extends('admin.layouts.dashboard')

@section('title', __('app.modifier_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('admin.dashboard') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('admin.evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Modifier') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h2 class="google-form-title">{{ __('Modifier l\'évaluation') }}</h2>
            </div>

            <form method="POST" action="{{ route('admin.evaluations.update', $evaluation) }}">
                @csrf
                @method('PATCH')

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="type">{{ __('Type d\'évaluation') }} <span class="google-required">*</span></label>
                            <select name="type" id="type" class="google-input @error('type') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir" {{ old('type', $evaluation->type) == 'devoir' ? 'selected' : '' }}>{{ __('Devoir') }}</option>
                                <option value="controle" {{ old('type', $evaluation->type) == 'controle' ? 'selected' : '' }}>{{ __('Contrôle') }}</option>
                                <option value="examen" {{ old('type', $evaluation->type) == 'examen' ? 'selected' : '' }}>{{ __('Examen') }}</option>
                            </select>
                            @error('type')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="titre">{{ __('Titre de l\'évaluation') }}</label>
                            <input type="text" name="titre" id="titre" class="google-input @error('titre') is-invalid @enderror" 
                                   value="{{ old('titre', $evaluation->titre) }}" 
                                   placeholder="Ex: Devoir de mathématiques sur les équations">
                            @error('titre')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="id_classe">{{ __('Classe') }} <span class="google-required">*</span></label>
                            <select name="id_classe" id="id_classe" class="google-input @error('id_classe') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe', $evaluation->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="id_matiere">{{ __('Matière') }} <span class="google-required">*</span></label>
                            <select name="id_matiere" id="id_matiere" class="google-input @error('id_matiere') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" {{ old('id_matiere', $evaluation->id_matiere) == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_matiere')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="date">{{ __('Date de l\'évaluation') }} <span class="google-required">*</span></label>
                            <input type="date" name="date" id="date" class="google-input @error('date') is-invalid @enderror" 
                                   value="{{ old('date', $evaluation->date) }}" required>
                            @error('date')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="note_max">{{ __('Note maximale') }} <span class="google-required">*</span></label>
                            <input type="number" name="note_max" id="note_max" class="google-input @error('note_max') is-invalid @enderror" 
                                   value="{{ old('note_max', $evaluation->note_max) }}" 
                                   step="0.01" min="0" placeholder="20" required>
                            @error('note_max')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="date_debut">{{ __('Heure de début') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_debut" id="date_debut" class="google-input @error('date_debut') is-invalid @enderror" 
                                   value="{{ old('date_debut', $evaluation->date_debut) }}" required>
                            @error('date_debut')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="date_fin">{{ __('Heure de fin') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_fin" id="date_fin" class="google-input @error('date_fin') is-invalid @enderror" 
                                   value="{{ old('date_fin', $evaluation->date_fin) }}" required>
                            @error('date_fin')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="google-form-actions">
                    <button type="button" class="google-btn google-btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        {{ __('Supprimer') }}
                    </button>
                    <div class="google-button-group">
                        <a href="{{ route('admin.evaluations.index') }}" class="google-btn google-btn-text">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('Mettre à jour') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Confirmer la suppression') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Êtes-vous sûr de vouloir supprimer cette évaluation ?') }}</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Cette action supprimera également toutes les notes associées.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <form method="POST" action="{{ route('admin.evaluations.destroy', $evaluation) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('Supprimer définitivement') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

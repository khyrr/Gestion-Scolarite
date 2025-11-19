@extends('layouts.dashboard')

@section('title', __('app.modifier_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
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

            <form method="POST" action="{{ route('evaluations.update', $evaluation) }}">
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
                        <a href="{{ route('evaluations.index') }}" class="google-btn google-btn-text">
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
                <form method="POST" action="{{ route('evaluations.destroy', $evaluation) }}" class="d-inline">
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

@push('styles')
<style>
    :root {
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-blue-light: #e8f0fe;
        --google-gray-50: #f8f9fa;
        --google-gray-100: #f1f3f4;
        --google-gray-200: #e8eaed;
        --google-gray-300: #dadce0;
        --google-gray-600: #80868b;
        --google-gray-700: #5f6368;
        --google-gray-900: #202124;
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-spacing-2xl: 48px;
        --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    .google-container {
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .google-form-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: var(--google-spacing-lg);
    }

    .google-form-card {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-xl);
    }

    .google-form-header {
        margin-bottom: var(--google-spacing-xl);
    }

    .google-form-title {
        font-size: 2rem;
        font-weight: 400;
        color: var(--google-gray-900);
        margin: 0;
    }

    .google-form-section {
        margin-bottom: var(--google-spacing-xl);
    }

    .google-form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: var(--google-spacing-lg);
        margin-bottom: var(--google-spacing-lg);
    }

    .google-form-row:last-child {
        margin-bottom: 0;
    }

    .google-form-group {
        display: flex;
        flex-direction: column;
    }

    .google-label {
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--google-gray-700);
        margin-bottom: var(--google-spacing-sm);
    }

    .google-required {
        color: #d93025;
    }

    .google-input {
        width: 100%;
        padding: 8px 12px;
        font-size: 0.875rem;
        color: var(--google-gray-900);
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 4px;
        transition: var(--google-transition);
    }

    .google-input:focus {
        outline: none;
        border-color: var(--google-blue);
        box-shadow: 0 0 0 1px var(--google-blue);
    }

    .google-input.is-invalid {
        border-color: #d93025;
    }

    .google-input.is-invalid:focus {
        box-shadow: 0 0 0 1px #d93025;
    }

    .google-error-text {
        font-size: 0.75rem;
        color: #d93025;
        margin-top: var(--google-spacing-xs);
    }

    .google-form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: var(--google-spacing-lg);
        border-top: 1px solid var(--google-gray-300);
    }

    .google-button-group {
        display: flex;
        gap: var(--google-spacing-sm);
    }

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

    .google-btn-text {
        background: transparent;
        color: var(--google-blue);
    }

    .google-btn-text:hover {
        background: var(--google-blue-light);
        color: var(--google-blue-hover);
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

    .google-btn-danger {
        background: transparent;
        color: #d93025;
    }

    .google-btn-danger:hover {
        background: #fce8e6;
        color: #c5221f;
    }

    @media (max-width: 768px) {
        .google-form-wrapper {
            padding: var(--google-spacing-md);
        }

        .google-form-card {
            padding: var(--google-spacing-lg);
        }

        .google-form-title {
            font-size: 1.5rem;
        }

        .google-form-row {
            grid-template-columns: 1fr;
            gap: var(--google-spacing-md);
        }
    }

    @media (max-width: 480px) {
        .google-form-wrapper {
            padding: var(--google-spacing-sm);
        }

        .google-form-card {
            padding: var(--google-spacing-md);
        }

        .google-form-title {
            font-size: 1.25rem;
        }

        .google-form-actions {
            flex-wrap: wrap;
        }

        .google-btn-danger {
            flex: 1 1 100%;
            justify-content: center;
            margin-bottom: var(--google-spacing-sm);
        }

        .google-button-group {
            flex: 1 1 100%;
            justify-content: space-between;
        }

        .google-btn {
            padding: 8px 12px;
            font-size: 0.8125rem;
        }
    }
</style>
@endpush
@endsection

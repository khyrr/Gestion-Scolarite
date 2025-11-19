@extends('layouts.dashboard')

@section('title', __('app.nouvelle_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h2 class="google-form-title">{{ __('Programmer une nouvelle évaluation') }}</h2>
            </div>

            <form method="POST" action="{{ route('evaluations.store') }}">
                @csrf

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="type">{{ __('Type d\'évaluation') }} <span class="google-required">*</span></label>
                            <select name="type" id="type" class="google-input @error('type') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir" {{ old('type') == 'devoir' ? 'selected' : '' }}>{{ __('Devoir') }}</option>
                                <option value="controle" {{ old('type') == 'controle' ? 'selected' : '' }}>{{ __('Contrôle') }}</option>
                                <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>{{ __('Examen') }}</option>
                            </select>
                            @error('type')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="id_classe">{{ __('Classe') }} <span class="google-required">*</span></label>
                            <select name="id_classe" id="id_classe" class="google-input @error('id_classe') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="matiere">{{ __('Matière') }} <span class="google-required">*</span></label>
                            <select name="matiere" id="matiere" class="google-input @error('matiere') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                <option value="Mathématiques" {{ old('matiere') == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Français" {{ old('matiere') == 'Français' ? 'selected' : '' }}>Français</option>
                                <option value="Anglais" {{ old('matiere') == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                                <option value="Sciences Physiques" {{ old('matiere') == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                                <option value="Biologie" {{ old('matiere') == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                                <option value="Histoire-Géographie" {{ old('matiere') == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                                <option value="اللغة العربية" {{ old('matiere') == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                                <option value="التربية الإسلامية" {{ old('matiere') == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                                <option value="التربية المدنية" {{ old('matiere') == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                                <option value="التربية البدنية" {{ old('matiere') == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                            </select>
                            @error('matiere')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="date">{{ __('Date de l\'évaluation') }} <span class="google-required">*</span></label>
                            <input type="date" name="date" id="date" class="google-input @error('date') is-invalid @enderror" 
                                   value="{{ old('date') }}" required>
                            @error('date')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="date_debut">{{ __('Heure de début') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_debut" id="date_debut" class="google-input @error('date_debut') is-invalid @enderror" 
                                   value="{{ old('date_debut') }}" required>
                            @error('date_debut')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="date_fin">{{ __('Heure de fin') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_fin" id="date_fin" class="google-input @error('date_fin') is-invalid @enderror" 
                                   value="{{ old('date_fin') }}" required>
                            @error('date_fin')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group google-full-width">
                            <label class="google-label" for="description">{{ __('Description ou instructions (optionnel)') }}</label>
                            <textarea name="description" id="description" rows="3" class="google-input @error('description') is-invalid @enderror" 
                                      placeholder="Instructions spéciales, matériel autorisé, consignes particulières...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="google-form-actions">
                    <div></div>
                    <div class="google-button-group">
                        <a href="{{ route('evaluations.index') }}" class="google-btn google-btn-text">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('Programmer l\'évaluation') }}
                        </button>
                    </div>
                </div>
            </form>
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

    .google-form-group.google-full-width {
        grid-column: 1 / -1;
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
        font-family: inherit;
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

    textarea.google-input {
        resize: vertical;
        min-height: 80px;
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

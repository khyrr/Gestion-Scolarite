@extends('layouts.dashboard')

@section('title', __('app.programmer_cours'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('tableau-bord') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('cours.index') }}">{{ __('Cours') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        @if(request()->has('from_timetable'))
            <div class="google-info-box">
                <svg class="google-info-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div>
                    <div class="google-info-title">{{ __('app.programmer_cours') }}</div>
                    <div class="google-info-text">{{ __('app.champs_verrouilles') }}</div>
                </div>
            </div>
        @endif

        
        
        <div class="google-form-card">
            <div class="google-form-header">
            <h1 class="google-form-title">{{ __('app.programmer_cours') }}</h1>
            <p class="google-form-subtitle">{{ __('app.remplir_informations_cours') }}</p>
        </div>


            <form method="POST" action="{{ route('cours.store') }}">
                @csrf
                
                @if(request()->has('from_timetable'))
                    <input type="hidden" name="from_timetable" value="1">
                @endif

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.classe') }} <span class="google-required">*</span></label>
                            <select name="id_classe" 
                                class="google-input" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('app.selectionner_classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" 
                                        {{ (old('id_classe', request('id_classe')) == $classe->id_classe) ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="id_classe" value="{{ request('id_classe') }}">
                            @endif
                            @error('id_classe')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.enseignant') }} <span class="google-required">*</span></label>
                            <select name="id_enseignant" class="google-input" required>
                                <option value="">{{ __('app.selectionner_enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" 
                                        {{ old('id_enseignant') == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }} - {{ $enseignant->matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_enseignant')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.matiere') }} <span class="google-required">*</span></label>
                            <select name="id_matiere" class="google-input" required>
                                <option value="">{{ __('app.selectionner_matiere') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" 
                                        {{ old('id_matiere') == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{__('app.' . $matiere->code_matiere) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_matiere')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.jour_semaine') }} <span class="google-required">*</span></label>
                            <select name="jour" 
                                class="google-input" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('app.selectionner_jour') }}</option>
                                <option value="lundi" {{ (old('jour', request('jour')) == 'lundi') ? 'selected' : '' }}>{{ __('app.lundi') }}</option>
                                <option value="mardi" {{ (old('jour', request('jour')) == 'mardi') ? 'selected' : '' }}>{{ __('app.mardi') }}</option>
                                <option value="mercredi" {{ (old('jour', request('jour')) == 'mercredi') ? 'selected' : '' }}>{{ __('app.mercredi') }}</option>
                                <option value="jeudi" {{ (old('jour', request('jour')) == 'jeudi') ? 'selected' : '' }}>{{ __('app.jeudi') }}</option>
                                <option value="vendredi" {{ (old('jour', request('jour')) == 'vendredi') ? 'selected' : '' }}>{{ __('app.vendredi') }}</option>
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="jour" value="{{ request('jour') }}">
                            @endif
                            @error('jour')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.selectionner_heure_debut') }} <span class="google-required">*</span></label>
                            <input type="time" 
                                name="date_debut" 
                                class="google-input" 
                                value="{{ old('date_debut', request('date_debut')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_debut" value="{{ request('date_debut') }}">
                            @endif
                            @error('date_debut')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.selectionner_heure_fin') }} <span class="google-required">*</span></label>
                            <input type="time" 
                                name="date_fin" 
                                class="google-input" 
                                value="{{ old('date_fin', request('date_fin')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_fin" value="{{ request('date_fin') }}">
                            @endif
                            @error('date_fin')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-group google-form-full">
                        <label class="google-label">{{ __('app.description_optionnel') }}</label>
                        <textarea 
                            name="description" 
                            class="google-input" 
                            rows="4"
                            placeholder="{{ __('app.description_cours_placeholder') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="google-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="google-form-actions">
                    <a href="{{ route('cours.index') }}" class="google-btn google-btn-text">
                        {{ __('app.retour') }}
                    </a>
                    <button type="submit" class="google-btn google-btn-primary">
                        {{ __('app.programmer_le_cours') }}
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --google-blue: #1a73e8;
    --google-blue-hover: #1967d2;
    --google-blue-light: #e8f0fe;
    
    --google-white: #ffffff;
    --google-gray-50: #f8f9fa;
    --google-gray-100: #f1f3f4;
    --google-gray-200: #e8eaed;
    --google-gray-300: #dadce0;
    --google-gray-400: #bdc1c6;
    --google-gray-500: #9aa0a6;
    --google-gray-600: #80868b;
    --google-gray-700: #5f6368;
    --google-gray-800: #3c4043;
    --google-gray-900: #202124;
    
    --google-font: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    
    --google-spacing-xs: 4px;
    --google-spacing-sm: 8px;
    --google-spacing-md: 16px;
    --google-spacing-lg: 24px;
    --google-spacing-xl: 32px;
    --google-spacing-2xl: 48px;
    
    --google-radius: 8px;
    --google-radius-sm: 4px;
    
    --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
    
    --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
}

/* Container */
.google-container {
    max-width: 100%;
    margin: 0;
    padding: 0;
}

/* Form Wrapper */
.google-form-wrapper {
    max-width: 800px;
    margin: 0 auto;
    padding: var(--google-spacing-lg);
}

/* Info Box */
.google-info-box {
    background: var(--google-blue-light);
    border: 1px solid var(--google-blue);
    border-radius: var(--google-radius);
    padding: var(--google-spacing-md);
    margin-bottom: var(--google-spacing-xl);
    display: flex;
    gap: var(--google-spacing-md);
    align-items: flex-start;
}

.google-info-icon {
    width: 24px;
    height: 24px;
    color: var(--google-blue);
    flex-shrink: 0;
}

.google-info-title {
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--google-gray-900);
    margin-bottom: var(--google-spacing-xs);
}

.google-info-text {
    font-family: var(--google-font);
    font-size: 0.8125rem;
    color: var(--google-gray-700);
}

/* Form Header */
.google-form-header {
    margin-bottom: var(--google-spacing-xl);
}

.google-form-title {
    font-family: var(--google-font);
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-sm) 0;
    letter-spacing: -0.5px;
    line-height: 1.2;
}

.google-form-subtitle {
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--google-gray-700);
    margin: 0;
}

/* Form Card */
.google-form-card {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    padding: var(--google-spacing-xl);
}

/* Form Section */
.google-form-section {
    margin-bottom: var(--google-spacing-xl);
}

.google-form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--google-spacing-lg);
}

/* Form Group */
.google-form-group {
    display: flex;
    flex-direction: column;
}

.google-form-full {
    grid-column: 1 / -1;
}

/* Form Label */
.google-label {
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--google-gray-700);
    margin-bottom: var(--google-spacing-sm);
}

.google-required {
    color: #d93025;
}

/* Form Input */
.google-input {
    width: 100%;
    padding: 8px 12px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    color: var(--google-gray-900);
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 4px;
    transition: var(--google-transition);
    outline: none;
}

.google-input::placeholder {
    color: var(--google-gray-500);
}

.google-input:hover {
    border-color: var(--google-gray-400);
}

.google-input:focus {
    border-color: var(--google-blue);
    box-shadow: 0 0 0 1px var(--google-blue);
}

.google-input:disabled {
    background: var(--google-gray-100);
    cursor: not-allowed;
}

.google-input.is-invalid {
    border-color: #d93025;
}

.google-input.is-invalid:focus {
    box-shadow: 0 0 0 1px #d93025;
}

textarea.google-input {
    resize: vertical;
    font-family: var(--google-font);
}

select.google-input {
    cursor: pointer;
}

/* Error Text */
.google-error-text {
    font-size: 0.75rem;
    color: #d93025;
    margin-top: var(--google-spacing-xs);
}

/* Form Actions */
.google-form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--google-spacing-lg);
    border-top: 1px solid var(--google-gray-300);
    gap: var(--google-spacing-sm);
}

/* Buttons */
.google-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    font-family: var(--google-font);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: var(--google-transition);
}

.google-btn-primary {
    background: var(--google-blue);
    color: var(--google-white);
}

.google-btn-primary:hover {
    background: var(--google-blue-hover);
    box-shadow: var(--google-shadow-1);
    color: white;
}

.google-btn-text {
    background: transparent;
    color: var(--google-blue);
}

.google-btn-text:hover {
    background: var(--google-blue-light);
    color: var(--google-blue-hover);
}

/* Responsive Design */
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
        flex-direction: column-reverse;
    }

    .google-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

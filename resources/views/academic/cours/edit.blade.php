@extends('layouts.dashboard')

@section('title', __('app.modifier_cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash me-1"></i>
            {{ __('app.supprimer') }}
        </button>
    </div>
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
                    <div class="google-info-title">{{ __('app.modification_depuis_emploi') }}</div>
                    <div class="google-info-text">{{ __('app.certains_champs_verrouilles') }}</div>
                </div>
            </div>
        @endif

        <!-- Page Header -->
        <div class="google-form-header">
            <h1 class="google-form-title">{{ __('app.modifier_cours') }}</h1>
            <p class="google-form-subtitle">Modifiez les informations du cours</p>
        </div>

        <!-- Mini Stats -->
        <div class="google-stats-overview">
            <div class="google-stat-mini">
                <div class="google-stat-mini-value">{{ $Cours->matiere->code_matiere ?? 'N/A' }}</div>
                <div class="google-stat-mini-label">{{ __('app.matiere') }}</div>
            </div>
            <div class="google-stat-mini">
                <div class="google-stat-mini-value">{{ $Cours->classe->nom_classe ?? 'N/A' }}</div>
                <div class="google-stat-mini-label">{{ __('app.classe') }}</div>
            </div>
            <div class="google-stat-mini">
                <div class="google-stat-mini-value">{{ ucfirst($Cours->jour) }}</div>
                <div class="google-stat-mini-label">{{ __('app.jour') }}</div>
            </div>
        </div>

        <div class="google-form-card">

            <form method="POST" action="{{ route('cours.update', $Cours->id_cours) }}">
                @csrf
                @method('PATCH')
                
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
                                        {{ old('id_classe', request()->has('from_timetable') ? request('id_classe') : $Cours->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }}
                                    </option>
                                @endforeach
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="id_classe" value="{{ request('id_classe', $Cours->id_classe) }}">
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
                                        {{ old('id_enseignant', $Cours->id_enseignant) == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }}
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
                                        {{ old('id_matiere', $Cours->id_matiere) == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_matiere')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.jour') }} <span class="google-required">*</span></label>
                            <select name="jour" 
                                class="google-input" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('app.selectionner_jour') }}</option>
                                <option value="lundi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'lundi' ? 'selected' : '' }}>
                                    {{ __('app.lundi') }}
                                </option>
                                <option value="mardi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'mardi' ? 'selected' : '' }}>
                                    {{ __('app.mardi') }}
                                </option>
                                <option value="mercredi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'mercredi' ? 'selected' : '' }}>
                                    {{ __('app.mercredi') }}
                                </option>
                                <option value="jeudi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'jeudi' ? 'selected' : '' }}>
                                    {{ __('app.jeudi') }}
                                </option>
                                <option value="vendredi" {{ strtolower(old('jour', request()->has('from_timetable') ? request('jour') : $Cours->jour)) == 'vendredi' ? 'selected' : '' }}>
                                    {{ __('app.vendredi') }}
                                </option>
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="jour" value="{{ request('jour', $Cours->jour) }}">
                            @endif
                            @error('jour')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.heure_debut') }} <span class="google-required">*</span></label>
                            <input type="time" 
                                name="date_debut" 
                                class="google-input" 
                                value="{{ old('date_debut', request()->has('from_timetable') ? request('date_debut') : \Carbon\Carbon::parse($Cours->date_debut)->format('H:i')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_debut" value="{{ request('date_debut', $Cours->date_debut) }}">
                            @endif
                            @error('date_debut')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.heure_fin') }} <span class="google-required">*</span></label>
                            <input type="time" 
                                name="date_fin" 
                                class="google-input" 
                                value="{{ old('date_fin', request()->has('from_timetable') ? request('date_fin') : \Carbon\Carbon::parse($Cours->date_fin)->format('H:i')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_fin" value="{{ request('date_fin', $Cours->date_fin) }}">
                            @endif
                            @error('date_fin')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-group google-form-full">
                        <label class="google-label">{{ __('app.description') }}</label>
                        <textarea name="description" 
                            class="google-input" 
                            rows="4" 
                            placeholder="{{ __('app.description_cours') }}">{{ old('description', $Cours->description ?? '') }}</textarea>
                        @error('description')
                            <span class="google-error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="google-form-actions">
                    <a href="{{ route('cours.index') }}" class="google-btn google-btn-text">
                        {{ __('app.annuler') }}
                    </a>
                    <div class="google-btn-group">
                        <a href="{{ route('cours.show', $Cours->id_cours) }}" class="google-btn google-btn-text">
                            {{ __('app.voir_details') }}
                        </a>
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('app.mettre_a_jour') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('app.confirmer_suppression') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">{{ __('app.confirmer_suppression_cours') }}</p>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ __('app.action_irreversible') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('app.annuler') }}
                </button>
                <form method="POST" action="{{ route('cours.destroy', $Cours->id_cours) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    @if(request()->has('from_timetable'))
                        <input type="hidden" name="from_timetable" value="1">
                    @endif
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('app.supprimer_definitivement') }}
                    </button>
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
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-xs) 0;
}

.google-form-subtitle {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0;
}

/* Statistics Overview */
.google-stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--google-spacing-md);
    margin-bottom: var(--google-spacing-xl);
}

.google-stat-mini {
    background: var(--google-white);
    border: 1px solid var(--google-gray-200);
    border-radius: var(--google-radius);
    padding: var(--google-spacing-md);
    text-align: center;
}

.google-stat-mini-value {
    font-family: var(--google-font);
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin-bottom: var(--google-spacing-xs);
}

.google-stat-mini-label {
    font-family: var(--google-font);
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--google-gray-600);
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

.google-input:disabled {
    background: var(--google-gray-100);
    cursor: not-allowed;
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
}

.google-btn-group {
    display: flex;
    gap: var(--google-spacing-sm);
}

/* Buttons */
.google-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
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
    color: white;
}

.google-btn-primary:hover {
    background: var(--google-blue-hover);
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
        }    .google-form-title {
        font-size: 1.5rem;
    }

    .google-form-card {
        padding: var(--google-spacing-lg);
    }

    .google-form-row {
        grid-template-columns: 1fr;
    }

    .google-stats-overview {
        grid-template-columns: repeat(3, 1fr);
    }

    .google-form-actions {
        flex-direction: column-reverse;
        gap: var(--google-spacing-sm);
    }

    .google-btn-group {
        width: 100%;
        flex-direction: column;
    }

    .google-btn {
        width: 100%;
    }
}

    @media (max-width: 480px) {
        .google-form-wrapper {
            padding: var(--google-spacing-sm);
        }    .google-form-card {
        padding: var(--google-spacing-md);
    }

    .google-form-title {
        font-size: 1.25rem;
    }

    .google-stats-overview {
        grid-template-columns: 1fr;
    }

    .google-stat-mini-value {
        font-size: 1.25rem;
    }
}
</style>
@endpush

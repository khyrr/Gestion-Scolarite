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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            @if(request()->has('from_timetable'))
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <div>
                        <strong>Pré-rempli depuis l'emploi du temps!</strong>
                        <p>Les champs classe, jour et horaires sont verrouillés. Veuillez compléter les informations manquantes (enseignant et matière).</p>
                    </div>
                </div>
            @endif

            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon-wrapper">
                        <i class="bi bi-calendar-plus"></i>
                    </div>
                    <div>
                        <h5 class="form-title">{{ __('Programmer un nouveau cours') }}</h5>
                        <p class="form-subtitle">Remplissez les informations du cours</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('cours.store') }}">
                    @csrf
                    
                    @if(request()->has('from_timetable'))
                        <input type="hidden" name="from_timetable" value="1">
                    @endif

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-md">Classe <span class="required">*</span></label>
                            <select name="id_classe" 
                                class="form-control-md" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
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
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">Enseignant <span class="required">*</span></label>
                            <select name="id_enseignant" class="form-control-md" required>
                                <option value="">{{ __('Sélectionner un enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" 
                                        {{ old('id_enseignant') == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }} - {{ $enseignant->matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_enseignant')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">Matière <span class="required">*</span></label>
                            <select name="id_matiere" class="form-control-md" required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" 
                                        {{ old('id_matiere') == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_matiere')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">Jour de la semaine <span class="required">*</span></label>
                            <select name="jour" 
                                class="form-control-md" 
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                                <option value="">{{ __('Sélectionner un jour') }}</option>
                                <option value="lundi" {{ (old('jour', request('jour')) == 'lundi') ? 'selected' : '' }}>{{ __('Lundi') }}</option>
                                <option value="mardi" {{ (old('jour', request('jour')) == 'mardi') ? 'selected' : '' }}>{{ __('Mardi') }}</option>
                                <option value="mercredi" {{ (old('jour', request('jour')) == 'mercredi') ? 'selected' : '' }}>{{ __('Mercredi') }}</option>
                                <option value="jeudi" {{ (old('jour', request('jour')) == 'jeudi') ? 'selected' : '' }}>{{ __('Jeudi') }}</option>
                                <option value="vendredi" {{ (old('jour', request('jour')) == 'vendredi') ? 'selected' : '' }}>{{ __('Vendredi') }}</option>
                            </select>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="jour" value="{{ request('jour') }}">
                            @endif
                            @error('jour')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">Heure de début <span class="required">*</span></label>
                            <input type="time" 
                                name="date_debut" 
                                class="form-control-md" 
                                value="{{ old('date_debut', request('date_debut')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_debut" value="{{ request('date_debut') }}">
                            @endif
                            @error('date_debut')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">Heure de fin <span class="required">*</span></label>
                            <input type="time" 
                                name="date_fin" 
                                class="form-control-md" 
                                value="{{ old('date_fin', request('date_fin')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_fin" value="{{ request('date_fin') }}">
                            @endif
                            @error('date_fin')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label-md">Description (optionnel)</label>
                            <textarea 
                                name="description" 
                                class="form-control-md" 
                                rows="4"
                                placeholder="Description du cours ou notes particulières...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('cours.index') }}" class="btn-md btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            {{ __('Retour') }}
                        </a>
                        <button type="submit" class="btn-md btn-primary">
                            <i class="bi bi-check-lg"></i>
                            {{ __('Programmer le cours') }}
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
    --md-primary: #0d6efd;
    --md-primary-dark: #0a58ca;
    --md-gray-50: #fafafa;
    --md-gray-100: #f5f5f5;
    --md-gray-200: #eeeeee;
    --md-gray-300: #e0e0e0;
    --md-gray-400: #bdbdbd;
    --md-gray-500: #9e9e9e;
    --md-gray-600: #757575;
    --md-gray-700: #616161;
    --md-gray-800: #424242;
    --md-gray-900: #212529;
    --md-radius: 12px;
    --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
    --md-shadow-lg: 0 8px 16px rgba(0,0,0,0.12);
}

/* Info Box */
.info-box {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);
    border-left: 4px solid var(--md-primary);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 24px;
    display: flex;
    gap: 16px;
}

.info-box i {
    font-size: 24px;
    color: var(--md-primary);
    flex-shrink: 0;
}

.info-box strong {
    display: block;
    color: var(--md-gray-900);
    font-size: 15px;
    margin-bottom: 4px;
}

.info-box p {
    color: var(--md-gray-700);
    font-size: 14px;
    margin: 0;
}

/* Form Card */
.form-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 36px;
    box-shadow: var(--md-shadow);
}

.form-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 2px solid var(--md-gray-200);
}

.form-icon-wrapper {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.form-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.form-subtitle {
    font-size: 14px;
    color: var(--md-gray-600);
    margin: 4px 0 0 0;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label-md {
    font-size: 13px;
    font-weight: 600;
    color: var(--md-gray-700);
    margin-bottom: 8px;
}

.required {
    color: #dc3545;
}

.form-control-md {
    padding: 12px 16px;
    border: 1px solid var(--md-gray-300);
    border-radius: 8px;
    font-size: 14px;
    color: var(--md-gray-900);
    transition: all 0.3s;
    background: white;
}

.form-control-md:focus {
    outline: none;
    border-color: var(--md-primary);
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

.form-control-md:disabled {
    background: var(--md-gray-100);
    cursor: not-allowed;
}

textarea.form-control-md {
    resize: vertical;
    font-family: inherit;
}

select.form-control-md {
    cursor: pointer;
}

.error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 6px;
    display: block;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 24px;
    border-top: 1px solid var(--md-gray-200);
}

.btn-md {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--md-primary) 0%, var(--md-primary-dark) 100%);
    color: white;
}

.btn-primary:hover {
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    transform: translateY(-2px);
    color: white;
}

.btn-secondary {
    background: var(--md-gray-200);
    color: var(--md-gray-700);
}

.btn-secondary:hover {
    background: var(--md-gray-300);
    color: var(--md-gray-800);
}

/* RTL Support */
[dir="rtl"] .info-box {
    border-left: none;
    border-right: 4px solid var(--md-primary);
    flex-direction: row-reverse;
}

[dir="rtl"] .form-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .form-actions {
    justify-content: flex-start;
}

[dir="rtl"] .btn-md {
    flex-direction: row-reverse;
}

/* Responsive */
@media (max-width: 767px) {
    .form-card {
        padding: 24px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .form-icon-wrapper {
        width: 48px;
        height: 48px;
        font-size: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-md {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

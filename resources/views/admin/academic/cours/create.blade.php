@extends('admin.layouts.dashboard')

@section('title', __('app.programmer_cours'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('admin.dashboard') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('admin.cours.index') }}">{{ __('Cours') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        @if(request()->has('from_timetable'))
            <div class="google-info-box">
                <i class="bi bi-info-circle me-2 google-info-icon"></i>
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


            <form method="POST" action="{{ route('admin.cours.store') }}">
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
                    <a href="{{ route('admin.cours.index') }}" class="google-btn google-btn-text">
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



@extends('admin.layouts.dashboard')

@section('title', __('app.modifier_cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.cours.index') }}" class="btn btn-outline-secondary">
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
                <i class="bi bi-info-circle me-2 google-info-icon"></i>
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

            <form method="POST" action="{{ route('admin.cours.update', $Cours->id_cours) }}">
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
                    <a href="{{ route('admin.cours.index') }}" class="google-btn google-btn-text">
                        {{ __('app.annuler') }}
                    </a>
                    <div class="google-btn-group">
                        <a href="{{ route('admin.cours.show', $Cours->id_cours) }}" class="google-btn google-btn-text">
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
                <form method="POST" action="{{ route('admin.cours.destroy', $Cours->id_cours) }}" class="d-inline">
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


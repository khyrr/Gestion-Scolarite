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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            @if(request()->has('from_timetable'))
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <div>
                        <strong>{{ __('app.modification_depuis_emploi') }}</strong>
                        <p>{{ __('app.certains_champs_verrouilles') }}</p>
                    </div>
                </div>
            @endif

            <!-- Mini Stats -->
            <div class="mini-stats-grid">
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">{{ __('app.matiere') }}</div>
                        <div class="stat-value-mini">{{ $Cours->matiere->code_matiere ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">{{ __('app.classe') }}</div>
                        <div class="stat-value-mini">{{ $Cours->classe->nom_classe ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">{{ __('app.jour') }}</div>
                        <div class="stat-value-mini">{{ ucfirst($Cours->jour) }}</div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon-wrapper">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h5 class="form-title">{{ __('app.modifier_cours') }}</h5>
                        <p class="form-subtitle">Modifiez les informations du cours</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('cours.update', $Cours->id_cours) }}">
                    @csrf
                    @method('PATCH')
                    
                    @if(request()->has('from_timetable'))
                        <input type="hidden" name="from_timetable" value="1">
                    @endif

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.classe') }} <span class="required">*</span></label>
                            <select name="id_classe" 
                                class="form-control-md" 
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
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.enseignant') }} <span class="required">*</span></label>
                            <select name="id_enseignant" class="form-control-md" required>
                                <option value="">{{ __('app.selectionner_enseignant') }}</option>
                                @foreach ($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id_enseignant }}" 
                                        {{ old('id_enseignant', $Cours->id_enseignant) == $enseignant->id_enseignant ? 'selected' : '' }}>
                                        {{ $enseignant->prenom }} {{ $enseignant->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_enseignant')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.matiere') }} <span class="required">*</span></label>
                            <select name="id_matiere" class="form-control-md" required>
                                <option value="">{{ __('app.selectionner_matiere') }}</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id_matiere }}" 
                                        {{ old('id_matiere', $Cours->id_matiere) == $matiere->id_matiere ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_matiere')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.jour') }} <span class="required">*</span></label>
                            <select name="jour" 
                                class="form-control-md" 
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
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.heure_debut') }} <span class="required">*</span></label>
                            <input type="time" 
                                name="date_debut" 
                                class="form-control-md" 
                                value="{{ old('date_debut', request()->has('from_timetable') ? request('date_debut') : \Carbon\Carbon::parse($Cours->date_debut)->format('H:i')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_debut" value="{{ request('date_debut', $Cours->date_debut) }}">
                            @endif
                            @error('date_debut')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.heure_fin') }} <span class="required">*</span></label>
                            <input type="time" 
                                name="date_fin" 
                                class="form-control-md" 
                                value="{{ old('date_fin', request()->has('from_timetable') ? request('date_fin') : \Carbon\Carbon::parse($Cours->date_fin)->format('H:i')) }}" 
                                step="60"
                                {{ request()->has('from_timetable') ? 'disabled' : '' }}
                                required>
                            @if(request()->has('from_timetable'))
                                <input type="hidden" name="date_fin" value="{{ request('date_fin', $Cours->date_fin) }}">
                            @endif
                            @error('date_fin')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label-md">{{ __('app.description') }}</label>
                            <textarea name="description" 
                                class="form-control-md" 
                                rows="4" 
                                placeholder="{{ __('app.description_cours') }}">{{ old('description', $Cours->description ?? '') }}</textarea>
                            @error('description')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('cours.index') }}" class="btn-md btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            {{ __('app.annuler') }}
                        </a>
                        <a href="{{ route('cours.show', $Cours->id_cours) }}" class="btn-md btn-info">
                            <i class="bi bi-eye"></i>
                            {{ __('app.voir_details') }}
                        </a>
                        <button type="submit" class="btn-md btn-primary">
                            <i class="bi bi-check-circle"></i>
                            {{ __('app.mettre_a_jour') }}
                        </button>
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

/* Mini Stats Grid */
.mini-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

.stat-card-mini {
    background: white;
    border-radius: var(--md-radius);
    padding: 20px;
    box-shadow: var(--md-shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s;
}

.stat-card-mini:hover {
    box-shadow: var(--md-shadow-lg);
    transform: translateY(-2px);
}

.stat-icon-mini {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    flex-shrink: 0;
}

.stat-info-mini {
    flex: 1;
}

.stat-label-mini {
    font-size: 11px;
    font-weight: 600;
    color: var(--md-gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.stat-value-mini {
    font-size: 16px;
    font-weight: 700;
    color: var(--md-gray-900);
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

.btn-info {
    background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
    color: white;
}

.btn-info:hover {
    box-shadow: 0 6px 20px rgba(13, 202, 240, 0.4);
    transform: translateY(-2px);
    color: white;
}

/* RTL Support */
[dir="rtl"] .info-box {
    border-left: none;
    border-right: 4px solid var(--md-primary);
    flex-direction: row-reverse;
}

[dir="rtl"] .stat-card-mini {
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
    .mini-stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
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

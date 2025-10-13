@extends('layouts.dashboard')

@section('title', __('app.modifier_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    <a href="{{ route('etudiants.show', $etudiant) }}" class="btn btn-outline-primary">
        {{ __('app.voir') }}
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Mini Stats -->
            <div class="mini-stats-grid">
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">Étudiant</div>
                        <div class="stat-value-mini">{{ $etudiant->prenom }} {{ $etudiant->nom }}</div>
                    </div>
                </div>
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                        <i class="bi bi-door-open"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">Classe</div>
                        <div class="stat-value-mini">{{ $etudiant->classe?->nom_classe ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="stat-card-mini">
                    <div class="stat-icon-mini" style="background: linear-gradient(135deg, {{ $etudiant->genre == 'masculin' ? '#0dcaf0 0%, #0aa2c0' : '#d63384 0%, #c22773' }} 100%);">
                        <i class="bi bi-gender-{{ $etudiant->genre == 'masculin' ? 'male' : 'female' }}"></i>
                    </div>
                    <div class="stat-info-mini">
                        <div class="stat-label-mini">Genre</div>
                        <div class="stat-value-mini">{{ ucfirst($etudiant->genre ?? 'N/A') }}</div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon-wrapper">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h5 class="form-title">{{ __('app.modifier_etudiant') }}</h5>
                        <p class="form-subtitle">Modifiez les informations de l'étudiant</p>
                    </div>
                </div>

                <form action="{{ route('etudiants.update', $etudiant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.nom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required 
                                   placeholder="Nom de famille">
                            @error('nom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.prenom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required 
                                   placeholder="Prénom">
                            @error('prenom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.email') }}</label>
                            <input type="email" class="form-control-md @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $etudiant->email) }}" 
                                   placeholder="etudiant@exemple.com">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.telephone') }} <span class="required">*</span></label>
                            <input type="tel" class="form-control-md @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required 
                                   placeholder="+222 XX XX XX XX">
                            @error('telephone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.date_naissance') }} <span class="required">*</span></label>
                            <input type="date" class="form-control-md @error('date_naissance') is-invalid @enderror" 
                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required>
                            @error('date_naissance')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.genre') }} <span class="required">*</span></label>
                            <select class="form-control-md @error('genre') is-invalid @enderror" 
                                    id="genre" name="genre" required>
                                <option value="">{{ __('app.choisir_genre') }}</option>
                                <option value="masculin" {{ old('genre', $etudiant->genre) == 'masculin' ? 'selected' : '' }}>{{ __('app.masculin') }}</option>
                                <option value="feminin" {{ old('genre', $etudiant->genre) == 'feminin' ? 'selected' : '' }}>{{ __('app.feminin') }}</option>
                            </select>
                            @error('genre')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.classe') }} <span class="required">*</span></label>
                            <select class="form-control-md @error('id_classe') is-invalid @enderror" 
                                    id="id_classe" name="id_classe" required>
                                <option value="">{{ __('app.choisir_classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe', $etudiant->id_classe) == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.adresse') }}</label>
                            <input type="text" class="form-control-md @error('adresse') is-invalid @enderror" 
                                   id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" 
                                   placeholder="Adresse complète">
                            @error('adresse')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('etudiants.index') }}" class="btn-md btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            {{ __('app.annuler') }}
                        </a>
                        <a href="{{ route('etudiants.show', $etudiant) }}" class="btn-md btn-info">
                            <i class="bi bi-eye"></i>
                            {{ __('app.voir') }}
                        </a>
                        <button type="submit" class="btn-md btn-primary">
                            <i class="bi bi-check-circle"></i>
                            {{ __('app.sauvegarder') }}
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
        --primary-color: #0d6efd;
        --primary-dark: #0a58ca;
        --success-color: #198754;
        --success-dark: #146c43;
        --info-color: #0dcaf0;
        --info-dark: #0aa2c0;
        --bg-white: #ffffff;
        --bg-light: #f8f9fa;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --border-color: #dee2e6;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    /* Mini Stats Grid */
    .mini-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card-mini {
        background: var(--bg-white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [dir="rtl"] .stat-card-mini {
        flex-direction: row-reverse;
    }

    .stat-card-mini:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .stat-icon-mini {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon-mini i {
        font-size: 24px;
        color: var(--bg-white);
    }

    .stat-info-mini {
        flex: 1;
        min-width: 0;
    }

    .stat-label-mini {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 4px;
        font-weight: 500;
    }

    .stat-value-mini {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Form Card */
    .form-card {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 36px;
        margin-bottom: 24px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border-color);
    }

    [dir="rtl"] .form-header {
        flex-direction: row-reverse;
    }

    .form-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .form-icon-wrapper i {
        font-size: 28px;
        color: var(--bg-white);
    }

    .form-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 4px 0;
    }

    .form-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
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

    .form-label-md {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 8px;
        display: block;
    }

    .required {
        color: #dc3545;
        margin-left: 2px;
    }

    [dir="rtl"] .required {
        margin-left: 0;
        margin-right: 2px;
    }

    /* Form Controls */
    .form-control-md {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--text-dark);
        background-color: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-control-md:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .form-control-md.is-invalid {
        border-color: #dc3545;
    }

    .form-control-md.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    .error-message {
        font-size: 13px;
        color: #dc3545;
        margin-top: 6px;
        display: block;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
    }

    [dir="rtl"] .form-actions {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

    /* Buttons */
    .btn-md {
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    [dir="rtl"] .btn-md {
        flex-direction: row-reverse;
    }

    .btn-md i {
        font-size: 16px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        color: var(--bg-white);
    }

    .btn-secondary {
        background: #6c757d;
        color: var(--bg-white);
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: var(--bg-white);
    }

    .btn-info {
        background: linear-gradient(135deg, var(--info-color) 0%, var(--info-dark) 100%);
        color: var(--bg-white);
    }

    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 202, 240, 0.3);
        color: var(--bg-white);
    }

    /* Responsive Design */
    @media (max-width: 1400px) {
        .mini-stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .mini-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 24px;
        }

        .form-header {
            gap: 16px;
            margin-bottom: 24px;
        }

        .form-icon-wrapper {
            width: 48px;
            height: 48px;
        }

        .form-icon-wrapper i {
            font-size: 24px;
        }

        .form-title {
            font-size: 18px;
        }

        .stat-card-mini {
            padding: 16px;
        }

        .stat-icon-mini {
            width: 40px;
            height: 40px;
        }

        .stat-icon-mini i {
            font-size: 20px;
        }

        .stat-value-mini {
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .mini-stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
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

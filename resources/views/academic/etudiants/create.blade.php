@extends('layouts.dashboard')

@section('title', __('app.ajouter_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.ajouter_etudiant') }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="form-card">
                <div class="form-header">
                    <div class="form-icon-wrapper">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <div>
                        <h5 class="form-title">{{ __('app.ajouter_etudiant') }}</h5>
                        <p class="form-subtitle">Remplissez les informations de l'étudiant</p>
                    </div>
                </div>

                <form action="{{ route('etudiants.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.nom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required 
                                   placeholder="Nom de famille">
                            @error('nom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.prenom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom') }}" required 
                                   placeholder="Prénom">
                            @error('prenom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.email') }}</label>
                            <input type="email" class="form-control-md @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="etudiant@exemple.com">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.telephone') }} <span class="required">*</span></label>
                            <input type="tel" class="form-control-md @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone') }}" required 
                                   placeholder="+222 XX XX XX XX">
                            @error('telephone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.date_naissance') }} <span class="required">*</span></label>
                            <input type="date" class="form-control-md @error('date_naissance') is-invalid @enderror" 
                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.genre') }} <span class="required">*</span></label>
                            <select class="form-control-md @error('genre') is-invalid @enderror" 
                                    id="genre" name="genre" required>
                                <option value="">{{ __('app.choisir_genre') }}</option>
                                <option value="masculin" {{ old('genre') == 'masculin' ? 'selected' : '' }}>{{ __('app.masculin') }}</option>
                                <option value="feminin" {{ old('genre') == 'feminin' ? 'selected' : '' }}>{{ __('app.feminin') }}</option>
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
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
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
                                   id="adresse" name="adresse" value="{{ old('adresse') }}" 
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
                        <button type="submit" class="btn-md btn-primary">
                            <i class="bi bi-check-circle"></i>
                            {{ __('app.enregistrer') }}
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
        --md-gray-200: #eeeeee;
        --md-gray-600: #757575;
        --md-gray-700: #616161;
        --md-gray-900: #212529;
        --md-danger: #dc3545;
        --md-radius: 12px;
        --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .form-card {
        background: white;
        border-radius: var(--md-radius);
        padding: 36px;
        box-shadow: var(--md-shadow);
        margin-bottom: 24px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--md-gray-200);
    }

    [dir="rtl"] .form-header {
        flex-direction: row-reverse;
    }

    .form-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--md-primary) 0%, var(--md-primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .form-icon-wrapper i {
        font-size: 28px;
        color: white;
    }

    .form-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--md-gray-900);
        margin: 0 0 4px 0;
    }

    .form-subtitle {
        font-size: 14px;
        color: var(--md-gray-600);
        margin: 0;
    }

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
        color: var(--md-gray-900);
        margin-bottom: 8px;
        display: block;
    }

    .required {
        color: var(--md-danger);
        margin-left: 2px;
    }

    [dir="rtl"] .required {
        margin-left: 0;
        margin-right: 2px;
    }

    .form-control-md {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--md-gray-900);
        background-color: white;
        border: 1px solid var(--md-gray-200);
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-control-md:focus {
        outline: none;
        border-color: var(--md-primary);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .form-control-md.is-invalid {
        border-color: var(--md-danger);
    }

    .form-control-md.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    .error-message {
        font-size: 13px;
        color: var(--md-danger);
        margin-top: 6px;
        display: block;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid var(--md-gray-200);
    }

    [dir="rtl"] .form-actions {
        flex-direction: row-reverse;
        justify-content: flex-start;
    }

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

    .btn-primary {
        background: linear-gradient(135deg, var(--md-primary) 0%, var(--md-primary-dark) 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        color: white;
    }

    .btn-secondary {
        background: var(--md-gray-200);
        color: var(--md-gray-700);
    }

    .btn-secondary:hover {
        background: #d5d8db;
        color: var(--md-gray-700);
    }

    @media (max-width: 992px) {
        .form-grid {
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 24px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .form-header {
            gap: 16px;
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
    }

    @media (max-width: 576px) {
        .form-card {
            padding: 20px;
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

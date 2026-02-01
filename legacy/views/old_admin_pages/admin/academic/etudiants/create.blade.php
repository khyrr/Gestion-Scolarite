@extends('admin.layouts.dashboard')

@section('title', __('app.ajouter_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.ajouter_etudiant') }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h1 class="google-form-title">{{ __('app.ajouter_etudiant') }}</h1>
                <p class="google-form-subtitle">{{ __('app.remplissez_informations_etudiant') }}</p>
            </div>

            <form action="{{ route('admin.etudiants.store') }}" method="POST">
                @csrf
                
                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.nom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required 
                                   placeholder="Nom de famille">
                            @error('nom')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.prenom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom') }}" required 
                                   placeholder="{{ __('app.prenom') }}">
                            @error('prenom')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.email') }}</label>
                            <input type="email" class="google-input @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="{{ __('app.email') }}">
                            @error('email')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.telephone') }} <span class="google-required">*</span></label>
                            <input type="tel" class="google-input @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone') }}" required 
                                   placeholder="{{ __('app.telephone') }}">
                            @error('telephone')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.date_naissance') }} <span class="google-required">*</span></label>
                            <input type="date" class="google-input @error('date_naissance') is-invalid @enderror" 
                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.genre') }} <span class="google-required">*</span></label>
                            <div class="google-radio-group">
                                <label class="google-radio-label">
                                    <input type="radio" name="genre" value="M" 
                                           {{ old('genre') == 'M' ? 'checked' : '' }} required>
                                    <span class="google-radio-text">{{ __('app.M') }}</span>
                                </label>
                                <label class="google-radio-label">
                                    <input type="radio" name="genre" value="F" 
                                           {{ old('genre') == 'F' ? 'checked' : '' }} required>
                                    <span class="google-radio-text">{{ __('app.F') }}</span>
                                </label>
                            </div>
                            @error('genre')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.classe') }} <span class="google-required">*</span></label>
                            <select class="google-input @error('id_classe') is-invalid @enderror" 
                                    id="id_classe" name="id_classe" required>
                                <option value="">{{ __('app.choisir_classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.adresse') }}</label>
                            <input type="text" class="google-input @error('adresse') is-invalid @enderror" 
                                   id="adresse" name="adresse" value="{{ old('adresse') }}" 
                                   placeholder="{{ __('app.adresse_complete') }}">
                            @error('adresse')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="google-form-actions">
                    <a href="{{ route('admin.etudiants.index') }}" class="google-btn google-btn-text">
                        {{ __('app.annuler') }}
                    </a>
                    <button type="submit" class="google-btn google-btn-primary">
                        {{ __('app.enregistrer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

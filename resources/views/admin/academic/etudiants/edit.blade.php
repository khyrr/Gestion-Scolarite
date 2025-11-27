@extends('admin.layouts.dashboard')

@section('title', __('app.modifier_etudiant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.etudiants.index') }}">{{ __('app.etudiants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    <a href="{{ route('admin.etudiants.show', $etudiant) }}" class="btn btn-outline-primary">
        {{ __('app.voir') }}
    </a>
@endsection

@section('content')
<div class="google-container">
    <!-- Statistics Overview -->
    <div class="google-stats-overview">
        <div class="google-stat-mini">
            <div class="google-stat-mini-label">{{ __('app.etudiant') }}</div>
            <div class="google-stat-mini-value">{{ $etudiant->prenom }} {{ $etudiant->nom }}</div>
        </div>
        <div class="google-stat-mini">
            <div class="google-stat-mini-label">{{ __('app.classe') }}</div>
            <div class="google-stat-mini-value">{{ $etudiant->classe?->nom_classe ?? 'N/A' }}</div>
        </div>
        <div class="google-stat-mini">
            <div class="google-stat-mini-label">{{ __('app.genre') }}</div>
            <div class="google-stat-mini-value">{{ ucfirst($etudiant->genre ?? 'N/A') }}</div>
        </div>
    </div>

    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h1 class="google-form-title">{{ __('app.modifier_etudiant') }}</h1>
            </div>

            <form action="{{ route('admin.etudiants.update', $etudiant) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.nom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required 
                                   placeholder="{{ __('app.nom') }}">
                            @error('nom')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.prenom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required 
                                   placeholder="{{ __('app.prenom') }}">
                            @error('prenom')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.email') }}</label>
                            <input type="email" class="google-input @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $etudiant->email) }}" 
                                   placeholder="{{ __('app.email') }}">
                            @error('email')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.telephone') }} <span class="google-required">*</span></label>
                            <input type="tel" class="google-input @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required 
                                   placeholder="{{ __('app.telephone') }}">
                            @error('telephone')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.date_naissance') }} <span class="google-required">*</span></label>
                            <input type="date" class="google-input @error('date_naissance') is-invalid @enderror" 
                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required>
                            @error('date_naissance')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.genre') }} <span class="google-required">*</span></label>
                            <div class="google-radio-group">
                                <label class="google-radio-label">
                                    <input type="radio" name="genre" value="masculin" 
                                           {{ old('genre', $etudiant->genre) == 'masculin' ? 'checked' : '' }} required>
                                    <span class="google-radio-text">{{ __('app.masculin') }}</span>
                                </label>
                                <label class="google-radio-label">
                                    <input type="radio" name="genre" value="feminin" 
                                           {{ old('genre', $etudiant->genre) == 'feminin' ? 'checked' : '' }} required>
                                    <span class="google-radio-text">{{ __('app.feminin') }}</span>
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
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe', $etudiant->id_classe) == $classe->id_classe ? 'selected' : '' }}>
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
                                   id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" 
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
                    <div class="google-btn-group">
                        <a href="{{ route('admin.etudiants.show', $etudiant) }}" class="google-btn google-btn-text">
                            {{ __('app.voir') }}
                        </a>
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('app.sauvegarder') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- @endsection
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

        /* Statistics Overview */
        .google-stats-overview {
            max-width: 800px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--google-spacing-md);
            padding: var(--google-spacing-lg);
            margin-bottom: var(--google-spacing-lg);
        }

        .google-stat-mini {
            background: white;
            border: 1px solid var(--google-gray-300);
            border-radius: 8px;
            padding: var(--google-spacing-lg);
            text-align: center;
        }

        .google-stat-mini-label {
            font-size: 0.75rem;
            color: var(--google-gray-600);
            margin-bottom: var(--google-spacing-xs);
        }

        .google-stat-mini-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--google-gray-900);
        }

        /* Form Wrapper */
        .google-form-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--google-spacing-lg) var(--google-spacing-lg);
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

        /* Form Section */
        .google-form-section {
            margin-bottom: var(--google-spacing-xl);
        }

        .google-form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--google-spacing-lg);
        }

        .google-form-group {
            display: flex;
            flex-direction: column;
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

        /* Form Inputs */
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

        .google-input.is-invalid {
            border-color: #d93025;
        }

        .google-input.is-invalid:focus {
            box-shadow: 0 0 0 1px #d93025;
        }

        .google-input:disabled {
            background: var(--google-gray-100);
            color: var(--google-gray-600);
            cursor: not-allowed;
        }



        .google-error-text {
            font-size: 0.75rem;
            color: #d93025;
            margin-top: var(--google-spacing-xs);
        }

        /* Radio Group */
        .google-radio-group {
            display: flex;
            gap: var(--google-spacing-md);
            width: 100%;
        }

        .google-radio-label {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 8px 12px;
            border: 1px solid var(--google-gray-300);
            border-radius: 4px;
            transition: var(--google-transition);
            background: white;
            flex: 1;
            min-height: 36px;
        }

        .google-radio-label:hover {
            border-color: var(--google-gray-400);
            background: var(--google-gray-50);
        }

        .google-radio-label input[type="radio"] {
            margin: 0;
            margin-right: var(--google-spacing-sm);
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--google-blue);
            flex-shrink: 0;
        }

        .google-radio-label:has(input[type="radio"]:checked) {
            border-color: var(--google-blue);
            background: var(--google-blue-light);
        }

        .google-radio-text {
            font-size: 0.875rem;
            color: var(--google-gray-900);
            font-weight: 400;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .google-stats-overview {
                grid-template-columns: repeat(3, 1fr);
                padding: 0 var(--google-spacing-md) var(--google-spacing-md);
                gap: var(--google-spacing-sm);
            }

            .google-stat-mini {
                padding: var(--google-spacing-md);
            }

            .google-stat-mini-value {
                font-size: 0.875rem;
            }

            .google-form-wrapper {
                padding: 0 var(--google-spacing-md) var(--google-spacing-md);
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

            .google-radio-group {
                gap: var(--google-spacing-sm);
            }
        }

        @media (max-width: 480px) {
            .google-stats-overview {
                grid-template-columns: 1fr;
                padding: 0 var(--google-spacing-sm) var(--google-spacing-sm);
            }

            .google-form-wrapper {
                padding: 0 var(--google-spacing-sm) var(--google-spacing-sm);
            }

            .google-form-card {
                padding: var(--google-spacing-md);
            }

            .google-form-title {
                font-size: 1.25rem;
            }

            .google-form-actions {
                flex-direction: column;
                gap: var(--google-spacing-sm);
            }

    -->

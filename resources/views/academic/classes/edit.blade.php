@extends('layouts.dashboard')

@section('title', __('app.modifier_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $classe->nom_classe }}</li>
@endsection

@section('content')
    <div class="google-container">
        <div class="google-form-wrapper">
            <!-- Header -->
            <div class="google-form-header">
                <h1 class="google-form-title">{{ __('app.modifier_classe') }}</h1>
                <p class="google-form-subtitle">{{ $classe->nom_classe }}</p>
            </div>

            <!-- Statistics Overview -->
            <div class="google-stats-overview">
                <div class="google-stat-mini">
                    <div class="google-stat-mini-value">{{ $classe->etudiants->count() }}</div>
                    <div class="google-stat-mini-label">{{ __('app.etudiants_inscrits') }}</div>
                </div>
                <div class="google-stat-mini">
                    <div class="google-stat-mini-value">{{ $classe->cours->count() }}</div>
                    <div class="google-stat-mini-label">{{ __('app.cours_assignes') }}</div>
                </div>
                <div class="google-stat-mini">
                    <div class="google-stat-mini-value">{{ $classe->created_at?->format('d/m/Y') ?? 'N/A' }}</div>
                    <div class="google-stat-mini-label">{{ __('app.creee_le') }}</div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="google-form-card">
                <form action="{{ route('classes.update', $classe->id_classe) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Form Fields -->
                    <div class="google-form-section">
                        <div class="google-form-row">
                            <div class="google-form-group">
                                <label class="google-label" for="nom_classe">
                                    {{ __('app.nom_classe') }}
                                </label>
                                <input 
                                    type="text" 
                                    class="google-input @error('nom_classe') google-input-error @enderror" 
                                    id="nom_classe"
                                    name="nom_classe"
                                    placeholder="{{ __('app.exemple_classe') }}"
                                    value="{{ old('nom_classe', $classe->nom_classe) }}"
                                    required
                                    autofocus
                                >
                                @error('nom_classe')
                                    <span class="google-error-text">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="google-form-group">
                                <label class="google-label" for="niveau">
                                    {{ __('app.niveau') }} <span class="google-required">*</span>
                                </label>
                                <select 
                                    class="google-input @error('niveau') google-input-error @enderror" 
                                    id="niveau"
                                    name="niveau"
                                    required
                                >
                                    <option value="">{{ __('app.selectionner_niveau') }}</option>
                                    <option value="CP" {{ old('niveau', $classe->niveau) == 'CP' ? 'selected' : '' }}>CP</option>
                                    <option value="CE1" {{ old('niveau', $classe->niveau) == 'CE1' ? 'selected' : '' }}>CE1</option>
                                    <option value="CE2" {{ old('niveau', $classe->niveau) == 'CE2' ? 'selected' : '' }}>CE2</option>
                                    <option value="CM1" {{ old('niveau', $classe->niveau) == 'CM1' ? 'selected' : '' }}>CM1</option>
                                    <option value="CM2" {{ old('niveau', $classe->niveau) == 'CM2' ? 'selected' : '' }}>CM2</option>
                                </select>
                                @error('niveau')
                                    <span class="google-error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="google-form-actions">
                        <a href="{{ route('classes.index') }}" class="google-btn google-btn-text">
                            {{ __('app.annuler') }}
                        </a>
                        
                        <div class="google-btn-group">
                            <a href="{{ route('classes.show', $classe->id_classe) }}" class="google-btn google-btn-text">
                                {{ __('app.voir') }}
                            </a>
                            <button type="submit" class="google-btn google-btn-primary">
                                {{ __('app.enregistrer') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Google Design Variables */
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

    .google-input-error {
        border-color: #d93025;
    }

    .google-input-error:focus {
        box-shadow: 0 0 0 1px #d93025;
    }

    /* Select Styling */
    select.google-input {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%235f6368' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
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
        }

        .google-form-title {
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
        }

        .google-form-card {
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

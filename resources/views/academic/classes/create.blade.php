@extends('layouts.dashboard')

@section('title', __('app.creer_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.creer') }}</li>
@endsection

@section('content')
    <div class="google-container">
        <div class="google-form-wrapper">
            <!-- Header -->
            <div class="google-form-header">
                <h1 class="google-form-title">{{ __('app.creer_nouvelle_classe') }}</h1>
                <p class="google-form-subtitle">{{ __('app.remplissez_informations_nouvelle_classe') }}</p>
            </div>

            <!-- Form Card -->
            <div class="google-form-card">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    
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
                                    value="{{ old('nom_classe') }}"
                                    required
                                    autofocus
                                >
                                @error('nom_classe')
                                    <span class="google-error-text">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="google-form-group">
                                <label class="google-label" for="niveau">
                                    {{ __('app.niveau') }}
                                </label>
                                <input 
                                    type="number" 
                                    class="google-input @error('niveau') google-input-error @enderror" 
                                    id="niveau"
                                    name="niveau"
                                    placeholder="1, 2, 3..."
                                    value="{{ old('niveau') }}"
                                    required
                                    min="1"
                                    max="12"
                                >
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
                        
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('app.creer_classe') }}
                        </button>
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
        box-shadow: var(--google-shadow-1);
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

        .google-form-actions {
            flex-direction: column-reverse;
        }

        .google-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus first input
    const firstInput = document.querySelector('input[name="nom_classe"]');
    if (firstInput) {
        firstInput.focus();
    }

    // Add smooth validation feedback
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('.form-control-md');

    inputs.forEach(input => {
        input.addEventListener('invalid', function(e) {
            e.preventDefault();
            this.classList.add('is-invalid');
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                if (this.validity.valid) {
                    this.classList.remove('is-invalid');
                }
            }
        });
    });
});
</script>
@endpush

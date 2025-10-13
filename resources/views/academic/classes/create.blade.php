@extends('layouts.dashboard')

@section('title', __('app.creer_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.creer') }}</li>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="d-flex align-items-center mb-4">
                    <div class="form-icon-wrapper me-3">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">{{ __('app.creer_nouvelle_classe') }}</h4>
                        <p class="text-muted mb-0 small">{{ __('app.remplissez_informations_nouvelle_classe') }}</p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="form-card">
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf
                        
                        <!-- Form Fields -->
                        <div class="form-section">
                            <h6 class="form-section-title">{{ __('app.informations_base') }}</h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-md">
                                        <label class="form-label-md" for="nom_classe">
                                            {{ __('app.nom_classe') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control-md @error('nom_classe') is-invalid @enderror" 
                                            id="nom_classe"
                                            name="nom_classe"
                                            placeholder="{{ __('app.exemple_classe') }}"
                                            value="{{ old('nom_classe') }}"
                                            required
                                            autofocus
                                        >
                                        <small class="form-help-text">{{ __('app.aide_nom_classe') }}</small>
                                        @error('nom_classe')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group-md">
                                        <label class="form-label-md" for="niveau">
                                            {{ __('app.niveau') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control-md @error('niveau') is-invalid @enderror" 
                                            id="niveau"
                                            name="niveau"
                                            placeholder="1, 2, 3..."
                                            value="{{ old('niveau') }}"
                                            required
                                            min="1"
                                            max="12"
                                        >
                                        <small class="form-help-text">{{ __('app.aide_niveau_classe') }}</small>
                                        @error('niveau')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="info-box">
                            <div class="info-box-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">{{ __('app.conseil_creation') }}</h6>
                                <p class="mb-0 small">{{ __('app.vous_pourrez_ajouter_etudiants_cours_apres_creation') }}</p>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="{{ route('classes.index') }}" class="btn-md btn-secondary">
                                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
                                {{ __('app.annuler') }}
                            </a>
                            
                            <button type="submit" class="btn-md btn-primary">
                                <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
                                {{ __('app.creer_classe') }}
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
    /* Material Design Variables */
    :root {
        --md-primary: #0d6efd;
        --md-primary-hover: #0b5ed7;
        --md-gray-50: #f8f9fa;
        --md-gray-100: #f1f3f5;
        --md-gray-200: #e9ecef;
        --md-gray-300: #dee2e6;
        --md-gray-400: #ced4da;
        --md-gray-500: #adb5bd;
        --md-gray-600: #6c757d;
        --md-gray-700: #495057;
        --md-gray-800: #343a40;
        --md-gray-900: #212529;
        --md-radius: 12px;
        --md-radius-sm: 8px;
        --md-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --md-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        --md-shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        --md-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Container */
    .container-fluid {
        max-width: 1400px;
    }

    /* Header Icon */
    .form-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: var(--md-shadow);
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: var(--md-radius);
        box-shadow: var(--md-shadow-sm);
        border: 1px solid var(--md-gray-200);
        overflow: hidden;
        transition: var(--md-transition);
    }

    .form-card form {
        padding: 32px;
    }

    /* Form Section */
    .form-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--md-gray-200);
    }

    .form-section:last-of-type {
        margin-bottom: 24px;
        padding-bottom: 0;
        border-bottom: none;
    }

    .form-section-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--md-gray-700);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    /* Form Groups */
    .form-group-md {
        margin-bottom: 24px;
    }

    .form-group-md:last-child {
        margin-bottom: 0;
    }

    /* Form Labels */
    .form-label-md {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--md-gray-700);
        margin-bottom: 8px;
    }

    /* Form Controls */
    .form-control-md {
        width: 100%;
        padding: 12px 16px;
        font-size: 15px;
        line-height: 1.5;
        color: var(--md-gray-900);
        background-color: var(--md-gray-50);
        border: 2px solid var(--md-gray-300);
        border-radius: var(--md-radius-sm);
        transition: var(--md-transition);
    }

    .form-control-md:focus {
        outline: none;
        background-color: white;
        border-color: var(--md-primary);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .form-control-md::placeholder {
        color: var(--md-gray-500);
    }

    .form-control-md.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control-md.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    /* Help Text */
    .form-help-text {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: var(--md-gray-600);
    }

    /* Invalid Feedback */
    .invalid-feedback {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: #dc3545;
    }

    /* Info Box */
    .info-box {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 20px;
        background: linear-gradient(135deg, #e3f2fd, #f0f7ff);
        border: 1px solid #bbdefb;
        border-radius: var(--md-radius-sm);
        margin-bottom: 32px;
    }

    .info-box-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--md-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .info-box h6 {
        font-size: 14px;
        font-weight: 600;
        color: var(--md-gray-800);
    }

    .info-box p {
        color: var(--md-gray-700);
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid var(--md-gray-200);
    }

    /* Material Buttons */
    .btn-md {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.5;
        border-radius: var(--md-radius-sm);
        border: none;
        cursor: pointer;
        transition: var(--md-transition);
        text-decoration: none;
        min-height: 44px;
    }

    .btn-md.btn-primary {
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        color: white;
        box-shadow: var(--md-shadow-sm);
    }

    .btn-md.btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--md-shadow);
    }

    .btn-md.btn-primary:active {
        transform: translateY(0);
    }

    .btn-md.btn-secondary {
        background: white;
        color: var(--md-gray-700);
        border: 2px solid var(--md-gray-300);
    }

    .btn-md.btn-secondary:hover {
        background: var(--md-gray-50);
        border-color: var(--md-gray-400);
    }

    /* RTL Support */
    [dir="rtl"] .form-icon-wrapper {
        margin-right: 0;
        margin-left: 1rem;
    }

    [dir="rtl"] .info-box {
        text-align: right;
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .form-card form {
            padding: 24px 20px;
        }

        .form-section {
            margin-bottom: 24px;
            padding-bottom: 24px;
        }

        .form-actions {
            flex-direction: column-reverse;
            gap: 12px;
        }

        .btn-md {
            width: 100%;
        }

        .form-icon-wrapper {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .info-box {
            padding: 14px 16px;
        }

        .info-box-icon {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
    }

    @media (max-width: 575.98px) {
        .container-fluid {
            padding-left: 16px;
            padding-right: 16px;
        }

        .form-card form {
            padding: 20px 16px;
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

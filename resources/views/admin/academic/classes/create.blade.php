@extends('admin.layouts.dashboard')

@section('title', __('app.creer_classe'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">{{ __('app.classes') }}</a></li>
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
                <form action="{{ route('admin.classes.store') }}" method="POST">
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
                        <a href="{{ route('admin.classes.index') }}" class="google-btn google-btn-text">
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

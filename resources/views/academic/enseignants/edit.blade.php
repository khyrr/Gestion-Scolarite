@extends('layouts.dashboard')

@section('title', __('app.modifier_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $enseignant->prenom }} {{ $enseignant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    <a href="{{ route('enseignants.show', $enseignant->id_enseignant) }}" class="btn btn-outline-primary">
        {{ __('app.voir') }}
    </a>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <!-- Mini Stats -->
        <div class="google-mini-stats">
            <div class="google-mini-stat">
                <div class="google-mini-stat-label">Enseignant</div>
                <div class="google-mini-stat-value">{{ $enseignant->prenom }} {{ $enseignant->nom }}</div>
            </div>
            <div class="google-mini-stat">
                <div class="google-mini-stat-label">{{ __('app.matieres') }}</div>
                <div class="google-mini-stat-value">
                    @if($enseignant->matieres && $enseignant->matieres->count() > 0)
                        {{ $enseignant->matieres->first()->nom_matiere }}
                        @if($enseignant->matieres->count() > 1)
                            <small>(+{{ $enseignant->matieres->count() - 1 }})</small>
                        @endif
                    @else
                        N/A
                    @endif
                </div>
            </div>
            <div class="google-mini-stat">
                <div class="google-mini-stat-label">{{ __('app.classes') }}</div>
                <div class="google-mini-stat-value">
                    @if($enseignant->classes && $enseignant->classes->count() > 0)
                        {{ $enseignant->classes->first()->nom_classe }}
                        @if($enseignant->classes->count() > 1)
                            <small>(+{{ $enseignant->classes->count() - 1 }})</small>
                        @endif
                    @else
                        N/A
                    @endif
                </div>
            </div>
        </div>

        <div class="google-form-card">
            <div class="google-form-header">
                <h5 class="google-form-title">{{ __('app.modifier_enseignant') }}</h5>
                <p class="google-form-subtitle">Modifiez les informations de l'enseignant</p>
            </div>

            <form method="POST" action="{{ route('enseignants.update', $enseignant->id_enseignant) }}">
                @csrf
                @method('PUT')

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.nom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $enseignant->nom) }}" required 
                                   placeholder="{{ __('app.nom_famille') }}">
                            @error('nom')
                                <span class="google-error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.prenom') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required 
                                   placeholder="{{ __('app.prenom') }}">
                            @error('prenom')
                                <span class="google-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.email') }} <span class="google-required">*</span></label>
                            <input type="email" class="google-input @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $enseignant->email) }}" required 
                                   placeholder="exemple@ecole.com">
                            @error('email')
                                <span class="google-error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="google-form-group">
                            <label class="google-label">{{ __('app.telephone') }} <span class="google-required">*</span></label>
                            <input type="tel" class="google-input @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone', $enseignant->telephone) }}" required 
                                   placeholder="+222 XX XX XX XX">
                            @error('telephone')
                                <span class="google-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Note: Classes and Matieres are now managed through the pivot table (enseignant_matiere_classe) -->
                    <!-- This form only handles basic enseignant information -->
                    <!-- To manage class and matiere assignments, use the dedicated assignment interface -->
                </div>

                <div class="google-form-actions">
                    <div class="google-button-group-left">
                        <form method="POST" action="{{ route('enseignants.destroy', $enseignant->id_enseignant) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="google-button-danger delete-enseignant" data-enseignant-id="{{ $enseignant->id_enseignant }}">
                                {{ __('app.supprimer') }}
                            </button>
                        </form>
                    </div>
                    <div class="google-button-group-right">
                        <a href="{{ route('enseignants.index') }}" class="google-button-secondary">
                            {{ __('app.annuler') }}
                        </a>
                        <button type="submit" class="google-button-primary">
                            {{ __('app.sauvegarder') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --google-blue: #1a73e8;
        --google-blue-hover: #1967d2;
        --google-red: #d93025;
        --google-red-hover: #c5221f;
        --google-gray-50: #f8f9fa;
        --google-gray-100: #f1f3f4;
        --google-gray-200: #e8eaed;
        --google-gray-300: #dadce0;
        --google-gray-500: #9aa0a6;
        --google-gray-600: #80868b;
        --google-gray-700: #5f6368;
        --google-gray-900: #202124;
        --google-spacing-xs: 4px;
        --google-spacing-sm: 8px;
        --google-spacing-md: 16px;
        --google-spacing-lg: 24px;
        --google-spacing-xl: 32px;
        --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    .google-container {
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .google-form-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: var(--google-spacing-lg);
    }

    /* Mini Stats */
    .google-mini-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--google-spacing-md);
        margin-bottom: var(--google-spacing-lg);
    }

    .google-mini-stat {
        background: white;
        border: 1px solid var(--google-gray-300);
        border-radius: 8px;
        padding: var(--google-spacing-md);
        text-align: center;
    }

    .google-mini-stat-label {
        font-size: 0.75rem;
        color: var(--google-gray-600);
        margin-bottom: var(--google-spacing-xs);
    }

    .google-mini-stat-value {
        font-size: 1rem;
        font-weight: 500;
        color: var(--google-gray-900);
    }

    /* Form Card */
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
        margin: 0 0 var(--google-spacing-xs) 0;
    }

    .google-form-subtitle {
        font-size: 0.875rem;
        color: var(--google-gray-600);
        margin: 0;
    }

    /* Form Section */
    .google-form-section {
        display: flex;
        flex-direction: column;
        gap: var(--google-spacing-md);
    }

    .google-form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: var(--google-spacing-md);
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
        color: var(--google-red);
    }

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
        border-color: var(--google-red);
    }

    .google-error {
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

    .google-button-group-left,
    .google-button-group-right {
        display: flex;
        gap: var(--google-spacing-sm);
    }

    .google-button-primary,
    .google-button-secondary,
    .google-button-danger {
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: var(--google-transition);
    }

    .google-button-primary {
        background: var(--google-blue);
        color: white;
    }

    .google-button-primary:hover {
        background: var(--google-blue-hover);
    }

    .google-button-secondary {
        background: white;
        color: var(--google-gray-700);
        border: 1px solid var(--google-gray-300);
    }

    .google-button-secondary:hover {
        background: var(--google-gray-50);
    }

    .google-button-danger {
        background: white;
        color: var(--google-red);
        border: 1px solid var(--google-gray-300);
    }

    .google-button-danger:hover {
        background: #fce8e6;
        border-color: var(--google-red);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .google-form-wrapper {
            padding: var(--google-spacing-md);
        }

        .google-mini-stats {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--google-spacing-sm);
        }

        .google-mini-stat:first-child {
            grid-column: 1 / -1;
        }

        .google-form-card {
            padding: var(--google-spacing-md);
        }

        .google-form-row {
            grid-template-columns: 1fr;
        }

        .google-form-actions {
            flex-wrap: wrap;
            gap: var(--google-spacing-sm);
        }

        .google-button-group-left,
        .google-button-group-right {
            display: flex;
            gap: var(--google-spacing-sm);
        }

        .google-button-primary,
        .google-button-secondary,
        .google-button-danger {
            flex: 1;
            min-width: 0;
            white-space: nowrap;
        }
    }

    @media (max-width: 480px) {
        .google-form-wrapper {
            padding: var(--google-spacing-sm);
        }

        .google-mini-stat-value {
            font-size: 0.875rem;
        }

        .google-form-title {
            font-size: 1rem;
        }
    }
</style>
@endpush

    <script src="{{ asset('js/regexEnse.js') }}"></script>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.delete-enseignant').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: "Voulez-vous vraiment supprimer cet enseignant ?",
            text: "Si vous le supprimez, il disparaîtra pour toujours.",
            icon: "warning",
            type: "warning",
            buttons: ["Annuler", "Oui!"],
            confirmButtonColor: '#d33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endpush

@extends('admin.layouts.dashboard')

@section('title', __('app.modifier_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }} - {{ $enseignant->prenom }} {{ $enseignant->nom }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
    <a href="{{ route('admin.enseignants.show', $enseignant->id_enseignant) }}" class="btn btn-outline-primary">
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

            <form method="POST" action="{{ route('admin.enseignants.update', $enseignant->id_enseignant) }}">
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
                        <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignant->id_enseignant) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="google-button-danger delete-enseignant" data-enseignant-id="{{ $enseignant->id_enseignant }}">
                                {{ __('app.supprimer') }}
                            </button>
                        </form>
                    </div>
                    <div class="google-button-group-right">
                        <a href="{{ route('admin.enseignants.index') }}" class="google-button-secondary">
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

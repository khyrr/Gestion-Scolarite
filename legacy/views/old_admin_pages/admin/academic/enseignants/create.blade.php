@extends('admin.layouts.dashboard')

@section('title', __('app.ajouter_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.ajouter_enseignant') }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.enseignants.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h1 class="google-form-title">{{ __('app.ajouter_enseignant') }}</h1>
                <p class="google-form-subtitle">Remplissez les informations de l'enseignant</p>
            </div>

        <form method="POST" action="{{ route('admin.enseignants.store') }}">
            @csrf
            
            <div class="google-form-section">
                <div class="google-form-row">
                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.nom') }} <span class="google-required">*</span></label>
                        <input type="text" class="google-input @error('nom') is-invalid @enderror" 
                               id="nom" name="nom" value="{{ old('nom') }}" required 
                               placeholder="{{ __('app.nom_famille') }}">
                        @error('nom')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.prenom') }} <span class="google-required">*</span></label>
                        <input type="text" class="google-input @error('prenom') is-invalid @enderror" 
                               id="prenom" name="prenom" value="{{ old('prenom') }}" required 
                               placeholder="{{ __('app.prenom') }}">
                        @error('prenom')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.email') }} <span class="google-required">*</span></label>
                        <input type="email" class="google-input @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required 
                               placeholder="exemple@ecole.com">
                        @error('email')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.telephone') }} <span class="google-required">*</span></label>
                        <input type="tel" class="google-input @error('telephone') is-invalid @enderror" 
                               id="telephone" name="telephone" value="{{ old('telephone') }}" required 
                               placeholder="+222 XX XX XX XX">
                        @error('telephone')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.classe_assignee') }} <span class="google-required">*</span></label>
                        <select class="google-input @error('id_classe') is-invalid @enderror" 
                                id="id_classe" name="id_classe" required>
                            <option value="">{{ __('app.selectionner_classe') }}</option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                    {{ $classe->nom_classe }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_classe')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="google-form-group">
                        <label class="google-label">{{ __('app.matiere_enseignee') }} <span class="google-required">*</span></label>
                        <select class="google-input @error('matiere') is-invalid @enderror" 
                                id="matiere" name="matiere" required>
                            <option value="">{{ __('app.selectionner_matiere') }}</option>
                            <option value="Mathématiques" {{ old('matiere') == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                            <option value="Français" {{ old('matiere') == 'Français' ? 'selected' : '' }}>Français</option>
                            <option value="Anglais" {{ old('matiere') == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                            <option value="Sciences Physiques" {{ old('matiere') == 'Sciences Physiques' ? 'selected' : '' }}>Sciences Physiques</option>
                            <option value="Biologie" {{ old('matiere') == 'Biologie' ? 'selected' : '' }}>Biologie</option>
                            <option value="Histoire-Géographie" {{ old('matiere') == 'Histoire-Géographie' ? 'selected' : '' }}>Histoire-Géographie</option>
                            <option value="اللغة العربية" {{ old('matiere') == 'اللغة العربية' ? 'selected' : '' }}>اللغة العربية</option>
                            <option value="التربية الإسلامية" {{ old('matiere') == 'التربية الإسلامية' ? 'selected' : '' }}>التربية الإسلامية</option>
                            <option value="التربية المدنية" {{ old('matiere') == 'التربية المدنية' ? 'selected' : '' }}>التربية المدنية</option>
                            <option value="التربية البدنية" {{ old('matiere') == 'التربية البدنية' ? 'selected' : '' }}>التربية البدنية</option>
                        </select>
                        @error('matiere')
                            <span class="google-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="google-form-actions">
                <a href="{{ route('admin.enseignants.index') }}" class="google-button google-button-text">
                    {{ __('app.annuler') }}
                </a>
                <button type="submit" class="google-button google-button-primary">
                    {{ __('app.enregistrer') }}
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
    
    <script>
        const classeSelect = document.getElementById("id_classe");
        const matiereSelect = document.getElementById("matiere");

        function enableMatiereOptions() {
            matiereSelect.removeAttribute("disabled");
        }
        const matiereOptions = {
            1: ["اللغة العربية", "Calcule", "التربية الإسلامية"],
            2: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            3: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            4: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            5: ["اللغة العربية", "Calcule", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            6: ["Mathématiques","اللغة العربية", "Français", "Sciences naturelles", "التربية الإسلامية", "التربية المدنية",
                "التاريخ و الجغرافيا"
            ],
            7: ["Mathématiques","Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            8: ["Mathématiques","Français", "Anglais", "التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            9: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            10: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles",
                "التاريخ و الجغرافيا", "التربية المدنية"
            ],
            11: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "التربية المدنية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            12: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "التربية المدنية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            13: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
            14: ["Mathématiques","Français", "Anglais","التربية الإسلامية", "اللغة العربية", "Physique Chimie", "Sciences naturelles"],
        };

        function updateMatiereOptions() {
            const selectedClasse = classeSelect.value;
            const matiereOptionsForClasse = matiereOptions[selectedClasse];

            matiereSelect.innerHTML = "";

            const defaultOption = document.createElement("option");
            defaultOption.text = "Choisir le matiere";
            defaultOption.value = '';
            defaultOption.disabled = true; // Set the disabled attribute
            defaultOption.selected = true; // Select the default option
            matiereSelect.appendChild(defaultOption);

            // Add new options to the matiere select
            matiereOptionsForClasse.forEach(matiere => {
                const option = document.createElement("option");
                option.text = matiere;
                matiereSelect.appendChild(option);

            });
            enableMatiereOptions();
        }

        // Listen for changes in the classe select and update matiere options
        classeSelect.addEventListener("change", updateMatiereOptions);

        // Initial update to set matiere options based on the default selected classe
        updateMatiereOptions();
    </script>
    <script src="{{ asset('js/regexEnse.js')}}"></script>
@endsection

@push('styles')
<style>
    margin: 0 auto;
    padding: var(--google-spacing-lg);
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
    margin: 0 0 var(--google-spacing-xs) 0;
}

.google-form-subtitle {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0;
}

.google-form-section {
    margin-bottom: var(--google-spacing-lg);
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

.google-error {
    font-size: 0.75rem;
    color: #d93025;
    margin-top: var(--google-spacing-xs);
}

.google-form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--google-spacing-lg);
    border-top: 1px solid var(--google-gray-300);
    gap: var(--google-spacing-sm);
}

/* Buttons */
.google-button {
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

.google-button-text {
    background: transparent;
    color: var(--google-blue);
}

.google-button-text:hover {
    background: var(--google-blue-light);
    color: var(--google-blue-hover);
}

.google-button-primary {
    background: var(--google-blue);
    color: white;
}

.google-button-primary:hover {
    background: var(--google-blue-hover);
    box-shadow: var(--google-shadow-1);
    color: white;
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
</style>
@endpush
@extends('layouts.dashboard')

@section('title', __('app.ajouter_enseignant'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('enseignants.index') }}">{{ __('app.enseignants') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.ajouter_enseignant') }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary">
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
                        <h5 class="form-title">{{ __('app.ajouter_enseignant') }}</h5>
                        <p class="form-subtitle">Remplissez les informations de l'enseignant</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('enseignants.store') }}">
                    @csrf
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.nom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required 
                                   placeholder="{{ __('app.nom_famille') }}">
                            @error('nom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.prenom') }} <span class="required">*</span></label>
                            <input type="text" class="form-control-md @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom') }}" required 
                                   placeholder="{{ __('app.prenom') }}">
                            @error('prenom')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-md">{{ __('app.email') }} <span class="required">*</span></label>
                            <input type="email" class="form-control-md @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required 
                                   placeholder="exemple@ecole.com">
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
                            <label class="form-label-md">{{ __('app.classe_assignee') }} <span class="required">*</span></label>
                            <select class="form-control-md @error('id_classe') is-invalid @enderror" 
                                    id="id_classe" name="id_classe" required>
                                <option value="">{{ __('app.selectionner_classe') }}</option>
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
                            <label class="form-label-md">{{ __('app.matiere_enseignee') }} <span class="required">*</span></label>
                            <select class="form-control-md @error('matiere') is-invalid @enderror" 
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
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('enseignants.index') }}" class="btn-md btn-secondary">
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
:root {
    --md-primary: #0d6efd;
    --md-primary-dark: #0a58ca;
    --md-gray-50: #fafafa;
    --md-gray-100: #f5f5f5;
    --md-gray-200: #eeeeee;
    --md-gray-300: #e0e0e0;
    --md-gray-600: #757575;
    --md-gray-700: #616161;
    --md-gray-800: #424242;
    --md-gray-900: #212529;
    --md-radius: 12px;
    --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.form-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 36px;
    box-shadow: var(--md-shadow);
}

.form-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 2px solid var(--md-gray-200);
}

.form-icon-wrapper {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.form-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.form-subtitle {
    font-size: 14px;
    color: var(--md-gray-600);
    margin: 4px 0 0 0;
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
    font-size: 13px;
    font-weight: 600;
    color: var(--md-gray-700);
    margin-bottom: 8px;
}

.required {
    color: #dc3545;
}

.form-control-md {
    padding: 12px 16px;
    border: 1px solid var(--md-gray-300);
    border-radius: 8px;
    font-size: 14px;
    color: var(--md-gray-900);
    transition: all 0.3s;
    background: white;
}

.form-control-md:focus {
    outline: none;
    border-color: var(--md-primary);
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

.form-control-md.is-invalid {
    border-color: #dc3545;
}

.error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 6px;
    display: block;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 24px;
    border-top: 1px solid var(--md-gray-200);
}

.btn-md {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--md-primary) 0%, var(--md-primary-dark) 100%);
    color: white;
}

.btn-primary:hover {
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    transform: translateY(-2px);
    color: white;
}

.btn-secondary {
    background: var(--md-gray-200);
    color: var(--md-gray-700);
}

.btn-secondary:hover {
    background: var(--md-gray-300);
    color: var(--md-gray-800);
}

[dir="rtl"] .form-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .form-actions {
    justify-content: flex-start;
}

[dir="rtl"] .btn-md {
    flex-direction: row-reverse;
}

@media (max-width: 767px) {
    .form-card {
        padding: 24px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-header {
        flex-direction: column;
        align-items: flex-start;
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

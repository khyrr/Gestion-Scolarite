@extends('admin.layouts.dashboard')

@section('title', __('app.nouvelle_evaluation'))

@section('breadcrumbs')
<x-breadcrumb>
    <x-breadcrumb-item href="{{ route('admin.dashboard') }}">{{ __('Tableau de bord') }}</x-breadcrumb-item>
    <x-breadcrumb-item href="{{ route('admin.evaluations.index') }}">{{ __('Évaluations') }}</x-breadcrumb-item>
    <x-breadcrumb-item active>{{ __('Ajouter') }}</x-breadcrumb-item>
</x-breadcrumb>
@endsection

@section('content')
<div class="google-container">
    <div class="google-form-wrapper">
        <div class="google-form-card">
            <div class="google-form-header">
                <h2 class="google-form-title">{{ __('Programmer une nouvelle évaluation') }}</h2>
            </div>

            <form method="POST" action="{{ route('admin.evaluations.store') }}">
                @csrf

                <div class="google-form-section">
                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="type">{{ __('Type d\'évaluation') }} <span class="google-required">*</span></label>
                            <select name="type" id="type" class="google-input @error('type') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner un type') }}</option>
                                <option value="devoir" {{ old('type') == 'devoir' ? 'selected' : '' }}>{{ __('Devoir') }}</option>
                                <option value="controle" {{ old('type') == 'controle' ? 'selected' : '' }}>{{ __('Contrôle') }}</option>
                                <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>{{ __('Examen') }}</option>
                            </select>
                            @error('type')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="id_classe">{{ __('Classe') }} <span class="google-required">*</span></label>
                            <select name="id_classe" id="id_classe" class="google-input @error('id_classe') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une classe') }}</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id_classe }}" {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                        {{ $classe->nom_classe }} (Niveau {{ $classe->niveau }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_classe')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="matiere">{{ __('Matière') }} <span class="google-required">*</span></label>
                            <select name="matiere" id="matiere" class="google-input @error('matiere') is-invalid @enderror" required>
                                <option value="">{{ __('Sélectionner une matière') }}</option>
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
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="date">{{ __('Date de l\'évaluation') }} <span class="google-required">*</span></label>
                            <input type="date" name="date" id="date" class="google-input @error('date') is-invalid @enderror" 
                                   value="{{ old('date') }}" required>
                            @error('date')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group">
                            <label class="google-label" for="date_debut">{{ __('Heure de début') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_debut" id="date_debut" class="google-input @error('date_debut') is-invalid @enderror" 
                                   value="{{ old('date_debut') }}" required>
                            @error('date_debut')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="google-form-group">
                            <label class="google-label" for="date_fin">{{ __('Heure de fin') }} <span class="google-required">*</span></label>
                            <input type="time" name="date_fin" id="date_fin" class="google-input @error('date_fin') is-invalid @enderror" 
                                   value="{{ old('date_fin') }}" required>
                            @error('date_fin')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="google-form-row">
                        <div class="google-form-group google-full-width">
                            <label class="google-label" for="description">{{ __('Description ou instructions (optionnel)') }}</label>
                            <textarea name="description" id="description" rows="3" class="google-input @error('description') is-invalid @enderror" 
                                      placeholder="Instructions spéciales, matériel autorisé, consignes particulières...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="google-error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="google-form-actions">
                    <div></div>
                    <div class="google-button-group">
                        <a href="{{ route('admin.evaluations.index') }}" class="google-btn google-btn-text">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="google-btn google-btn-primary">
                            {{ __('Programmer l\'évaluation') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

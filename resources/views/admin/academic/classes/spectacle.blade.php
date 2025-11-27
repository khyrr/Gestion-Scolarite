@extends('admin.layouts.dashboard')

@section('title', __('app.details_classe') . ' - ' . $classes->nom_classe)

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">{{ __('app.classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.details') }} - {{ $classes->nom_classe }}</li>
@endsection

@section('header-actions')
    <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
        {{ __('app.retour') }}
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ __('app.informations_classe') }} - {{ $classes->nom_classe }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Class Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>{{ __('app.informations_generales') }}</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td><strong>{{ __('app.nom_classe') }}:</strong></td>
                                    <td>{{ $classes->nom_classe }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('app.niveau') }}:</strong></td>
                                    <td>{{ $classes->niveau }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('app.nombre_etudiants') }}:</strong></td>
                                    <td>{{ $classes->etudiants->count() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Students List -->
                    <h6>{{ __('app.liste_etudiants') }}</h6>
                    @if($classes->etudiants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('app.matricule') }}</th>
                                        <th>{{ __('app.nom_complet') }}</th>
                                        <th>{{ __('app.genre') }}</th>
                                        <th>{{ __('app.telephone') }}</th>
                                        <th>{{ __('app.email') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes->etudiants as $item)
                                        <tr>
                                            <td><span class="badge bg-primary">{{ $item->matricule ?? $item->id_etudiant }}</span></td>
                                            <td><strong>{{ $item->prenom }} {{ $item->nom }}</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $item->genre == 'masculin' ? 'info' : 'secondary' }}">
                                                    {{ __('app.' . strtolower($item->genre)) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->telephone ?? 'N/A' }}</td>
                                            <td>{{ $item->email ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h6 class="text-muted">{{ __('app.aucun_etudiant_inscrit') }}</h6>
                            <p class="text-muted">{{ __('app.classe_sans_etudiants') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

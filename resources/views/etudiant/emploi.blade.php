@extends('layouts.dashboard')

@section('title', __('Mon Emploi du Temps'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('etudiant.dashboard') }}">{{ __('Tableau de Bord') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Emploi du Temps') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="bi bi-calendar-week me-2"></i>{{ __('Emploi du Temps') }} - {{ $student->classe->nom_classe ?? 'N/A' }}</h5>
        </div>
        <div class="card-body">
            @if(count($emploi) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 15%">{{ __('Jour') }}</th>
                                <th>{{ __('Cours') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                            @endphp
                            @foreach($jours as $jour)
                                <tr>
                                    <td class="fw-bold bg-light align-middle">{{ $jour }}</td>
                                    <td class="text-start p-0">
                                        @if(isset($emploi[$jour]))
                                            <div class="list-group list-group-flush">
                                                @foreach($emploi[$jour] as $cours)
                                                    <div class="list-group-item border-0 border-bottom">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="badge bg-primary me-2">
                                                                    {{ $cours->date_debut->format('H:i') }} - {{ $cours->date_fin->format('H:i') }}
                                                                </span>
                                                                <span class="fw-bold">{{ $cours->matiere->nom_matiere ?? 'Matière inconnue' }}</span>
                                                            </div>
                                                            <small class="text-muted">
                                                                <i class="bi bi-person me-1"></i>{{ $cours->enseignant->nom ?? '' }} {{ $cours->enseignant->prenom ?? '' }}
                                                            </small>
                                                        </div>
                                                        @if($cours->description)
                                                            <small class="text-muted d-block mt-1 ms-1">{{ $cours->description }}</small>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="p-3 text-muted fst-italic">{{ __('Aucun cours') }}</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>{{ __('Aucun emploi du temps disponible pour votre classe.') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

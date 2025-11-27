@extends('layouts.dashboard')

@section('title', __('Mes Notes'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('etudiant.dashboard') }}">{{ __('Tableau de Bord') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Mes Notes') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="bi bi-journal-text me-2"></i>{{ __('Relevé de Notes') }}</h5>
        </div>
        <div class="card-body">
            @if($notes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Matière') }}</th>
                                <th>{{ __('Évaluation') }}</th>
                                <th>{{ __('Note') }}</th>
                                <th>{{ __('Coefficient') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Enseignant') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $note->evaluation->matiere->nom_matiere ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $note->evaluation->titre ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $note->note >= 10 ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                            {{ $note->note }}/20
                                        </span>
                                    </td>
                                    <td>{{ $note->evaluation->coefficient ?? 1 }}</td>
                                    <td>{{ $note->evaluation->date_evaluation ? $note->evaluation->date_evaluation->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ $note->evaluation->enseignant->nom ?? '' }} {{ $note->evaluation->enseignant->prenom ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>{{ __('Aucune note disponible pour le moment.') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

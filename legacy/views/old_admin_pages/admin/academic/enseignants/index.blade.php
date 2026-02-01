@extends('admin.layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('admin.enseignants.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.ajouter_enseignant') }}</span>
        </a>
    @endadmin
@endsection

@section('content')
    <div class="google-container">
        <!-- Statistics Cards -->
        <div class="google-stats-grid">
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.total_enseignants') }}</div>
                <div class="google-stat-value">{{ $enseignant->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.actifs_ce_mois') }}</div>
                <div class="google-stat-value">{{ $enseignant->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.matieres_enseignees') }}</div>
                <div class="google-stat-value">{{ $enseignant->pluck('matieres')->flatten()->unique('id_matiere')->count() }}</div>
            </div>
            <div class="google-stat-card">
                <div class="google-stat-label">{{ __('app.classes_assignees') }}</div>
                <div class="google-stat-value">{{ $enseignant->filter(function($e) { return $e->classes->count() > 0; })->count() }}</div>
            </div>
        </div>

        <!-- Enseignants Table -->
        <div class="google-table-wrapper">
            <div class="google-table-header">
                <h2 class="google-table-title">{{ __('app.liste_enseignants') }}</h2>
            </div>

            @if($enseignant->count() > 0)
                <!-- Hidden server-side search form: data-table will submit this when search is used -->
                <form method="GET" action="{{ route('admin.enseignants.index') }}" id="teachersSearchForm" class="d-none">
                    <input type="hidden" name="search" value="{{ request('search') }}" />
                </form>

                <x-table.data-table title="{{ __('app.liste_enseignants') }}" :showSearch="true" searchValue="{{ request('search') }}" serverFormId="teachersSearchForm" :showSort="true"
                    :sortOptions="[
                        'nom:asc' => __('Nom A→Z'),
                        'nom:desc' => __('Nom Z→A'),
                        'date_ajout:asc' => __('app.date_ajout') . ' ↑',
                        'date_ajout:desc' => __('app.date_ajout') . ' ↓'
                    ]">
                    <table class="google-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.nom_complet') }}</th>
                                <th>{{ __('app.email') }}</th>
                                <th>{{ __('app.telephone') }}</th>
                                <th>{{ __('app.matiere') }}</th>
                                <th>{{ __('app.classe') }}</th>
                                <th>{{ __('app.date_ajout') }}</th>
                                <th>{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignant as $item)
                                <tr>
                                    <td>
                                        <div class="google-teacher-name">
                                            <div class="google-avatar">
                                                {{ substr($item->prenom, 0, 1) }}{{ substr($item->nom, 0, 1) }}
                                            </div>
                                            <span class="google-name"> 
                                                <a href="{{ route('admin.enseignants.show', $item) }}">   {{ $item->prenom }} {{ $item->nom }}</a>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $item->email }}" class="google-link">{{ $item->email }}</a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $item->telephone }}" class="google-link">{{ $item->telephone }}</a>
                                    </td>
                                    <td>
                                        @if($item->matieres && $item->matieres->count() > 0)
                                            <span class="google-badge">{{ __('app.' . $item->matieres->first()->code_matiere) }}</span>
                                            @if($item->matieres->count() > 1)
                                                <span class="google-badge google-badge-more">+{{ $item->matieres->count() - 1 }} {{ __('app.autres') }}</span>
                                            @endif
                                        @else
                                            <span class="google-text-na">{{ __('app.non_assigne') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->classes && $item->classes->count() > 0)
                                            <span class="google-badge">{{ $item->classes->first()->nom_classe }}</span>
                                            @if($item->classes->count() > 1)
                                                <span class="google-badge google-badge-more">+{{ $item->classes->count() - 1 }} {{ __('app.autres') }}</span>
                                            @endif
                                        @else
                                            <span class="google-text-na">{{ __('app.non_assigne') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @include('admin.academic.enseignants.partials.actions', ['teacher' => $item])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @slot('footer')
                    @if($enseignant->hasPages())
                        <div class="google-pagination-wrapper">
                            {{ $enseignant->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                @endslot
                </x-table.data-table>
            @else
                <div class="google-empty-state">
                    <i class="fas fa-search google-empty-icon" aria-hidden="true"></i>
                    <h4 class="google-empty-title">{{ __('app.no_data') }}</h4>
                    <p class="google-empty-text">{{ __('app.aucun_enseignant_ajoute') }}</p>
                    @admin
                        <a href="{{ route('admin.enseignants.create') }}" class="google-btn google-btn-primary">
                            {{ __('app.ajouter_premier_enseignant') }}
                        </a>
                    @endadmin
                </div>
            @endif
        </div>
    </div>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Gestion des IP') }} - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #fff; box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3); }
        .navbar-brand { font-family: 'Google Sans', sans-serif; color: #5f6368; font-weight: 500; }
        .card { border: none; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3); }
        .btn-primary { background-color: #d93025; border-color: #d93025; }
        .btn-primary:hover { background-color: #b31412; border-color: #b31412; }
        .table th { font-weight: 500; color: #5f6368; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#d93025" style="margin-right: 8px; vertical-align: middle;">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                {{ __('app.retour_tableau_bord')}}
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4" style="font-family: 'Google Sans', sans-serif;">{{ __('app.liste_blanche_ips') }}</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(!config('admin.security.ip_whitelist_enabled'))
                    <div class="alert alert-warning">
                        <strong>{{ __('app.attention') }}:</strong> {{ __('app.ip_filtering_disabled') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">{{ __('app.ajouter_nouvelle_ip') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.ip.store') }}" method="POST" class="row g-3 align-items-end">
                            @csrf
                            <div class="col-md-4">
                                <label for="ip_address" class="form-label">{{ __('app.adresse_ip') }}</label>
                                <input type="text" class="form-control @error('ip_address') is-invalid @enderror" id="ip_address" name="ip_address" placeholder="ex: 192.168.1.1" required>
                                @error('ip_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="label" class="form-label">{{ __('app.description_optionnelle') }}</label>
                                <input type="text" class="form-control" id="label" name="label" placeholder="{{ __('app.ex_bureau_directeur') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('app.ajouter') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('app.adresse_ip') }}</th>
                                    <th>{{ __('app.description_optionnelle') }}</th>
                                    <th>{{ __('app.ajoute_par') }}</th>
                                    <th>{{ __('app.date_ajout') }}</th>
                                    <th>{{ __('app.statut') }}</th>
                                    <th>{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ips as $ip)
                                    <tr>
                                        <td>{{ $ip->ip_address }}</td>
                                        <td>{{ $ip->label ?? '-' }}</td>
                                        <td>{{ $ip->addedBy->prenom ?? '' }} {{ $ip->addedBy->nom ?? __('app.system') }}</td>
                                        <td>{{ $ip->created_at ? $ip->created_at->format('d/m/Y H:i') : '-' }}</td>
                                        <td>
                                            @if($ip->is_active)
                                                <span class="badge bg-success">{{ __('app.actif') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('app.inactif') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('admin.settings.ip.toggle', $ip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ $ip->is_active ? __('app.desactiver') : __('app.activer') }}">
                                                        {{ $ip->is_active ? __('app.desactiver') : __('app.activer') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.settings.ip.destroy', $ip) }}" method="POST" class="d-inline ms-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('app.confirmer_suppression') }}')">{{ __('app.supprimer') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">{{ __('app.aucune_adresse_ip_configuree') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

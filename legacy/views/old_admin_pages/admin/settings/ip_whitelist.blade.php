@extends('admin.layouts.dashboard')
@section('title', __('app.liste_blanche_ips'))
@section('content')

    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-md-12">
                @if(!config('admin.security.ip_whitelist_enabled'))
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>
                            <strong>{{ __('app.attention') }}:</strong> {{ __('app.ip_filtering_disabled') }}
                        </div>
                    </div>
                @endif

                {{-- Add New IP Card --}}
                <div class="google-card mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="google-table-title mb-0">{{ __('app.ajouter_nouvelle_ip') }}</h5>
                    </div>
                    
                    <form action="{{ route('admin.settings.ip.store') }}" method="POST" class="row g-3 align-items-end">
                        @csrf
                        <div class="col-md-4">
                            <label for="ip_address" class="google-label">{{ __('app.adresse_ip') }} <span class="google-required">*</span></label>
                            <input type="text" class="google-input @error('ip_address') is-invalid @enderror" id="ip_address" name="ip_address" placeholder="ex: 192.168.1.1" required>
                            @error('ip_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="label" class="google-label">{{ __('app.description_optionnelle') }}</label>
                            <input type="text" class="google-input" id="label" name="label" placeholder="{{ __('app.ex_bureau_directeur') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="google-btn google-btn-primary">
                                <i class="fas fa-plus"></i> {{ __('app.ajouter') }}
                            </button>
                        </div>
                    </form>
                </div>

                {{-- IP List Card --}}
                <div class="google-card">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="google-table-title mb-0">{{ __('app.liste_blanche_ips') }}</h5>
                    </div>

                    <div class="google-table-wrapper">
                        <table class="google-table">
                            <thead>
                                <tr>
                                    <th>{{ __('app.adresse_ip') }}</th>
                                    <th>{{ __('app.description_optionnelle') }}</th>
                                    <th>{{ __('app.ajoute_par') }}</th>
                                    <th>{{ __('app.date_ajout') }}</th>
                                    <th>{{ __('app.statut') }}</th>
                                    <th class="text-end">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ips as $ip)
                                    <tr>
                                        <td class="fw-medium">{{ $ip->ip_address }}</td>
                                        <td>{{ $ip->label ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.875rem;">
                                                    {{ substr($ip->addedBy->prenom ?? 'S', 0, 1) }}
                                                </div>
                                                <span>{{ $ip->addedBy->prenom ?? '' }} {{ $ip->addedBy->nom ?? __('app.system') }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $ip->created_at ? $ip->created_at->format('d/m/Y H:i') : '-' }}</td>
                                        <td>
                                            @if($ip->is_active)
                                                <span class="google-badge google-badge-success">{{ __('app.actif') }}</span>
                                            @else
                                                <span class="google-badge google-badge-neutral">{{ __('app.inactif') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <form action="{{ route('admin.settings.ip.toggle', $ip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="google-action-btn" title="{{ $ip->is_active ? __('app.desactiver') : __('app.activer') }}">
                                                        <i class="fas {{ $ip->is_active ? 'fa-toggle-on text-success' : 'fa-toggle-off text-muted' }} fa-lg"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.settings.ip.destroy', $ip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="google-action-btn delete" onclick="return confirm('{{ __('app.confirmer_suppression') }}')" title="{{ __('app.supprimer') }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="mb-3 text-muted">
                                                    <i class="fas fa-network-wired fa-3x"></i>
                                                </div>
                                                <h3 class="h5">{{ __('app.aucune_adresse_ip_configuree') }}</h3>
                                                <p class="text-muted">{{ __('app.ajouter_ip_pour_commencer') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
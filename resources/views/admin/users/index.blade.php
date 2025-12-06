@extends('admin.layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_admins') }}</li>
    <li class="breadcrumb-item active">{{ __('app.administrateurs') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
            <i class="fas fa-plus google-icon" aria-hidden="true"></i>
            <span class="d-none d-lg-inline ms-2">{{ __('app.ajouter_admin') }}</span>
        </a>
    @endadmin
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <x-table.data-table title="{{ __('app.liste_admins') }}" :client-mode="true">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('app.id') }}</th>
                        <th>{{ __('app.nom') }}</th>
                        <th>{{ __('app.email') }}</th>
                        <th>{{ __('app.role') }}</th>
                        <th>{{ __('app.2fa_status') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $a)
                    <tr>
                        <td>{{ $a->profile->id_administrateur }}</td>
                        <td>{{ $a->prenom }} {{ $a->nom }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ __('app.' . $a->role) }}</td>
                        <td>{{ $a->profile->two_factor_enabled ? __('app.oui') : __('app.non') }}</td>
                        <td>
                            @if($a->profile->id_administrateur !== auth()->user()->profile->id_administrateur)
                                    <form method="POST" action="{{ route('admin.admins.toggle_2fa', $a->profile->id_administrateur) }}" class="d-inline toggle-2fa-form">
                                    @csrf
                                    <input type="hidden" name="confirmation_code" value="" />
                                    <button type="button" class="btn btn-sm btn-{{ $a->profile->two_factor_enabled ? 'danger' : 'success' }} toggle-2fa-btn" data-admin-email="{{ $a->email }}">
                                        {{ $a->profile->two_factor_enabled ? __('app.desactiver_2fa') : __('app.activer_2fa') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </x-table.data-table>
        </div>
    </div>
</div>

<x-modals.confirm-2fa />

@endsection

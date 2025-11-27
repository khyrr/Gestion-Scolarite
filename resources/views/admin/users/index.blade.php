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
                        <td>{{ $a->id_administrateur }}</td>
                        <td>{{ $a->prenom }} {{ $a->nom }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ __('app.' . $a->role) }}</td>
                        <td>{{ $a->two_factor_enabled ? __('app.oui') : __('app.non') }}</td>
                        <td>
                            @if($a->id_administrateur !== auth('admin')->id())
                                    <form method="POST" action="{{ route('admin.admins.toggle_2fa', $a->id_administrateur) }}" class="d-inline toggle-2fa-form">
                                    @csrf
                                    <input type="hidden" name="confirmation_code" value="" />
                                    <button type="button" class="btn btn-sm btn-{{ $a->two_factor_enabled ? 'danger' : 'success' }} toggle-2fa-btn" data-admin-email="{{ $a->email }}">
                                        {{ $a->two_factor_enabled ? __('app.desactiver_2fa') : __('app.activer_2fa') }}
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

<!-- Confirmation modal -->
<div class="modal fade" id="confirm2faModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('app.confirmer_action') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="confirm2faForm" method="POST" action="#">
      <div class="modal-body">
          @csrf
          <p id="confirmText"></p>
          <div class="mb-3">
              <label for="confirmation_code" class="form-label">{{ __('app.2fa_code') }}</label>
              <input id="confirmation_code" name="confirmation_code" class="form-control" inputmode="numeric" autocomplete="one-time-code" maxlength="6" required />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.annuler') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('app.confirmer') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('confirm2faModal'));
    let activeForm = null;

    document.querySelectorAll('.toggle-2fa-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');
            activeForm = form;
            const email = this.dataset.adminEmail;
            const enabling = this.classList.contains('btn-success');
            document.getElementById('confirmText').textContent = enabling ? `{{ __('app.activer_2fa_description') }} ${email}` : `{{ __('app.desactiver_2fa_description') }} ${email}`;
            // set form action on modal form
            const confirmForm = document.getElementById('confirm2faForm');
            confirmForm.action = form.action;
            modal.show();
        });
    });

    document.getElementById('confirm2faForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const code = document.getElementById('confirmation_code').value.trim();
        if (!code) return;
        // copy code into original form and submit
        if (activeForm) {
            activeForm.querySelector('input[name=confirmation_code]').value = code;
            activeForm.submit();
        }
    });
});
</script>
@endpush

@endsection

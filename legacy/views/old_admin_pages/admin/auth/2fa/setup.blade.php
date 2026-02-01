{{-- resources/views/admin/auth/2fa/setup.blade.php --}}
@extends('admin.layouts.dashboard')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/two-factor.css') }}">
  <link
    href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&family=Roboto+Mono&display=swap"
    rel="stylesheet">
@endpush

@section('title', __('app.two_factor_setup'))

@section('content')

  <div class="tf-wrapper">

    @include('admin.auth.2fa.partials.pending-alert')

    <main class="tf-card" role="main">
      {{-- Header --}}

      @unless($enabled ?? false)
        <h1 class="tf-heading">@lang('app.two_factor_setup')</h1>
        <p class="tf-subheading">@lang('app.setup_minimal_description_short')</p>

        {{-- Setup Flow --}}
        <div class="tf-qr-box">
          @if(!empty($qrData))
            <img class="tf-qr-img" alt="{{ __('app.qr_code_alt') }}" src="{{ $qrData }}">
          @elseif(!empty($provisioningUri))
            <img class="tf-qr-img" alt="{{ __('app.qr_code_alt') }}"
              src="https://chart.googleapis.com/chart?chs=240x240&cht=qr&chl={{ urlencode($provisioningUri) }}&choe=UTF-8">
          @endif
        </div>

        @if(!empty($secret))
          <div class="tf-secret-area">
            <div class="tf-secret-label">@lang('app.secret_label')</div>
            <div class="tf-secret-code" id="tf-secret">{{ $secret }}</div>
            <button type="button" class="tf-btn tf-btn-text" id="copy-secret" style="margin-top:8px; font-size:12px;">
              @lang('app.copy')
            </button>
          </div>
        @endif

        <form id="enable-2fa-form" method="POST" action="{{ route('admin.2fa.enable') }}" autocomplete="off">
          @csrf

          <div class="tf-input-group">
            <label for="code" class="tf-label">@lang('app.enter_code_from_app')</label>
            <input id="code" name="code" type="text" inputmode="numeric" pattern="\d{6}" maxlength="6"
              autocomplete="one-time-code" placeholder="000000" class="tf-input tf-input-code" required autofocus>
            @error('code')
              <div class="tf-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
              </div>
            @enderror
          </div>
        </form>

        <div class="tf-actions">
          @if($regenerated ?? false)
            <form action="{{ route('admin.2fa.clear_pending') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="tf-btn tf-btn-text">
                @lang('app.annuler')
              </button>
            </form>
          @else
            <a href="{{ route('admin.dashboard') }}" class="tf-btn tf-btn-text">
              @lang('app.annuler')
            </a>
          @endif

          <button type="submit" form="enable-2fa-form" class="tf-btn tf-btn-primary">
            @lang('app.activer')
          </button>
        </div>

      @else
        {{-- Enabled State --}}
        <div style="margin-bottom: 32px;">
          <div style="color: var(--gm-success); font-size: 48px; margin-bottom: 16px;">
            <i class="fa-solid fa-check-circle"></i>
          </div>
          <h3 style="font-size: 18px; font-weight: 500;">@lang('app.deux_facteurs_active_court')</h3>
          <p style="color: var(--gm-text-secondary); font-size: 14px;">@lang('app.2fa_active_description')</p>
        </div>

        <div class="tf-actions" style="justify-content: center; flex-direction: column; gap: 8px;">
          <button type="button" id="show-recovery" class="tf-btn tf-btn-text">
            @lang('app.show_recovery_codes')
          </button>

          <button type="button" id="open-regenerate" class="tf-btn tf-btn-text" style="color: var(--gm-danger);">
            @lang('app.regenerate_secret')
          </button>
        </div>

        {{-- Recovery Codes Section --}}
        @php
          $codesList = [];
          if (isset($newRecovery) && is_array($newRecovery)) {
            $codesList = $newRecovery;
          } elseif (isset($recoveryCodes) && is_array($recoveryCodes)) {
            $codesList = $recoveryCodes;
          } else {
            $codes = Auth::user()->profile?->two_factor_recovery_codes;
            $codesList = $codes ? (json_decode($codes, true) ?: []) : [];
          }
        @endphp

        <div id="recovery-section" class="tf-recovery-section hidden">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <h4 style="font-size: 14px; font-weight: 500; margin: 0;">@lang('app.recovery_codes_title')</h4>
            <span style="font-size: 12px; color: var(--gm-text-secondary);">{{ count($codesList) }}
              {{ __('app.restants') }}</span>
          </div>

          <div class="tf-recovery-grid">
            @forelse($codesList as $code)
              <div class="tf-code-item">{{ $code }}</div>
            @empty
              <div style="grid-column: span 2; text-align: center; font-style: italic; color: var(--gm-text-disabled);">
                @lang('app.no_recovery_codes')
              </div>
            @endforelse
          </div>

          @if(isset($newRecovery))
            <div
              style="margin-top: 16px; background: #fef7e0; padding: 12px; border-radius: 4px; font-size: 12px; color: #b06000;">
              <strong>@lang('app.save_recovery_now')</strong>
            </div>
          @endif
        </div>
      @endunless
    </main>
  </div>

  {{-- Regenerate Modal --}}
  <div id="regenerate-modal" class="tf-modal-overlay hidden" aria-hidden="true">
    <div class="tf-modal">
      <h2 style="font-size: 20px; font-weight: 500; margin-bottom: 8px;">@lang('app.regenerate_secret')</h2>
      <p style="font-size: 14px; color: var(--gm-text-secondary); margin-bottom: 24px;">@lang('app.regenerate_notice')</p>

      <form method="POST" action="{{ route('admin.2fa.regenerate') }}" id="regenerate-form">
        @csrf
        <div class="tf-input-group">
          <label for="current-password" class="tf-label">@lang('app.current_password')</label>
          <input id="current-password" name="password" type="password" required class="tf-input"
            autocomplete="current-password">
          @error('password')
            <div class="tf-error">
              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <div class="tf-input-group">
          <label for="current-otp" class="tf-label" id="otp-label">@lang('app.current_otp')</label>
          <input id="current-otp" name="regenerate_code" type="text" required class="tf-input tf-input-code"
            autocomplete="one-time-code" placeholder="000000">
          <button type="button" class="tf-btn tf-btn-text" id="toggle-recovery"
            style="margin-top: 4px; font-size: 12px; padding: 0; height: auto; min-height: 0;">
            @lang('app.use_recovery_code')
          </button>
          @error('regenerate_code')
            <div class="tf-error">
              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <div class="tf-actions">
          <button type="button" id="cancel-regenerate" class="tf-btn tf-btn-text">@lang('app.annuler')</button>
          <button type="submit" class="tf-btn tf-btn-primary">@lang('app.confirmer')</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // --- Copy Secret ---
        const copyBtn = document.getElementById('copy-secret');
        const secretEl = document.getElementById('tf-secret');

        if (copyBtn && secretEl) {
          copyBtn.addEventListener('click', async () => {
            const originalText = copyBtn.textContent;
            const secret = secretEl.textContent.trim();

            try {
              await navigator.clipboard.writeText(secret);
              copyBtn.textContent = @json(__('app.copied'));
              setTimeout(() => {
                copyBtn.textContent = originalText;
              }, 2000);
            } catch (err) {
              alert(@json(__('app.copy_failed')));
            }
          });
        }

        // --- Input Formatting ---
        const codeInputs = document.querySelectorAll('input[name="code"]');
        codeInputs.forEach(input => {
          input.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 6);
          });
        });

        // --- Recovery Toggle ---
        const showRecoveryBtn = document.getElementById('show-recovery');
        const recoverySection = document.getElementById('recovery-section');

        if (showRecoveryBtn && recoverySection) {
          showRecoveryBtn.addEventListener('click', () => {
            // Toggle the 'hidden' class
            recoverySection.classList.toggle('hidden');

            // Update button text based on visibility
            const isHidden = recoverySection.classList.contains('hidden');
            showRecoveryBtn.textContent = isHidden
              ? @json(__('app.show_recovery_codes'))
              : @json(__('app.hide_recovery_codes'));
          });
        }

        // --- Modal Logic ---
        const modal = document.getElementById('regenerate-modal');
        const openBtn = document.getElementById('open-regenerate');
        const cancelBtn = document.getElementById('cancel-regenerate');

        if (modal && openBtn && cancelBtn) {
          const toggleModal = (show) => {
            if (show) {
              modal.classList.remove('hidden');
              modal.querySelector('input')?.focus();
              document.body.style.overflow = 'hidden';
            } else {
              modal.classList.add('hidden');
              document.body.style.overflow = '';
            }
          };

          openBtn.addEventListener('click', () => toggleModal(true));
          cancelBtn.addEventListener('click', () => toggleModal(false));

          modal.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal(false);
          });

          document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
              toggleModal(false);
            }
          });

          // Auto-open modal if there are errors
          @if($errors->has('password') || $errors->has('regenerate_code'))
            toggleModal(true);
          @endif

                  // --- Toggle OTP/Recovery ---
                  const toggleBtn = document.getElementById('toggle-recovery');
          const otpLabel = document.getElementById('otp-label');
          const otpInput = document.getElementById('current-otp');
          let isRecovery = false;

          if (toggleBtn && otpLabel && otpInput) {
            toggleBtn.addEventListener('click', () => {
              isRecovery = !isRecovery;

              if (isRecovery) {
                otpLabel.textContent = @json(__('app.recovery_code'));
                toggleBtn.textContent = @json(__('app.use_otp_code'));
                otpInput.placeholder = 'abcdef12';
              } else {
                otpLabel.textContent = @json(__('app.current_otp'));
                toggleBtn.textContent = @json(__('app.use_recovery_code'));
                otpInput.placeholder = '000000';
              }

              otpInput.focus();
            });
          }
        }
      });
    </script>
  @endpush

@endsection
<!-- Confirmation modal -->
<div class="modal fade" id="confirm2faModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 1px 3px 0 rgba(60,64,67,0.3), 0 4px 8px 3px rgba(60,64,67,0.15);">
      <div class="modal-body" style="padding: 24px; text-align: center;">
          <!-- Icon -->
          <div style="width: 48px; height: 48px; margin: 0 auto 16px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;">
                  <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z" fill="#d93025" />
              </svg>
          </div>

          <h5 class="modal-title" style="font-family: 'Google Sans', sans-serif; color: #202124; font-size: 22px; margin-bottom: 12px;">{{ __('app.confirmer_action') }}</h5>
          
          <p id="confirmText" style="color: #5f6368; margin-bottom: 24px; font-size: 16px; line-height: 1.5;"></p>
          
          <!-- Error Message Container -->
          <div id="otpError" style="display: none; color: #d93025; background-color: #fce8e6; padding: 10px; border-radius: 4px; margin-bottom: 16px; font-size: 14px;"></div>

          <form id="confirm2faForm" method="POST" action="#">
              @csrf
              <div class="mb-4">
                  <label class="form-label" style="display: block; text-align: center; color: #5f6368; margin-bottom: 16px; font-weight: 500;">{{ __('app.2fa_code') }}</label>
                  
                  <!-- Hidden input to store the actual code -->
                  <input type="hidden" id="confirmation_code" name="confirmation_code">
                  
                  <div class="otp-input-container">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="0">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="1">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="2">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="3">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="4">
                      <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="off" data-index="5">
                  </div>
              </div>

              <div style="display: flex; justify-content: center; gap: 12px;">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal" style="color: #5f6368; text-decoration: none; font-weight: 500;">{{ __('app.annuler') }}</button>
                <button type="submit" id="confirmBtn" class="btn btn-primary" disabled style="background-color: #d93025; border-color: #d93025; font-weight: 500; padding: 8px 24px;">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="btn-text">{{ __('app.confirmer') }}</span>
                </button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

<style>
    .otp-input-container {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin: 0 auto;
        max-width: 100%;
    }

    .otp-input {
        width: 45px;
        height: 55px;
        text-align: center;
        font-size: 24px;
        font-weight: 500;
        font-family: 'Courier New', monospace;
        border: 2px solid #dadce0;
        border-radius: 8px;
        outline: none;
        transition: all 0.2s;
        background: #fff;
        color: #202124;
    }

    .otp-input:focus {
        border-color: #d93025;
        box-shadow: 0 0 0 3px rgba(217, 48, 37, 0.1);
    }
    
    .otp-input:not(:placeholder-shown) {
        border-color: #d93025;
    }
    
    .otp-input.is-invalid {
        border-color: #d93025;
        background-color: #fce8e6;
    }

    .btn-link:hover {
        color: #202124 !important;
        background-color: #f1f3f4;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .otp-input-container {
            gap: 6px;
        }

        .otp-input {
            width: 38px;
            height: 48px;
            font-size: 20px;
        }
        
        .modal-body {
            padding: 16px !important;
        }
        
        .modal-title {
            font-size: 20px !important;
        }
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('confirm2faModal');
    const modal = new bootstrap.Modal(modalEl);
    let activeForm = null;
    
    const hiddenInput = document.getElementById('confirmation_code');
    const otpInputs = modalEl.querySelectorAll('.otp-input');
    const confirmBtn = document.getElementById('confirmBtn');
    const errorDiv = document.getElementById('otpError');
    const spinner = confirmBtn.querySelector('.spinner-border');
    const btnText = confirmBtn.querySelector('.btn-text');

    // Reset inputs when modal opens
    modalEl.addEventListener('shown.bs.modal', function () {
        otpInputs.forEach(input => {
            input.value = '';
            input.classList.remove('is-invalid');
        });
        hiddenInput.value = '';
        confirmBtn.disabled = true;
        errorDiv.style.display = 'none';
        errorDiv.textContent = '';
        otpInputs[0].focus();
    });

    // OTP Input Logic
    function updateHiddenInput() {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        hiddenInput.value = otp;
        confirmBtn.disabled = otp.length !== 6;
        
        // Clear error when user starts typing again
        if (errorDiv.style.display !== 'none') {
            errorDiv.style.display = 'none';
            otpInputs.forEach(input => input.classList.remove('is-invalid'));
        }
    }

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function (e) {
            const value = this.value;
            if (!/^\d*$/.test(value)) {
                this.value = '';
                return;
            }
            if (value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            updateHiddenInput();
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');
            if (pastedData.length === 6) {
                pastedData.split('').forEach((char, i) => {
                    if (otpInputs[i]) otpInputs[i].value = char;
                });
                otpInputs[5].focus();
                updateHiddenInput();
            }
        });
        
        input.addEventListener('focus', function () {
            this.select();
        });
    });

    document.querySelectorAll('.toggle-2fa-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');
            activeForm = form;
            const email = this.dataset.adminEmail;
            const enabling = this.classList.contains('btn-success');
            document.getElementById('confirmText').textContent = enabling ? `{{ __('app.activer_2fa_description') }} ${email}` : `{{ __('app.desactiver_2fa_description') }} ${email}`;
            
            const confirmForm = document.getElementById('confirm2faForm');
            confirmForm.action = form.action; 
            
            modal.show();
        });
    });

    document.getElementById('confirm2faForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const code = hiddenInput.value.trim();
        if (code.length !== 6) return; 
        
        // UI Loading State
        confirmBtn.disabled = true;
        spinner.classList.remove('d-none');
        btnText.textContent = '{{ __("app.loading") }}...';
        errorDiv.style.display = 'none';

        // Prepare Data
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('confirmation_code', code);
        
        // If the original form had other inputs (like _method for PUT/DELETE), include them
        if (activeForm) {
            const methodInput = activeForm.querySelector('input[name="_method"]');
            if (methodInput) {
                formData.append('_method', methodInput.value);
            }
        }

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 200) {
                // Success
                window.location.reload();
            } else {
                // Error
                let message = body.message || '{{ __("app.error_occurred") }}';
                if (body.errors && body.errors.confirmation_code) {
                    message = body.errors.confirmation_code[0];
                }
                
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
                
                // Highlight inputs as invalid
                otpInputs.forEach(input => {
                    input.value = '';
                    input.classList.add('is-invalid');
                });
                hiddenInput.value = '';
                otpInputs[0].focus();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorDiv.textContent = '{{ __("app.server_error") }}';
            errorDiv.style.display = 'block';
        })
        .finally(() => {
            // Reset Button State
            confirmBtn.disabled = true; // Keep disabled until they type again
            spinner.classList.add('d-none');
            btnText.textContent = '{{ __("app.confirmer") }}';
        });
    });
});
</script>
@endpush

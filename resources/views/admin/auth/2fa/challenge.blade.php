<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Authentification à deux facteurs') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/auth-google.css') }}" rel="stylesheet">

    <style>
        /* Admin specific overrides */
        .auth-logo path {
            fill: #d93025;
            /* Google Red for Admin */
        }

        .btn-primary {
            background-color: #d93025;
        }

        .btn-primary:hover {
            background-color: #b31412;
        }

        .form-control:focus {
            border-color: #d93025;
            box-shadow: 0 0 0 1px #d93025;
        }

        .form-control:focus+.form-label {
            color: #d93025;
        }

        .auth-link {
            color: #d93025;
        }

        /* 2FA specific styles */
        .auth-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-icon svg {
            width: 24px;
            height: 24px;
        }

        .recovery-link {
            display: inline-block;
            margin-top: 16px;
            font-size: 14px;
            color: #5f6368;
            text-decoration: none;
            transition: color 0.2s;
        }

        .recovery-link:hover {
            color: #d93025;
        }

        /* OTP Input Styles */
        .otp-input-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin: 0 auto;
            max-width: 400px;
        }

        .otp-input {
            width: 50px;
            height: 60px;
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

        @media (max-width: 480px) {
            .otp-input-container {
                gap: 8px;
            }

            .otp-input {
                width: 40px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <!-- Security Icon -->
                <div class="auth-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z"
                            fill="#d93025" />
                    </svg>
                </div>
                <h1 class="auth-title">{{ __('Vérification en deux étapes') }}</h1>
                <p class="auth-subtitle">
                    {{ __('Entrez le code à 6 chiffres de votre application d\'authentification') }}
                </p>
            </div>

            <form method="POST" action="{{ route('admin.2fa.verify') }}" class="auth-form" id="otp-form">
                @csrf

                <!-- Hidden input for form submission -->
                <input type="hidden" id="code" name="code" value="">

                <!-- 2FA Code - 6 Digit Input -->
                <div class="form-group">
                    <div class="otp-input-container">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="0">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="1">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="2">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="3">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="4">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            autocomplete="off" data-index="5">
                    </div>
                    @error('code')
                        <span class="invalid-feedback" role="alert"
                            style="display: block; text-align: center; margin-top: 12px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                            </svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn-primary">
                        {{ __('Vérifier') }}
                    </button>
                </div>
            </form>

            <div class="auth-footer" style="text-align: center;">
                <a href="{{ route('admin.2fa.recovery') }}" class="recovery-link">
                    {{ __('Utiliser un code de récupération') }}
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('otp-form');
            const hiddenInput = document.getElementById('code');
            const otpInputs = document.querySelectorAll('.otp-input');

            // Focus first input on load
            otpInputs[0].focus();

            // Update hidden input with combined OTP value
            function updateHiddenInput() {
                const otp = Array.from(otpInputs).map(input => input.value).join('');
                hiddenInput.value = otp;

                // Auto-submit when all 6 digits are entered
                if (otp.length === 6) {
                    form.submit();
                }
            }

            otpInputs.forEach((input, index) => {
                // Handle input
                input.addEventListener('input', function (e) {
                    const value = this.value;

                    // Only allow numbers
                    if (!/^\d*$/.test(value)) {
                        this.value = '';
                        return;
                    }

                    // Move to next input if digit entered
                    if (value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    updateHiddenInput();
                });

                // Handle backspace
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                // Handle paste
                input.addEventListener('paste', function (e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');

                    if (pastedData.length === 6) {
                        // Fill all inputs with pasted data
                        pastedData.split('').forEach((char, i) => {
                            if (otpInputs[i]) {
                                otpInputs[i].value = char;
                            }
                        });
                        otpInputs[5].focus();
                        updateHiddenInput();
                    }
                });

                // Select content on focus
                input.addEventListener('focus', function () {
                    this.select();
                });
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('app.recovery_code') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>

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

        /* Recovery specific styles */
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

        .recovery-input {
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 18px;
            letter-spacing: 2px;
            width: 100%;
            padding: 12px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            background: #fff;
            color: #202124;
            margin-top: 8px;
            transition: all 0.2s;
        }

        .recovery-input:focus {
            border-color: #d93025;
            outline: none;
            box-shadow: 0 0 0 2px rgba(217, 48, 37, 0.1);
        }

        .info-box {
            background: #fce8e6;
            border-left: 4px solid #d93025;
            padding: 12px 16px;
            margin: 16px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #3c4043;
            text-align: left;
        }

        .back-link {
            display: inline-block;
            margin-top: 16px;
            font-size: 14px;
            color: #d93025;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #b31412;
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
                            d="M12.65 10C11.7 7.31 8.9 5.5 5.77 6.12C3.48 6.58 1.62 8.41 1.14 10.7C0.32 14.57 3.26 18 7 18C9.61 18 11.83 16.33 12.65 14H16V18H20V14H22V10H12.65ZM7 14C5.9 14 5 13.1 5 12C5 10.9 5.9 10 7 10C8.1 10 9 10.9 9 12C9 13.1 8.1 14 7 14Z"
                            fill="#d93025" />
                    </svg>
                </div>
                <h1 class="auth-title">{{ __('app.recovery_code') }}</h1>
                <p class="auth-subtitle">
                    {{ __('app.enter_recovery_code') }}
                </p>
            </div>

            <div class="info-box">
                <strong>{{ __('app.Note :') }}</strong>
                {{ __('app.recovery_code_info') }}
            </div>

            <form method="POST" action="{{ route('admin.2fa.verify') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="recovery_code" class="form-label"
                        style="display: block; text-align: left; margin-bottom: 8px; color: #5f6368; font-size: 14px;">{{ __('app.recovery_code') }}</label>
                    <input id="recovery_code" type="text"
                        class="recovery-input @error('recovery_code') is-invalid @enderror @error('code') is-invalid @enderror"
                        name="recovery_code" required autofocus placeholder=" " maxlength="12" autocomplete="off">

                    @error('recovery_code')
                        <span class="invalid-feedback" role="alert"
                            style="display: block; text-align: left; margin-top: 8px; color: #d93025; font-size: 12px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('code')
                        <span class="invalid-feedback" role="alert"
                            style="display: block; text-align: left; margin-top: 8px; color: #d93025; font-size: 12px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn-primary">
                        {{ __('app.verify') }}
                    </button>
                </div>
            </form>

            <div class="auth-footer" style="text-align: center;">
                <a href="{{ route('admin.2fa.challenge') }}" class="back-link">
                    ← {{ __('app.back_to_otp') }}
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const recoveryInput = document.getElementById('recovery_code');

            if (recoveryInput) {
                // Remove spaces only (keep lowercase as codes are stored in lowercase)
                recoveryInput.addEventListener('input', function (e) {
                    this.value = this.value.toLowerCase().replace(/\s/g, '');
                });
            }
        });
    </script>
</body>

</html>

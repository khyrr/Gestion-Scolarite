<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Connexion') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/auth-google.css') }}" rel="stylesheet">

    <style>
        /* Spinner Styles */
        .spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* NProgress Custom Color */
        #nprogress .bar {
            background: #1a73e8 !important;
            height: 3px !important;
        }

        #nprogress .peg {
            box-shadow: 0 0 10px #1a73e8, 0 0 5px #1a73e8 !important;
        }

        #nprogress .spinner-icon {
            border-top-color: #1a73e8 !important;
            border-left-color: #1a73e8 !important;
        }
    </style>

    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <!-- Logo -->
                <div class="auth-logo-container">
                    <svg class="auth-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z"
                            fill="#1a73e8" />
                        <path d="M11 7H13V13H11V7ZM11 15H13V17H11V15Z" fill="#1a73e8" />
                    </svg>
                </div>
                <h1 class="auth-title">{{ __('Connexion') }}</h1>
                <p class="auth-subtitle">{{ __('Accédez à votre espace de gestion scolaire') }}</p>
            </div>

            <form method="POST" action="{{ route('enseignant.connexion') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" ">
                    <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                            </svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder=" ">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                            </svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-group"
                    style="display: flex; justify-content: space-between; align-items: center; font-size: 14px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                        <label class="form-check-label" for="remember"
                            style="cursor: pointer; color: var(--text-secondary);">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}" style="font-size: 14px;">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <button type="submit" class="btn-primary">
                        {{ __('Se connecter') }}
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                @if (Route::has('enseignant.inscription') || Route::has('register'))
                    <a href="{{ route('enseignant.inscription') }}" class="auth-link">
                        {{ __('Créer un compte') }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            NProgress.configure({ showSpinner: false });

            const form = document.querySelector('.auth-form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    const btn = this.querySelector('button[type="submit"]');
                    if (btn && !btn.disabled) {
                        btn.disabled = true;
                        const originalText = btn.innerText;
                        btn.innerHTML = '<span class="spinner"></span> ' + 'Connexion...'; // Or keep original text
                        NProgress.start();
                    }
                });
            }

            // Handle back/forward cache
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    const btn = document.querySelector('button[type="submit"]');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = '{{ __('Se connecter') }}';
                    }
                    NProgress.done();
                }
            });
        });
    </script>
</body>

</html>
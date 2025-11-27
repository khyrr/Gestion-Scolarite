<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Administration') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/auth-google.css') }}" rel="stylesheet">
    
    <style>
        /* Admin specific overrides */
        .auth-logo path {
            fill: #d93025; /* Google Red for Admin */
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
        .form-control:focus + .form-label {
            color: #d93025;
        }
        .auth-link {
            color: #d93025;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <!-- Logo -->
                <div class="auth-logo-container">
                    <svg class="auth-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z" fill="#d93025"/>
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="#d93025"/>
                    </svg>
                </div>
                <h1 class="auth-title">{{ __('Administration') }}</h1>
                <p class="auth-subtitle">{{ __('Accès sécurisé à l\'espace administrateur') }}</p>
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" ">
                    <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder=" ">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; font-size: 14px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                        <label class="form-check-label" for="remember" style="cursor: pointer; color: var(--text-secondary);">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <button type="submit" class="btn-primary">
                        {{ __('Connexion Admin') }}
                    </button>
                </div>
            </form>
            
            <div class="auth-footer">
                <a href="{{ route('enseignant.connexion') }}" class="auth-link" style="font-size: 14px; color: #5f6368;">
                    {{ __('Retour à l\'espace enseignant') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Inscription') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/auth-google.css') }}" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <!-- Logo -->
                <div class="auth-logo-container">
                    <svg class="auth-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z" fill="#1a73e8"/>
                        <path d="M11 7H13V13H11V7ZM11 15H13V17H11V15Z" fill="#1a73e8"/>
                    </svg>
                </div>
                <h1 class="auth-title">{{ __('Créer un compte') }}</h1>
                <p class="auth-subtitle">{{ __('Accédez à votre espace de gestion scolaire') }}</p>
            </div>

            <form method="POST" action="{{ route('enseignant.inscription') }}" class="auth-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder=" ">
                    <label for="name" class="form-label">{{ __('Nom complet') }}</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ">
                    <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Telephone -->
                <div class="form-group">
                    <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="tel" placeholder=" ">
                    <label for="telephone" class="form-label">{{ __('Téléphone') }}</label>
                    @error('telephone')
                        <span class="invalid-feedback" role="alert">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password & Confirm -->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder=" ">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" ">
                            <label for="password-confirm" class="form-label">{{ __('Confirmer') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <button type="submit" class="btn-primary">
                        {{ __('S\'inscrire') }}
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                <a href="{{ route('enseignant.connexion') }}" class="auth-link">
                    {{ __('Déjà inscrit ? Se connecter') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Vérification Email') }} - {{ config('app.name', 'Gestion Scolaire') }}</title>
    
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
                <h1 class="auth-title">{{ __('Vérifiez votre adresse email') }}</h1>
                <p class="auth-subtitle">{{ __('Avant de continuer, veuillez vérifier votre email pour un lien de vérification.') }}</p>
            </div>

            <div class="auth-form">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert" style="color: var(--success-color); background-color: #e6f4ea; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 1rem; text-align: center;">
                        {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                    </div>
                @endif

                <p style="font-size: 14px; color: var(--text-secondary); text-align: center; margin-bottom: 1.5rem;">
                    {{ __('Si vous n\'avez pas reçu l\'email') }},
                </p>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn-primary">
                        {{ __('Cliquez ici pour en demander un autre') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

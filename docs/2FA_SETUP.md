# Authentification à Deux Facteurs (2FA) - Guide d'Installation

## ✅ Installation Complète

Toute l'implémentation est déjà en place. Voici les étapes finales :

### 1. Enregistrer Fortify Service Provider

Ajoutez dans `bootstrap/providers.php` ou `config/app.php` (selon Laravel 11) :

```php
return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class, // ← Ajoutez ceci
];
```

### 2. Configurer Fortify

Dans `config/fortify.php`, activez la 2FA :

```php
'features' => [
    Features::registration(),
    Features::resetPasswords(),
    // Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication([  // ← Activez ceci
        'confirm' => true,
        'confirmPassword' => true,
    ]),
],
```

### 3. Appliquer le Middleware au Panel Filament

Dans `app/Providers/Filament/AdminPanelProvider.php` :

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        // ... autres configurations
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
            \App\Http\Middleware\EnsureTwoFactorIsVerified::class, // ← Ajoutez ceci
        ])
        ->authMiddleware([
            Authenticate::class,
        ]);
}
```

### 4. Exécuter les Migrations

```bash
php artisan migrate
```

Cela ajoutera les colonnes nécessaires à la table `users` :
- `two_factor_secret`
- `two_factor_recovery_codes`
- `two_factor_confirmed_at`

### 5. Configuration Environnement

Ajoutez dans votre `.env` :

```env
# Sécurité 2FA
SECURITY_REQUIRE_2FA=false  # true pour forcer tous les utilisateurs
SECURITY_RECONFIRM_MINUTES=30  # Minutes avant reconfirmation
SECURITY_CHALLENGE_TIMEOUT=15
SECURITY_MAX_FAILED_ATTEMPTS=5
SECURITY_RATE_LIMIT_DECAY=1
```

## 🎯 Utilisation

### Pour activer 2FA (utilisateur)

1. Connectez-vous à Filament
2. Allez dans **Sécurité > Configuration 2FA**
3. Cliquez sur **"Activer la 2FA"**
4. Scannez le QR code avec Google Authenticator / Authy
5. Entrez le code à 6 chiffres pour confirmer
6. Sauvegardez vos codes de récupération !

### Pour forcer la 2FA (tous les utilisateurs)

Dans `.env` :
```env
SECURITY_REQUIRE_2FA=true
```

Les utilisateurs sans 2FA seront automatiquement redirigés vers la page de configuration.

### Pages Filament disponibles

1. **Configuration 2FA** : `/admin/two-factor-setup`
2. **Codes de Récupération** : `/admin/two-factor-recovery-codes`
3. **Challenge 2FA** : `/admin/two-factor-challenge` (automatique)

## 🛡️ Fonctionnalités Sécurité

### ✅ Implémenté

- ✅ TOTP (Time-based One-Time Password)
- ✅ QR Code SVG pour scan
- ✅ Codes de récupération (8 codes par défaut)
- ✅ Rate limiting (5 tentatives max par défaut)
- ✅ Confirmation mot de passe avant actions sensibles
- ✅ Session reconfirmation (30 min par défaut)
- ✅ Chiffrement des secrets (via Fortify)
- ✅ Téléchargement des codes de récupération
- ✅ Régénération des codes
- ✅ Désactivation sécurisée

### 🔐 Architecture

```
app/
├── Services/
│   ├── TwoFactorService.php          # Logique métier 2FA
│   └── SecurityPolicyService.php     # Politiques de sécurité
├── Http/Middleware/
│   └── EnsureTwoFactorIsVerified.php # Middleware protection
└── Filament/Pages/
    ├── TwoFactorSetup.php            # Page activation
    ├── TwoFactorRecoveryCodes.php    # Page codes récup
    └── TwoFactorChallenge.php        # Page challenge

config/
└── security.php                       # Configuration custom

resources/
├── lang/fr/app.php                    # Traductions FR
└── views/filament/pages/
    ├── two-factor-setup.blade.php
    ├── two-factor-recovery-codes.blade.php
    └── two-factor-challenge.blade.php
```

## 📊 Configuration Avancée

### Personnaliser le nombre de codes de récupération

Dans `config/security.php` :
```php
'recovery_codes_count' => 10, // Par défaut : 8
```

### Forcer reconfirmation immédiate

```php
'reconfirm_minutes' => 0, // Toujours demander
```

### Augmenter le rate limiting

```php
'max_failed_attempts' => 10,
'rate_limit_decay' => 5, // 5 minutes
```

## 🧪 Tests

### Test manuel

1. Créez un compte admin
2. Activez la 2FA
3. Déconnectez-vous
4. Reconnectez-vous → challenge 2FA
5. Testez avec un mauvais code (rate limiting)
6. Testez avec un code de récupération
7. Régénérez les codes
8. Désactivez la 2FA

### Test avec 2FA forcée

```bash
# .env
SECURITY_REQUIRE_2FA=true
```

Créez un nouvel admin → sera redirigé vers setup

## 🚨 Troubleshooting

### "Call to undefined method qrCodeSvg"

Vérifiez que `pragmarx/google2fa` est installé :
```bash
composer require pragmarx/google2fa
```

### Migrations déjà exécutées

Les migrations Fortify sont déjà publiées. Si erreur :
```bash
php artisan migrate:status
php artisan migrate
```

### QR Code ne s'affiche pas

Vérifiez que le secret est bien généré :
```php
dd(auth()->user()->two_factor_secret);
```

## 📚 Dépendances

- `laravel/fortify` : ^1.21
- `pragmarx/google2fa` : ^8.0

Tout est déjà installé ✅

## 🎉 Prêt pour Production

Cette implémentation est **production-ready** avec :
- ✅ Rate limiting
- ✅ Secrets chiffrés
- ✅ Session management
- ✅ Recovery codes
- ✅ Password confirmation
- ✅ Traductions FR complètes

## 📖 Ressources

- [Documentation Laravel Fortify](https://laravel.com/docs/fortify)
- [Google2FA GitHub](https://github.com/antonioribeiro/google2fa)
- [Filament Pages](https://filamentphp.com/docs/panels/pages)

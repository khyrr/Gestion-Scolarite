# Système de Sécurité et Authentification - Guide Complet

## Vue d'Ensemble

Ce document couvre l'ensemble du système de sécurité incluant :
- ✅ Authentification à Deux Facteurs (2FA)
- ✅ Protection contre les Attaques par Force Brute
- ✅ Verrouillage de Compte Persistant
- ✅ Journalisation des Tentatives de Connexion
- ✅ Politiques de Sécurité Configurables

---

## 🔐 Authentification à Deux Facteurs (2FA)

### Installation Complète

Toute l'implémentation est déjà en place. Voici les étapes finales :

#### 1. Enregistrer Fortify Service Provider

Ajoutez dans `bootstrap/providers.php` ou `config/app.php` (selon Laravel 11) :

```php
return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class, // ← Ajoutez ceci
];
```

#### 2. Configurer Fortify

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

#### 3. Appliquer le Middleware au Panel Filament

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

### Utilisation 2FA

#### Pour activer 2FA (utilisateur)

1. Connectez-vous à Filament
2. Allez dans **Sécurité > Configuration 2FA**
3. Cliquez sur **"Activer la 2FA"**
4. Scannez le QR code avec Google Authenticator / Authy
5. Entrez le code à 6 chiffres pour confirmer
6. Sauvegardez vos codes de récupération !

#### Pour forcer la 2FA (tous les utilisateurs)

Dans les **Paramètres Sécurité** du panel admin :
- Activez "Require Two-Factor Authentication"

Ou dans la base de données :
```sql
UPDATE settings SET value = 1 WHERE key = 'security.two_factor_required';
```

---

## 🛡️ Protection contre les Attaques par Force Brute

### Architecture de Verrouillage de Compte

Le système utilise un **verrouillage de compte basé sur la base de données** pour une protection robuste et persistante.

#### Champs de Base de Données (table `users`)

```php
locked_until              // Timestamp d'expiration du verrouillage
failed_login_attempts     // Compteur d'échecs (0-5)
last_failed_login_at      // Dernière tentative échouée
```

### Flux de Connexion avec Protection

```
┌─────────────────────────────────────────────┐
│  1. Utilisateur entre email/mot de passe   │
└──────────────────┬──────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────┐
│  2. Vérifier si compte verrouillé ?         │
│     (locked_until > now())                  │
└──────────────────┬──────────────────────────┘
                   │
        ┌──────────┴──────────┐
        │ OUI                 │ NON
        ▼                     ▼
┌────────────────┐    ┌────────────────────────┐
│ BLOQUER        │    │ 3. Tenter authentif.   │
│ ❌ Afficher    │    └──────┬─────────────────┘
│ durée restante │           │
└────────────────┘    ┌──────┴──────┐
                      │ Succès      │ Échec
                      ▼             ▼
              ┌─────────────┐  ┌──────────────────┐
              │ ✅ Connexion │  │ Incrémenter      │
              │ Réinitialiser│  │ failed_attempts  │
              │ compteur     │  │ +1               │
              └─────────────┘  └────┬─────────────┘
                                    │
                              ┌─────┴──────┐
                              │ ≥ 5 échecs?│
                              └─────┬──────┘
                            ┌───────┴────────┐
                            │ OUI            │ NON
                            ▼                ▼
                  ┌──────────────────┐  ┌────────────┐
                  │ 🚨 VERROUILLER   │  │ Continuer  │
                  │ locked_until =   │  └────────────┘
                  │ now() + 15 min   │
                  │ Log: BRUTE FORCE │
                  └──────────────────┘
```

### Configuration des Paramètres

#### Via Interface Admin

1. Allez dans **Paramètres > Sécurité**
2. Section "Account Security" :
   - **Maximum Login Attempts** : 3-10 (défaut: 5)
   - **Account Lockout Duration** : 1-1440 minutes (défaut: 15)

#### Via Base de Données

```sql
-- Nombre max de tentatives
UPDATE settings SET value = '5' WHERE key = 'security.max_login_attempts';

-- Durée de verrouillage (en minutes)
UPDATE settings SET value = '15' WHERE key = 'security.lockout_duration';
```

### Journalisation de Sécurité

Tous les événements de connexion sont enregistrés dans **Activity Log** avec le log name `security` :

#### Types d'Événements

| Event Type | Description | Propriétés Enregistrées |
|-----------|-------------|------------------------|
| `login_success` | Connexion réussie | email, ip_address, user_agent |
| `login_failed` | Tentative échouée | email, ip, attempt_number, remaining_attempts |
| `brute_force_attack` | Compte verrouillé après 5 échecs | email, ip, lockout_duration, locked_until |
| `login_blocked_locked` | Tentative sur compte verrouillé | email, ip, remaining_minutes |
| `login_failed_unknown_user` | Tentative sur email inexistant | email, ip (sans révéler l'existence) |

#### Consulter les Logs de Sécurité

1. Allez dans **Système > Activity Logs**
2. Filtrez par **Log Name: security**
3. Recherchez :
   - `"BRUTE FORCE"` pour les attaques détectées
   - `"LOGIN BLOCKED"` pour les tentatives bloquées
   - `"Failed login attempt"` pour suivre les échecs

### Exemple de Scénario d'Attaque

```
Tentative 1: ❌ Mauvais mot de passe
  → Log: "Failed login attempt (Attempt 1 of 5)"
  → Propriétés: { remaining_attempts: 4 }

Tentative 2: ❌ Mauvais mot de passe
  → Log: "Failed login attempt (Attempt 2 of 5)"
  → Propriétés: { remaining_attempts: 3 }

Tentative 3: ❌ Mauvais mot de passe
  → Log: "Failed login attempt (Attempt 3 of 5)"
  → Propriétés: { remaining_attempts: 2 }

Tentative 4: ❌ Mauvais mot de passe
  → Log: "Failed login attempt (Attempt 4 of 5)"
  → Propriétés: { remaining_attempts: 1 }

Tentative 5: ❌ Mauvais mot de passe
  → Log: "Failed login attempt (Attempt 5 of 5)"
  → Log: "🚨 BRUTE FORCE ATTACK: Account locked until 2026-02-04 22:51:00"
  → locked_until = now() + 15 minutes
  → Notification: "Account Locked for 15 minutes"

Tentative 6-100: 🔒 BLOQUÉ
  → Log: "LOGIN BLOCKED: Account locked (14 minutes remaining)"
  → Notification: "Account locked, try again in 14 minutes"

Après 15 minutes: ✅ Déverrouillage automatique
  → locked_until < now()
  → failed_login_attempts réinitialisé
```

### Déblocage Manuel d'un Compte

#### Via Base de Données

```sql
-- Débloquer un utilisateur spécifique
UPDATE users 
SET locked_until = NULL, 
    failed_login_attempts = 0,
    last_failed_login_at = NULL
WHERE email = 'user@example.com';
```

#### Via Tinker (recommandé)

```bash
php artisan tinker
```

```php
// Débloquer par email
$user = User::where('email', 'user@example.com')->first();
$user->update([
    'locked_until' => null,
    'failed_login_attempts' => 0,
    'last_failed_login_at' => null,
]);

// Débloquer tous les comptes verrouillés
User::whereNotNull('locked_until')->update([
    'locked_until' => null,
    'failed_login_attempts' => 0,
]);
```

---

## 📊 Audit et Monitoring

### Requêtes Utiles pour Monitoring

#### Comptes Actuellement Verrouillés

```sql
SELECT id, name, email, locked_until, failed_login_attempts
FROM users
WHERE locked_until > NOW()
ORDER BY locked_until DESC;
```

#### Historique des Attaques (dernières 24h)

```sql
SELECT properties->>'$.email' as email,
       properties->>'$.ip_address' as ip,
       description,
       created_at
FROM activity_log
WHERE log_name = 'security'
  AND description LIKE '%BRUTE FORCE%'
  AND created_at >= NOW() - INTERVAL 24 HOUR
ORDER BY created_at DESC;
```

#### Top IPs avec Tentatives Échouées

```sql
SELECT properties->>'$.ip_address' as ip_address,
       COUNT(*) as failed_attempts,
       MAX(created_at) as last_attempt
FROM activity_log
WHERE log_name = 'security'
  AND properties->>'$.event_type' = 'login_failed'
  AND created_at >= NOW() - INTERVAL 7 DAY
GROUP BY properties->>'$.ip_address'
HAVING failed_attempts > 10
ORDER BY failed_attempts DESC;
```

---

## ⚙️ Configuration Environnement

### Variables d'Environnement

```env
# Sécurité 2FA
SECURITY_REQUIRE_2FA=false           # true pour forcer tous les utilisateurs
SECURITY_RECONFIRM_MINUTES=30        # Minutes avant reconfirmation
SECURITY_CHALLENGE_TIMEOUT=15        # Timeout challenge 2FA
SECURITY_MAX_FAILED_ATTEMPTS=5       # (Legacy - utilise maintenant la BDD)
SECURITY_RATE_LIMIT_DECAY=1          # (Legacy - utilise maintenant la BDD)

# Base de Données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_scolarite
DB_USERNAME=root
DB_PASSWORD=
```

### Paramètres de Sécurité (Base de Données)

| Clé | Valeur par Défaut | Description |
|-----|------------------|-------------|
| `security.max_login_attempts` | 5 | Tentatives max avant verrouillage |
| `security.lockout_duration` | 15 | Durée verrouillage (minutes) |
| `security.two_factor_required` | false | 2FA obligatoire |
| `security.session_timeout` | 120 | Timeout session (minutes) |
| `security.password_min_length` | 8 | Longueur min mot de passe |
| `security.password_require_uppercase` | true | Exiger majuscules |
| `security.password_require_lowercase` | true | Exiger minuscules |
| `security.password_require_numbers` | true | Exiger chiffres |
| `security.password_require_symbols` | false | Exiger symboles |
| `security.password_expiry_days` | 0 | Expiration mot de passe (0=jamais) |
| `security.force_https` | false | Forcer HTTPS |

---

## 🔧 Migrations

### Exécuter les Migrations

```bash
# Migration 2FA (Fortify)
php artisan migrate

# Migration Verrouillage de Compte
php artisan migrate --path=/database/migrations/2026_02_04_221728_add_lockout_fields_to_users_table.php
```

### Structure de la Table Users

```php
// Colonnes 2FA (via Fortify)
two_factor_secret          // Secret TOTP chiffré
two_factor_recovery_codes  // Codes de récupération chiffrés
two_factor_confirmed_at    // Date confirmation 2FA
two_factor_enabled         // Boolean activation

// Colonnes Verrouillage
locked_until               // Timestamp expiration verrouillage
failed_login_attempts      // Compteur d'échecs (0-5)
last_failed_login_at       // Dernière tentative échouée
last_login_at              // Dernière connexion réussie
```

---

## 🛠️ Architecture du Code

### Fichiers Clés

```
app/
├── Filament/Pages/
│   ├── Auth/
│   │   └── Login.php                      # ⭐ Logique verrouillage + audit
│   ├── TwoFactorSetup.php                 # Page activation 2FA
│   ├── TwoFactorRecoveryCodes.php         # Codes récupération
│   └── TwoFactorChallenge.php             # Challenge 2FA
│
├── Services/
│   ├── TwoFactorService.php               # Logique métier 2FA
│   ├── SecurityPolicyService.php          # Politiques de sécurité
│   └── SettingsService.php                # Gestion paramètres
│
├── Http/Middleware/
│   └── EnsureTwoFactorIsVerified.php      # Middleware protection 2FA
│
├── Providers/
│   └── FortifyServiceProvider.php         # Configuration Fortify
│
└── Models/
    └── User.php                            # ⭐ Champs lockout

database/migrations/
└── 2026_02_04_221728_add_lockout_fields_to_users_table.php  # Migration lockout

config/
├── fortify.php                             # Config 2FA
└── security.php                            # Config custom sécurité
```

### Logique du Fichier Login.php

```php
// 1. Vérifier verrouillage (BDD)
if ($user->locked_until && $user->locked_until->isFuture()) {
    // BLOQUER + Log
    return null;
}

// 2. Tenter authentification
try {
    $response = parent::authenticate();
    
    // SUCCÈS: Réinitialiser compteur
    $user->update([
        'failed_login_attempts' => 0,
        'locked_until' => null,
    ]);
    
} catch (ValidationException $e) {
    // ÉCHEC: Incrémenter compteur
    $user->increment('failed_login_attempts');
    
    // Si >= max_attempts: VERROUILLER
    if ($user->failed_login_attempts >= $maxAttempts) {
        $user->update([
            'locked_until' => now()->addMinutes($lockoutDuration),
        ]);
        // Log: BRUTE FORCE ATTACK
    }
}
```

---

## ✅ Fonctionnalités Implémentées

### 2FA (Authentification à Deux Facteurs)

- ✅ TOTP (Time-based One-Time Password)
- ✅ QR Code SVG pour scan
- ✅ Codes de récupération (8 codes)
- ✅ Challenge automatique lors de connexion
- ✅ Middleware protection routes
- ✅ Option 2FA obligatoire

### Protection contre Force Brute

- ✅ Verrouillage de compte basé sur la base de données
- ✅ Compteur de tentatives persistant
- ✅ Durée de verrouillage configurable (1-1440 minutes)
- ✅ Déverrouillage automatique après expiration
- ✅ Journalisation complète des événements
- ✅ Détection d'attaques en temps réel
- ✅ Protection IP + User Agent

### Audit et Journalisation

- ✅ Activity Log intégré (Spatie)
- ✅ Canal de log dédié "security" (90 jours)
- ✅ Tracking IP, User Agent, Timestamp
- ✅ Événements : success, failed, brute force, blocked
- ✅ Interface admin pour consulter les logs
- ✅ Filtres par type d'événement

### Politiques de Sécurité

- ✅ Longueur minimale mot de passe
- ✅ Complexité (majuscules, minuscules, chiffres, symboles)
- ✅ Expiration mot de passe optionnelle
- ✅ Session timeout configurable
- ✅ Force HTTPS optionnel

---

## 📋 Checklist de Déploiement

### Prérequis

- [ ] Laravel 11+
- [ ] PHP 8.3+
- [ ] MySQL/MariaDB
- [ ] Spatie Laravel Permission
- [ ] Spatie Laravel Activity Log
- [ ] Filament 3.2+

### Installation

- [ ] Exécuter `composer install`
- [ ] Configurer `.env` (DB, APP_KEY, etc.)
- [ ] Exécuter `php artisan migrate`
- [ ] Enregistrer `FortifyServiceProvider`
- [ ] Appliquer middleware 2FA à Filament
- [ ] Configurer paramètres sécurité via admin

### Configuration Sécurité

- [ ] Définir `max_login_attempts` (défaut: 5)
- [ ] Définir `lockout_duration` (défaut: 15 minutes)
- [ ] Activer/Désactiver 2FA obligatoire
- [ ] Configurer politiques mot de passe
- [ ] Configurer session timeout

### Vérification

- [ ] Tester connexion normale
- [ ] Tester 5 échecs → verrouillage
- [ ] Vérifier notification "Account Locked for X minutes"
- [ ] Consulter Activity Logs → Voir événement "BRUTE FORCE"
- [ ] Attendre expiration → Vérifier déverrouillage auto
- [ ] Tester 2FA activation/challenge
- [ ] Tester codes de récupération

---

## 🔍 Dépannage

### Compte Bloqué Indéfiniment

**Symptôme** : `locked_until` ne se débloque pas automatiquement

**Solution** :
```bash
php artisan tinker
$user = User::where('email', 'user@example.com')->first();
$user->update(['locked_until' => null, 'failed_login_attempts' => 0]);
```

### Logs de Sécurité Non Visibles

**Symptôme** : Activity Logs vide malgré tentatives

**Vérifications** :
1. Vérifier `config/logging.php` → Canal `security` existe
2. Vérifier `storage/logs/security-*.log` → Fichiers créés
3. Vérifier `activity_log` table → Log name = `security`
4. Vérifier permissions `storage/logs` → Writable

### 2FA Ne Fonctionne Pas

**Symptôme** : QR code non affiché ou challenge non déclenché

**Vérifications** :
1. Vérifier `FortifyServiceProvider` enregistré
2. Vérifier middleware `EnsureTwoFactorIsVerified` appliqué
3. Exécuter `php artisan route:list | grep two-factor`
4. Vérifier colonnes `two_factor_*` existent dans `users`

### Verrouillage Trop Court/Long

**Symptôme** : Compte se déverrouille immédiatement ou jamais

**Solution** :
```sql
-- Vérifier valeur actuelle
SELECT value FROM settings WHERE key = 'security.lockout_duration';

-- Ajuster (15 minutes par défaut)
UPDATE settings SET value = '15' WHERE key = 'security.lockout_duration';
```

### Notifications Non Affichées

**Symptôme** : Pas de notification "Account Locked"

**Vérifications** :
1. Vérifier `Login.php` → `Notification::make()` présent
2. Vérifier `filament.notifications` config
3. Vérifier JavaScript console pour erreurs
4. Tester avec `@livewire('notifications')`

---

## 📚 Ressources

### Documentation Laravel/Filament

- [Laravel Fortify](https://laravel.com/docs/11.x/fortify)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- [Spatie Laravel Activity Log](https://spatie.be/docs/laravel-activitylog)
- [Filament Authentication](https://filamentphp.com/docs/3.x/panels/users)

### Fichiers Importants

| Fichier | Rôle |
|---------|------|
| `app/Filament/Pages/Auth/Login.php` | Logique verrouillage + audit |
| `app/Services/TwoFactorService.php` | Logique métier 2FA |
| `app/Services/SettingsService.php` | Gestion paramètres sécurité |
| `app/Http/Middleware/EnsureTwoFactorIsVerified.php` | Middleware 2FA |
| `config/fortify.php` | Configuration 2FA |
| `config/logging.php` | Canal security logs |

### SQL Utiles

```sql
-- Voir comptes verrouillés
SELECT email, locked_until, failed_login_attempts 
FROM users 
WHERE locked_until > NOW();

-- Voir attaques récentes (24h)
SELECT properties->>'$.email', description, created_at 
FROM activity_log 
WHERE log_name = 'security' 
  AND description LIKE '%BRUTE FORCE%' 
  AND created_at >= NOW() - INTERVAL 24 HOUR;

-- Top IPs malveillantes
SELECT properties->>'$.ip_address' as ip, COUNT(*) as attempts 
FROM activity_log 
WHERE log_name = 'security' 
  AND properties->>'$.event_type' = 'login_failed' 
GROUP BY properties->>'$.ip_address' 
HAVING attempts > 10 
ORDER BY attempts DESC;
```

---

## 🎓 Bonnes Pratiques

### Sécurité

1. **Ne jamais désactiver le verrouillage en production**
2. **Monitorer les Activity Logs quotidiennement**
3. **Configurer des alertes pour attaques détectées**
4. **Utiliser HTTPS en production** (`security.force_https = true`)
5. **Exiger 2FA pour les administrateurs**

### Performance

1. **Nettoyer les logs anciens** (>90 jours automatique)
2. **Indexer colonnes** `locked_until`, `failed_login_attempts`
3. **Utiliser cache pour paramètres** (déjà implémenté)

### Maintenance

1. **Backup base de données** (inclut users + activity_log)
2. **Vérifier logs storage/logs/security-*.log**
3. **Tester scénarios d'attaque périodiquement**
4. **Mettre à jour dépendances** (Fortify, Spatie, Filament)

---

## 📝 Notes de Version

### v2.0.0 (Février 2026) - Architecture Verrouillage BDD

**BREAKING CHANGES:**
- ✅ Migration de cache-based à database-based lockout
- ✅ Ajout colonnes `locked_until`, `failed_login_attempts`, `last_failed_login_at`
- ✅ Suppression `RateLimiter` pour lockout (garde seulement pour 2FA)
- ✅ Ajout Activity Log pour audit sécurité
- ✅ Nouvelle page Settings > Sécurité

**Migrations Requises:**
```bash
php artisan migrate --path=/database/migrations/2026_02_04_221728_add_lockout_fields_to_users_table.php
```

**Impacts:**
- Les comptes ne sont plus déverrouillés au redémarrage du serveur
- Les tentatives échouées persistent entre les redémarrages
- Journalisation complète de tous les événements
- Durée de verrouillage configurable dynamiquement (sans redémarrage)

### v1.0.0 (Initial) - 2FA Fortify

- ✅ Intégration Laravel Fortify
- ✅ Pages Filament 2FA (Setup, Challenge, Recovery)
- ✅ Middleware protection
- ✅ Rate limiting basique

---

**Dernière mise à jour** : 4 février 2026  
**Version système** : Laravel 11.48.0, PHP 8.3.6, Filament 3.2+  
**Auteur** : Système de Gestion Scolaire
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

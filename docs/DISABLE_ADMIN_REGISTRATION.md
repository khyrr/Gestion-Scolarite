# Walkthrough — Disable Admin Registration & Internal Management

This note documents the work to disable public admin registration and to replace it with an internal administration workflow (seeder, artisan command, dashboard UI and dynamic admin URL).

Summary
-------
We removed public admin self-registration and added a safer, internal workflow to create and manage administrator accounts. Changes include a migration + seeder update, a terminal command for creating admins, a protected dashboard UI for creating admins, and configuration for a dynamic admin URL prefix.

Goals
-----
- Prevent the public registration route from creating administrator accounts.
- Provide safe, auditable, internal tools for creating and managing admin accounts.
- Make the admin URL dynamic and rotatable for extra security.

Changes (high level)
--------------------
1. Database & Seeders
   - Updated `AdministrateursSeeder` to include a new `role` field to support role-based admin accounts.
   - Added a new migration that adds a `role` column to the `administrateurs` table.
   - Removed the redundant `AdminSeeder` and consolidated existing seed data in `AdministrateursSeeder`.

2. New CLI command
   - `php artisan admin:create`
     - An interactive artisan command that creates administrators from the terminal.
     - Prompts for email, name, password and role.
     - Writes the new administrator record to the `administrateurs` table.

   - `php artisan admin:rotate-prefix`
     - Rotates the admin URL prefix by generating a new one and updating configuration.
     - Updates `config/admin.php` and writes the new prefix to `.env` (or instructs admin to update .env manually depending on environment).

3. Admin Management UI
   - `AdminManagementController` — handles the dashboard views and submission to create admin accounts via the UI.
   - Views:
     - `resources/views/admin/admins/create-admin.blade.php` — admin creation form.
   - Routes (protected):
     - `/{{ config('admin.prefix') }}/admins` (list/manage)
     - `/{{ config('admin.prefix') }}/admins/create` (create form)
   - Sidebar: Added a "Gestion des Administrateurs" item to the admin sidebar with translation strings added to the French language file under `resources/lang/fr`.

4. Security and routing
   - Public route `/inscription` remains for creating normal `User` (teacher) accounts only — no Administrateur creation.
   - Introduced dynamic admin URL prefix (controlled by `ADMIN_PREFIX` in `.env` and `config/admin.php`), and all admin routes use this prefix.
   - Documented `php artisan admin:rotate-prefix` to change the admin URL safely.

How to use the new tools (commands)
----------------------------------
- Create an admin from the terminal

  php artisan admin:create

  Follow the prompts and the command will create the record and output success.

- Rotate / change admin URL prefix

  php artisan admin:rotate-prefix

  This will suggest or write a new prefix and show the updated route base (you may need to update deployment configs if required). The command documents the recommended next steps.

Developer / Migrating notes
---------------------------
1. Migration
   - New migration file added which adds `role` column to `administrateurs` table.
   - Run:

     php artisan migrate

2. Seeder
   - `AdministrateursSeeder` contains role data and is used by `php artisan db:seed --class=AdministrateursSeeder`.

3. Controller & Views
   - `AdminManagementController` contains the logic to validate and create administrators via the admin dashboard UI.
   - `resources/views/admin/admins/create-admin.blade.php` is the form page — protected by the admin guard and internal authorization middleware.

Testing / Verification
----------------------
Automated checks used during the change:
- php artisan db:seed --class=AdministrateursSeeder — verified it seeded as expected.
- php artisan admin:create — tested the interactive prompt and confirmed that records are persisted.

Manual verification steps performed:
- Verified `/inscription` still creates `User` (teacher) accounts and does not create `Administrateur` accounts.
- Verified `admin:create` creates valid records with role values.
- Verified admin routes are protected behind the admin-only middleware and use the dynamic `ADMIN_PREFIX`.

Config / environment
--------------------
- New `.env` key: `ADMIN_PREFIX` — change this to control the base admin path. Example:

  ADMIN_PREFIX=admin-secret-xyz

- `config/admin.php`:
  - Reads `env('ADMIN_PREFIX', 'admin')` to build route prefixes.
  - The `admin:rotate-prefix` command updates this value (or emits the new value for you to copy into `.env` depending on environment setup).

Rollout & Deployment notes
--------------------------
- Ensure you run migrations in production:
  php artisan migrate --force

- If your `ADMIN_PREFIX` is stored in a secrets manager or in platform environment variables, update it there and deploy — the rotation command only updates `.env` if the environment allows it.

- Add the new command to your deployment runbook for manual emergency admin creation when required.

Open items / next steps
-----------------------
- Add integration tests for admin:create to ensure expected DB shape and roles.
- Add tests to verify public /inscription cannot create Administrateur accounts.
- Consider logging or audit trails for admin:create and for any route changes applied through rotate-prefix.

Contact / Questions
-------------------
If you want this walkthrough copied into another place (README, CHANGELOG, deployment guide) or want a short release note entry generated, tell me where and I’ll add it in the repo.

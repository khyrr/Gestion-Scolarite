<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class MigrateRolesToSpatie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:migrate-to-spatie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate users.role column values to Spatie roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration of roles to Spatie...');
        
        // Get all users with a role
        $users = User::whereNotNull('role')->get();
        
        if ($users->isEmpty()) {
            $this->info('No users found with roles to migrate.');
            return 0;
        }
        
        $this->info("Found {$users->count()} users with roles.");
        
        $migratedCount = 0;
        $skippedCount = 0;
        
        foreach ($users as $user) {
            $roleName = $user->role;
            
            if (empty($roleName)) {
                continue;
            }
            
            // Create role if it doesn't exist
            $role = Role::firstOrCreate(['name' => $roleName]);
            
            // Check if user already has this role (via Spatie)
            if ($user->hasRole($roleName)) {
                $this->line("  - User #{$user->id} already has role '{$roleName}' (skipping)");
                $skippedCount++;
                continue;
            }
            
            // Assign the role
            $user->assignRole($roleName);
            $this->info("  ✓ User #{$user->id} ({$user->email}) assigned role '{$roleName}'");
            $migratedCount++;
        }
        
        $this->newLine();
        $this->info("Migration complete!");
        $this->info("  - Migrated: {$migratedCount}");
        $this->info("  - Skipped: {$skippedCount}");
        $this->newLine();
        $this->warn('Next step: Run the migration to drop the role column:');
        $this->comment('  php artisan migrate');
        
        return 0;
    }
}

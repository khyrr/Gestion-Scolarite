<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Student management
            'view students',
            'create students',
            'edit students',
            'delete students',
            
            // Teacher management
            'view teachers',
            'create teachers',
            'edit teachers',
            'delete teachers',
            
            // Class management
            'view classes',
            'create classes',
            'edit classes',
            'delete classes',
            
            // Course management
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            
            // Subject management
            'view subjects',
            'create subjects',
            'edit subjects',
            'delete subjects',
            
            // Evaluation management
            'view evaluations',
            'create evaluations',
            'edit evaluations',
            'delete evaluations',
            
            // Grade management
            'view grades',
            'create grades',
            'edit grades',
            'delete grades',
            
            // Payment management
            'view payments',
            'create payments',
            'edit payments',
            'delete payments',
            
            // Activity log
            'view activity logs',
            
            // Role & Permission management (super_admin only)
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - Full access including role management
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - All permissions except role management
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::whereNotIn('name', ['manage roles', 'manage permissions'])->get());

        // Teacher - Limited permissions
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $teacher->givePermissionTo([
            'view students',
            'view classes',
            'view courses',
            'view subjects',
            'view evaluations',
            'create evaluations',
            'edit evaluations',
            'view grades',
            'create grades',
            'edit grades',
        ]);

        // Student - View only
        $student = Role::firstOrCreate(['name' => 'student']);
        $student->givePermissionTo([
            'view grades',
            'view courses',
            'view evaluations',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}


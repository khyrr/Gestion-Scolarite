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

        // Create comprehensive permissions organized by resource
        $permissions = [
            // Student Management
            'view students',
            'create students', 
            'edit students',
            'delete students',
            'manage student accounts',
            'view student grades',
            'export student data',
            
            // Teacher Management
            'view teachers',
            'create teachers',
            'edit teachers', 
            'delete teachers',
            'manage teacher accounts',
            'assign teacher subjects',
            
            // Class Management
            'view classes',
            'create classes',
            'edit classes',
            'delete classes',
            'manage class assignments',
            
            // Subject Management
            'view subjects',
            'create subjects',
            'edit subjects',
            'delete subjects',
            
            // Course & Schedule Management
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            'manage timetables',
            
            // Evaluation Management
            'view evaluations',
            'create evaluations',
            'edit evaluations',
            'delete evaluations',
            'view all evaluations',
            
            // Grade Management
            'view grades',
            'create grades',
            'edit grades',
            'delete grades',
            'view all grades',
            'edit grade comments',
            
            // Payment & Financial Management
            'view payments',
            'create payments',
            'edit payments',
            'delete payments',
            'manage financial reports',
            
            // Reports & Analytics
            'view reports',
            'generate reports',
            'export data',
            'view statistics',
            
            // System Administration
            'manage users',
            'manage roles',
            'manage permissions',
            'view activity logs',
            'manage system settings',
            'backup database',
            'manage pages',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles with specific purposes and assign permissions
        
        // 1. SUPER ADMIN - Full system access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. ADMIN - Administrative management with system settings
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            // Student management
            'view students', 'create students', 'edit students', 'delete students',
            'manage student accounts', 'export student data',
            // Teacher management
            'view teachers', 'create teachers', 'edit teachers', 'delete teachers',
            'manage teacher accounts',
            // Academic management
            'view classes', 'create classes', 'edit classes', 'delete classes', 'manage class assignments',
            'view subjects', 'create subjects', 'edit subjects', 'delete subjects',
            'view courses', 'create courses', 'edit courses', 'delete courses',
            // System administration
            'manage users', 'manage roles', 'manage permissions', 'view activity logs', 'manage system settings',
            'manage pages',
            // Reports
            'view reports', 'generate reports', 'export data', 'view statistics',
        ]);

        // 3. DIRECTOR - Full academic management, no system administration  
        $director = Role::firstOrCreate(['name' => 'director']);
        $director->givePermissionTo([
            // Student management
            'view students', 'create students', 'edit students', 'delete students',
            'manage student accounts', 'view student grades', 'export student data',
            // Teacher management
            'view teachers', 'create teachers', 'edit teachers', 'delete teachers',
            'manage teacher accounts', 'assign teacher subjects',
            // Academic management
            'view classes', 'create classes', 'edit classes', 'delete classes', 'manage class assignments',
            'view subjects', 'create subjects', 'edit subjects', 'delete subjects',
            'view courses', 'create courses', 'edit courses', 'delete courses', 'manage timetables',
            // Evaluation & grades
            'view evaluations', 'create evaluations', 'edit evaluations', 'delete evaluations', 'view all evaluations',
            'view grades', 'create grades', 'edit grades', 'delete grades', 'view all grades', 'edit grade comments',
            // Reports
            'view reports', 'generate reports', 'export data', 'view statistics',
            // Payments
            'view payments', 'create payments', 'edit payments', 'delete payments', 'manage financial reports',
            // Activity monitoring
            'view activity logs',
        ]);

        // 4. ACADEMIC COORDINATOR - Academic content management
        $coordinator = Role::firstOrCreate(['name' => 'academic_coordinator']);
        $coordinator->givePermissionTo([
            // Academic structure
            'view classes', 'create classes', 'edit classes', 'manage class assignments',
            'view subjects', 'create subjects', 'edit subjects', 
            'view courses', 'create courses', 'edit courses', 'manage timetables',
            // Teachers (limited)
            'view teachers', 'assign teacher subjects',
            // Students (view and basic edit)
            'view students', 'edit students', 'view student grades',
            // Evaluations
            'view evaluations', 'create evaluations', 'edit evaluations', 'view all evaluations',
            'view grades', 'view all grades',
            // Reports
            'view reports', 'generate reports', 'view statistics',
        ]);

        // 5. TEACHER - Classroom management
        $teacher = Role::firstOrCreate(['name' => 'teacher']); 
        $teacher->givePermissionTo([
            // Students (their classes only)
            'view students', 'view student grades',
            // Classes (their classes only)
            'view classes', 'view courses',
            // Subjects
            'view subjects',
            // Evaluations (their subjects only)
            'view evaluations', 'create evaluations', 'edit evaluations',
            'view grades', 'create grades', 'edit grades', 'edit grade comments',
            // Basic reports
            'view reports',
        ]);

        // 6. SECRETARY - Administrative support
        $secretary = Role::firstOrCreate(['name' => 'secretary']);
        $secretary->givePermissionTo([
            // Students (basic management)
            'view students', 'create students', 'edit students',
            // Teachers (basic info)
            'view teachers', 'create teachers', 'edit teachers',
            // Classes
            'view classes', 'view courses',
            // Basic reports
            'view reports', 'export data',
            // Payments
            'view payments', 'create payments', 'edit payments',
        ]);

        // 7. ACCOUNTANT - Financial management
        $accountant = Role::firstOrCreate(['name' => 'accountant']);
        $accountant->givePermissionTo([
            // Students (for payment purposes)
            'view students',
            // Teachers (for salary purposes) 
            'view teachers',
            // Full payment management
            'view payments', 'create payments', 'edit payments', 'delete payments',
            'manage financial reports',
            // Financial reports
            'view reports', 'generate reports', 'export data', 'view statistics',
        ]);

        // 8. STUDENT - Self-service access
        $student = Role::firstOrCreate(['name' => 'student']);
        $student->givePermissionTo([
            'view student grades', // Their own grades only
            'view courses', // Their class courses
        ]);

        $this->command->info('✅ Enhanced role-based permission system created!');
        $this->command->info('📊 Roles: ' . Role::count());
        $this->command->info('🔐 Permissions: ' . Permission::count());
        
        // Display role summary
        $this->command->line('');
        $this->command->info('👥 ROLE SUMMARY:');
        foreach (Role::with('permissions')->get() as $role) {
            $this->command->info("   {$role->name}: {$role->permissions->count()} permissions");
        }
    }
}


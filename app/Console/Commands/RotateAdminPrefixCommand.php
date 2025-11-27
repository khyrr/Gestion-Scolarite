<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RotateAdminPrefixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:rotate-prefix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotate the admin URL prefix for security';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Rotating admin URL prefix...');

        // Generate a new random prefix
        $newPrefix = 'control-panel-' . Str::random(12);

        // Update .env file
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            if (strpos($envContent, 'ADMIN_PREFIX=') !== false) {
                // Update existing key
                $envContent = preg_replace(
                    '/^ADMIN_PREFIX=.*$/m',
                    'ADMIN_PREFIX=' . $newPrefix,
                    $envContent
                );
            } else {
                // Append new key
                $envContent .= "\nADMIN_PREFIX=" . $newPrefix;
            }

            File::put($envPath, $envContent);
        }

        // Clear caches
        $this->call('config:clear');
        $this->call('route:clear');

        $this->info('Admin prefix rotated successfully!');
        $this->info('New Admin URL: ' . url($newPrefix . '/login'));
        $this->warn('Make sure to update your bookmarks.');

        return 0;
    }
}

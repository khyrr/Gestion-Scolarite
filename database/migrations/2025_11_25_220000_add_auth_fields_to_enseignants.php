<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('enseignants')) {
            Schema::table('enseignants', function (Blueprint $table) {
                if (! Schema::hasColumn('enseignants', 'mot_de_passe')) {
                    $table->string('mot_de_passe')->nullable()->after('email');
                }
                if (! Schema::hasColumn('enseignants', 'remember_token')) {
                    $table->rememberToken();
                }
                if (! Schema::hasColumn('enseignants', 'email_verified_at')) {
                    $table->timestamp('email_verified_at')->nullable()->after('mot_de_passe');
                }
                if (! Schema::hasColumn('enseignants', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('remember_token');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('enseignants')) {
            Schema::table('enseignants', function (Blueprint $table) {
                foreach (['mot_de_passe', 'remember_token', 'email_verified_at', 'is_active'] as $col) {
                    if (Schema::hasColumn('enseignants', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('enseignant_matiere_classe', function (Blueprint $table) {
            // First truncate to avoid foreign key issues
            \DB::table('enseignant_matiere_classe')->truncate();
            
            // Add id_enseignant column
            $table->unsignedBigInteger('id_enseignant')->after('id');
            
            // Drop old foreign key and column if present
            if (Schema::hasColumn('enseignant_matiere_classe', 'user_id')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['user_id']);
                }
                $table->dropColumn('user_id');
            }
            
            // Add new foreign key
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('cascade');
            
            // Update unique constraint
            // Update unique constraint: drop and re-create if possible
            // Drop existing unique index if it exists (use Doctrine schema manager to check)
            // Only attempt to drop the existing unique index if it actually exists.
            // Using Doctrine's schema manager prevents SQLite/MySQL differences where trying
            // to drop a non-existent index raises an error during the schema operation.
            try {
                $connection = Schema::getConnection();
                $driver = $connection->getDriverName();

                // Don't attempt to drop unique indexes on sqlite — it often doesn't support the
                // same index names and attempting the drop raises "no such index" errors.
                if ($driver === 'sqlite') {
                    // skip index drop on sqlite
                } elseif (class_exists(\Doctrine\DBAL\Schema\Schema::class) || method_exists($connection, 'getDoctrineSchemaManager')) {
                    $schemaManager = $connection->getDoctrineSchemaManager();

                    // listTableDetails is tolerant and returns details for the table if present
                    $tableDetails = $schemaManager->listTableDetails('enseignant_matiere_classe');

                    if ($tableDetails->hasIndex('unique_enseignant_matiere_classe')) {
                        $table->dropUnique('unique_enseignant_matiere_classe');
                    }
                } else {
                    // As a fallback, only attempt the drop on non-sqlite drivers where the index
                    // is more likely to be present (best-effort safety net).
                    if ($driver !== 'sqlite') {
                        $table->dropUnique('unique_enseignant_matiere_classe');
                    }
                }
            } catch (\Throwable $e) {
                // If anything goes wrong during schema introspection, avoid failing the
                // migration. This migration is best-effort on index replacements.
            }

            $table->unique(['id_enseignant', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignant_matiere_classe', function (Blueprint $table) {
            // Drop new foreign key and column if present
            if (Schema::hasColumn('enseignant_matiere_classe', 'id_enseignant')) {
                if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                    $table->dropForeign(['id_enseignant']);
                }
                $table->dropColumn('id_enseignant');
            }
            
            // Add back user_id
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Restore unique constraint (best-effort)
            try {
                $connection = Schema::getConnection();
                $driver = $connection->getDriverName();

                if ($driver === 'sqlite') {
                    // skip index drop on sqlite when rolling back
                } elseif (class_exists(\Doctrine\DBAL\Schema\Schema::class) || method_exists($connection, 'getDoctrineSchemaManager')) {
                    $schemaManager = $connection->getDoctrineSchemaManager();
                    $tableDetails = $schemaManager->listTableDetails('enseignant_matiere_classe');

                    if ($tableDetails->hasIndex('unique_enseignant_matiere_classe')) {
                        $table->dropUnique('unique_enseignant_matiere_classe');
                    }
                } else {
                    if ($driver !== 'sqlite') {
                        $table->dropUnique('unique_enseignant_matiere_classe');
                    }
                }
            } catch (\Throwable $e) {
                // ignore problems with index removal when reverting the migration
            }

            $table->unique(['user_id', 'id_matiere', 'id_classe'], 'unique_enseignant_matiere_classe');
        });
    }
};

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
        // 1. Standard Laravel Notifications Table
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }

        // 2. Notification Preferences Table
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('key')->index(); // e.g., login_attempt, security_alert
            $table->string('channel'); // e.g., database, mail
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            // Unique constraint to prevent duplicate preferences for same key/channel/user
            $table->unique(['user_id', 'key', 'channel']);
        });

        // 3. Notification Logs Table
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('key')->index();
            $table->string('channel')->index();
            $table->string('status'); // sent, failed
            $table->json('payload')->nullable();
            $table->text('error')->nullable(); // Capture error message if failed
            $table->timestamps();
            
            // Index for querying logs by user/date
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('notification_preferences');
        Schema::dropIfExists('notifications');
    }
};

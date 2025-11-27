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
        Schema::create('admin_allowed_ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->unique(); // IPv6 support
            $table->string('label')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('added_by')->nullable()->constrained('administrateurs', 'id_administrateur')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_allowed_ips');
    }
};

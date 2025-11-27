<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->string('resource')->nullable();
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->text('description')->nullable();
            $table->json('changes')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};

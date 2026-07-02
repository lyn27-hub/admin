<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risk_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('severity')->default('Medium'); // Low, Medium, High
            $table->string('status')->default('Aktif'); // Aktif, Review, Resolved, Archived
            $table->string('alert_type')->nullable(); // bmi, sugar, calories, medical
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_alerts');
    }
};
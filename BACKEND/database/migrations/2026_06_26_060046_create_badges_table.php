<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // food_log, activity, streak, no_sugar, dll
            $table->string('icon')->nullable(); // emoji atau URL icon
            $table->text('description')->nullable();
            $table->string('condition_type'); // streak_days, food_log_count, weight_loss, dll
            $table->integer('condition_value')->default(1); // target angka kondisi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
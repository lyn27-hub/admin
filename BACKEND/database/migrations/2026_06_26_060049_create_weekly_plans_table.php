<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       if (!Schema::hasTable('weekly_plans')) {

            Schema::create('weekly_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('focus')->nullable();
            $table->text('activity_target')->nullable();
            $table->text('small_habit')->nullable();
            $table->text('menu_recommendation')->nullable();
            $table->timestamps();
        });
    }}

    public function down(): void
    {
        Schema::dropIfExists('weekly_plans');
    }
};
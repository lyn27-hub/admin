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
            $table->date('period_start');
            $table->date('period_end');
            $table->text('report_text')->nullable();
            $table->float('avg_calories')->default(0);
            $table->float('weight_change')->default(0);
            $table->string('frequent_food')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('expert_note')->nullable();
            $table->timestamps();
        });
    }}

    public function down(): void
    {
        Schema::dropIfExists('weekly_reports');
    }
};
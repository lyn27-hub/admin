<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('coaching_histories')) {

            Schema::create('coaching_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_id')->nullable()->constrained('coaching_templates')->onDelete('set null');
            $table->text('message'); // pesan coaching yang dikirim
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }}

    public function down(): void
    {
        Schema::dropIfExists('coaching_histories');
    }
};
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
        Schema::create('game_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('code', 8)->unique();
            $table->string('status')->default('waiting')->index();
            $table->unsignedTinyInteger('max_players')->default(8);
            $table->unsignedTinyInteger('rounds_total')->default(3);
            $table->unsignedSmallInteger('drawing_seconds')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_rooms');
    }
};

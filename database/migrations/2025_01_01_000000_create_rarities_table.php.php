<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rarities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // Common, Uncommon, Rare, Legendary
            $table->unsignedBigInteger('rank')->nullable(); // 1..4 (optioneel)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rarities');
    }
};

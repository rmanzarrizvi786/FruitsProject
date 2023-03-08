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
        Schema::create('nutrition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->constrained()->onDelete('cascade');
            $table->decimal('carbohydrates', 8,4);
            $table->decimal('protein', 8,4);
            $table->decimal('fat', 8,4);
            $table->decimal('calories', 8,4);
            $table->decimal('sugar', 8,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition');
    }
};

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
        Schema::create('brix_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cycle_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('brix_level', 5, 2);

            $table->timestamp('reading_at');

            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brix_readings');
    }
};

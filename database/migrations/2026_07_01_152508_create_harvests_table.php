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
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cycle_id')
                ->constrained('cycles')
                ->cascadeOnDelete();

            // Total harvested melons
            $table->unsignedInteger('harvest_count');

            // Date the harvest occurred
            $table->date('date_harvested');

            // Harvest status
            $table->enum('status', [
                'completed',
                'partial',
                'cancelled',
            ])->default('completed');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvests');
    }
};

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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->string('cycle_code')->unique();

            $table->string('crop_variety')->default('Muskmelon');

            $table->date('planting_date');

            $table->date('expected_harvest_date')->nullable();

            $table->date('actual_harvest_date')->nullable();

            $table->enum('status', [
                'planned',
                'ongoing',
                'ready_for_harvest',
                'harvested',
                'completed',
                'cancelled'
            ])->default('planned');

            $table->enum('growth_stage', [
                'seedling',
                'transplanting',
                'vegetative',
                'flowering',
                'pollination',
                'fruit_set',
                'fruit_development',
                'ripening'
            ])->nullable();

            $table->decimal('overall_progress', 5, 2)->default(0);

            $table->decimal('fruit_progress', 5, 2)->default(0);

            $table->decimal('current_brix', 5, 2)->nullable();

            $table->decimal('final_brix', 5, 2)->nullable();

            $table->decimal('yield_kg', 10, 2)->nullable();

            $table->decimal('yield_rate', 5, 2)->nullable();

            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};

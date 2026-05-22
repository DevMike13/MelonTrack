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
        Schema::create('sensor_datas', function (Blueprint $table) {
            $table->id();
            $table->integer('cycle_id');
            $table->decimal('ph_level', 4, 2);
            $table->decimal('dissolved_oxygen', 5, 2);
            $table->decimal('alkalinity_level', 6, 2);
            $table->decimal('water_temperature', 5, 2);
            $table->date('reading_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_datas');
    }
};

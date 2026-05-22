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
        Schema::create('daily_sensor_data', function (Blueprint $table) {
            $table->id();
            $table->integer('cycle_id');
            $table->text('board');
            $table->decimal('soil_moisture', 4, 2);
            $table->decimal('soil_ph', 5, 2);
            $table->decimal('water_ph', 6, 2);
            $table->decimal('temperature', 5, 2);
            $table->decimal('humidity', 5, 2);
            $table->timestamp('reading_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_sensor_data');
    }
};

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
        Schema::table('daily_sensor_data', function (Blueprint $table) {
            $table->integer('nitrogen')->nullable()->after('ph_level');
            $table->integer('phosphorus')->nullable()->after('nitrogen');
            $table->integer('potassium')->nullable()->after('phosphorus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_sensor_data', function (Blueprint $table) {
            $table->dropColumn([
                'nitrogen',
                'phosphorus',
                'potassium',
            ]);
        });
    }
};

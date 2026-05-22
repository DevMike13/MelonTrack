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
            $table->integer("cycle_no");
            $table->enum('microgreen_type', ['Broccoli', 'Cabbage', 'Chives', 'Carrot', 'Basil'])->default('Broccoli');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('trays')->nullable();
            $table->text('notes')->nullable();
            $table->enum('phase', ['germination', 'growth phase'])->default('germination');
            $table->enum('status', ['current', 'completed'])->default('current');
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

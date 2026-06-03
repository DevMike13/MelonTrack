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
        Schema::create('cycle_milestones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cycle_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->enum('type', [
                'greenhouse_transfer',
                'pruning',
                'pollination',
                'fruit_set',
                'harvest',
                'other'
            ]);

            $table->date('scheduled_date');

            $table->boolean('completed')->default(false);

            $table->date('completed_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_milestones');
    }
};

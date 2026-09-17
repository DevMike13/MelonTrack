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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cycle_id')
                ->constrained('cycles')
                ->cascadeOnDelete();

            $table->date('sale_date');

            $table->string('customer_name')->nullable();

            $table->decimal('quantity_kg', 10, 2);

            $table->decimal('price_per_kg', 10, 2);

            $table->decimal('total_amount', 12, 2);

            $table->enum('status', [
                'pending',
                'completed',
                'cancelled'
            ])->default('completed');

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

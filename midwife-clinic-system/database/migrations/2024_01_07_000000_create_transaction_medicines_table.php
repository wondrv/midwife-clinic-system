<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->string('medicine_name');
            $table->integer('quantity');
            $table->decimal('base_price', 12, 2);
            $table->decimal('selling_price', 12, 2);
            $table->decimal('profit', 12, 2);
            $table->decimal('total_price', 12, 2);
            $table->decimal('total_profit', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_medicines');
    }
};
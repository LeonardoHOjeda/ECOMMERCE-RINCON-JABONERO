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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('sku')->unique()->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('category_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

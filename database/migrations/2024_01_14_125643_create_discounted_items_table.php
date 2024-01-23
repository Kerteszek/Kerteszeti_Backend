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
        Schema::create('discounted_items', function (Blueprint $table) {
            $table->integer('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->integer('discount_id');
            $table->foreign('discount_id')->references('discount_id')->on('discounts');
            $table->primary(['product_id', 'discount_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounted_items');
    }
};

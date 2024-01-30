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
        Schema::create('basket_items', function (Blueprint $table) {
            $table->integer('basket');
            $table->foreign('basket')->references('basket_id')->on('baskets');
            $table->integer('product');
            $table->foreign('product')->references('product_id')->on('products');
            $table->integer('amount');
            $table->timestamps();
            $table->primary(['product', 'basket']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_items');
    }
};

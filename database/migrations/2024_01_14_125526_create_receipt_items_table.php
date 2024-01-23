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
        Schema::create('receipt_items', function (Blueprint $table) {
            $table->unsignedBigInteger('receipt_number')->startFrom(1000000);
            $table->foreign('receipt_number')->references('receipt_number')->on('receipts');

            $table->integer('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->integer('number_of_items');
            $table->timestamps();
            $table->primary(['receipt_number', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_items');
    }
};

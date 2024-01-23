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
        Schema::create('suppliances', function (Blueprint $table) {
            $table->integer('product');
            $table->dateTime('suppliance_date')->default(now());
            $table->integer('number_of_items');
            $table->integer('purchase_price');
            $table->timestamps();

            $table->foreign('product')->references('product_id')->on('products');
            $table->primary(['product', 'suppliance_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliances');
    }
};

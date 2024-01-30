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
        Schema::create('price_changes', function (Blueprint $table) {
            $table->integer('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->dateTime('change_date')->default(now());
            $table->integer('old_price');
            $table->timestamps();

            $table->primary(['product_id', 'change_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_changes');
    }
};

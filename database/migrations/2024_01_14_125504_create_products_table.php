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
            $table->integer('product_id')->unique();
            $table->integer('pot');
            $table->string('scientific_name', 40);
            $table->foreign('scientific_name')->references('scientific_name')->on('plants');
            $table->foreign('pot')->references('pot_id')->on('pots');

            $table->integer('price');
            $table->integer('in_stock');
            $table->timestamps();

            $table->primary('product_id');
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

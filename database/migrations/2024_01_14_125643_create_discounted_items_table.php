<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::table('discounted_items')->insert([
            ['product_id' => 1000, 'discount_id' => 600],
            ['product_id' => 1001, 'discount_id' => 600],
            ['product_id' => 1002, 'discount_id' => 602],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounted_items');
    }
};

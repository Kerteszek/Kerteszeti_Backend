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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_number');
            $table->foreign('purchase_number')->references('purchase_number')->on('purchases');

            $table->integer('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->integer('quantity');
            $table->timestamps();
            $table->primary(['purchase_number', 'product_id']);
        });

        DB::table('purchase_items')->insert([
            ['purchase_number' => 10000000, 'product_id' => 1006, 'quantity' => 5],
            ['purchase_number' => 10000000, 'product_id' => 1008, 'quantity' => 4],
            ['purchase_number' => 10000001, 'product_id' => 1006, 'quantity' => 21],

            //['buyer' => 3],
            //['buyer' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};

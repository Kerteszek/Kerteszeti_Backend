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
        Schema::create('purchase', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_number')->startFrom(1000000)->unique();
            $table->integer('buyer');
            $table->dateTime('shopping_date')->default(now());
            $table->integer('grand_total');
            $table->timestamps();
            $table->primary('purchase_number');
        });

        /*
        DB::table('products')->insert([
            ['buyer' => 1, 'shopping_date' => 2023-05-17],
            ['buyer' => 2, 'shopping_date' => 2024-01-05],
            ['buyer' => 2, 'shopping_date' => 2023-11-29],
            ['buyer' => 3, 'shopping_date' => 2023-07-06],
            ['buyer' => 2, 'shopping_date' => 2023-03-13],
            ['buyer' => 3],
            ['buyer' => 1],
        ]);
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

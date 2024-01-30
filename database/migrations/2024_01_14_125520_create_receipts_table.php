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
        Schema::create('receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('receipt_number')->startFrom(1000000)->unique();

            $table->dateTime('shopping_date')->default(now());
            $table->integer('grand_total');
            $table->timestamps();
            $table->primary('receipt_number');
        });

        /* DB::table('products')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 200, 'price' => 1300, 'in_stock' => 32],
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 201, 'price' => 4000, 'in_stock' => 10],
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 202, 'price' => 13000, 'in_stock' => 2],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 200, 'price' => 3300, 'in_stock' => 32],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 202, 'price' => 400, 'in_stock' => 43],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 203, 'price' => 6600, 'in_stock' => 37],
            ['scientific_name' => 'Paeonia officinalis', 'unit' => 200, 'price' => 1300, 'in_stock' => 32],
        ]); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};

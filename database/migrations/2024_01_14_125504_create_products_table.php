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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('product_id')->autoIncrement()->startingValue(1000);
            //$table->integer('pot');
            $table->string('scientific_name', 40); //term key
            $table->foreign('scientific_name')->references('scientific_name')->on('plants');
            //MEGJ.: 2 plusz kategória: állapot és típus, booleannal
            //false: mag, true: élőnövény
            $table->boolean('status')->default(false);
            //false: haszonnövény, true: dísznövény
            $table->boolean('type')->default(false);
            $table->string('color', 20)->default('NULL');
            $table->foreignId('unit')->references('unit_id')->on('units'); //term key
            $table->integer('price');
            $table->integer('in_stock');
            //+1 mező: lefoglalt mennyiség(kosárba rakástól számítva)
            $table->integer('reserved');
            $table->boolean('priority')->default(false); //kiemelt
            $table->timestamps();

            //$table->primary('product_id');
        });

        /*
        DB::table('products')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 200, 'price' => 1300, 'in_stock' => 32],
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 201, 'price' => 4000, 'in_stock' => 10],
            ['scientific_name' => 'Pelargonium peltatum', 'unit' => 202, 'price' => 13000, 'in_stock' => 2],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 200, 'price' => 3300, 'in_stock' => 32],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 202, 'price' => 400, 'in_stock' => 43],
            ['scientific_name' => 'Viola x wittrockiana', 'unit' => 203, 'price' => 6600, 'in_stock' => 37],
            ['scientific_name' => 'Paeonia officinalis', 'unit' => 200, 'price' => 1300, 'in_stock' => 32],
        ]);
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

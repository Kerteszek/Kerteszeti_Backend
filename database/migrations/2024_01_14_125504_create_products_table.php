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
            $table->string('scientific_name', 40); //term key
            $table->foreign('scientific_name')->references('scientific_name')->on('plants');
            //MEGJ.: 2 plusz kategória: állapot és típus, booleannal
            //false: mag, true: élőnövény
            $table->boolean('status')->default(false);
            //false: haszonnövény, true: dísznövény
            $table->boolean('type')->default(false);
            $table->string('color', 20)->nullable()->default(NULL);
            $table->foreignId('unit')->references('unit_id')->on('units'); //term key
            $table->integer('price');
            $table->integer('in_stock');
            //+1 mező: lefoglalt mennyiség(kosárba rakástól számítva)
            $table->integer('reserved');
            $table->boolean('priority')->default(false); //kiemelt
            $table->timestamps();

            //$table->primary('product_id');
        });

        DB::table('products')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'status' => true, 'type' => true, 'color' => "piros", 'unit' => 200, 'price' => 1300, 'in_stock' => 50, 'reserved' => 0, 'priority' => true],
            ['scientific_name' => 'Viola x wittrockiana', 'status' => true, 'type' => true, 'color' => "lila", 'unit' => 202, 'price' => 3000, 'in_stock' => 50, 'reserved' => 0, 'priority' => false],
            ['scientific_name' => 'Paeonia officinalis', 'status' => true, 'type' => true, 'color' => "rózsaszin", 'unit' => 203, 'price' => 1000, 'in_stock' => 50, 'reserved' => 0, 'priority' => true],
            ['scientific_name' => 'Rosa hybrid', 'status' => true, 'type' => true, 'color' => 'vörös', 'unit' => 201, 'price' => 1700, 'in_stock' => 50, 'reserved' => 0, 'priority' => true], //vörös
            ['scientific_name' => 'Rosa Austiger',  'status' => true, 'type' => true, 'color' => 'rózsaszín', 'unit' => 204, 'price' => 5000, 'in_stock' => 50, 'reserved' => 0, 'priority' => false], //rózsaszín
            ['scientific_name' => 'Rosa Lady of Shalott',  'status' => true, 'type' => true, 'color' => 'narancs', 'unit' => 202, 'price' => 2600, 'in_stock' => 50, 'reserved' => 0, 'priority' => true], //narancs
            ['scientific_name' => 'Salvia officinalis',  'status' => true, 'type' => true, 'color' => "lila", 'unit' => 201, 'price' => 900, 'in_stock' => 50, 'reserved' => 0, 'priority' => false],
            ['scientific_name' => 'Salvia rosmarinus',  'status' => true, 'type' => true, 'color' => "lila", 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0, 'priority' => true],
            ['scientific_name' => 'Cucumis sativus',  'status' => true, 'type' => true, 'color' => "zöld", 'unit' => 203, 'price' => 1800, 'in_stock' => 50, 'reserved' => 0, 'priority' => false],
            ['scientific_name' => 'Cucurbita pepo Goldena', 'status' => true, 'type' => true, 'color' => 'sárga', 'unit' => 202, 'price' => 6200, 'in_stock' => 50, 'reserved' => 0, 'priority' => false], //sárga
            ['scientific_name' => 'Cucurbita pepo', 'status' => true, 'type' => true, 'color' => 'zöld', 'unit' => 200, 'price' => 5200, 'in_stock' => 50, 'reserved' => 0, 'priority' => true], //ződ
            ['scientific_name' => 'Cucurbita pepo Lajkonik',  'status' => true, 'type' => true, 'color' => 'csíkos', 'unit' => 204, 'price' => 3500, 'in_stock' => 50, 'reserved' => 0, 'priority' => false], //csíkos

            ['scientific_name' => 'Rosa Austiger',  'status' => true, 'type' => true, 'color' => 'piros', 'unit' => 201, 'price' => 3200, 'in_stock' => 50, 'reserved' => 0, 'priority' => false], //rózsaszín
            ['scientific_name' => 'Rosa Lady of Shalott',  'status' => true, 'type' => true, 'color' => 'narancs', 'unit' => 204, 'price' => 2200, 'in_stock' => 50, 'reserved' => 0, 'priority' => false], //narancs
            ['scientific_name' => 'Salvia officinalis',  'status' => true, 'type' => true, 'color' => "fehér", 'unit' => 203, 'price' => 1000, 'in_stock' => 50, 'reserved' => 0, 'priority' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

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
            ['scientific_name' => 'Pelargonium peltatum', 'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Viola x wittrockiana', 'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Paeonia officinalis', 'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Rosa hybrid', 'status' => true, 'type' => true, 'color' => 'vörös', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //vörös
            ['scientific_name' => 'Rosa Austiger',  'status' => true, 'type' => true, 'color' => 'rózsaszín', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //rózsaszín
            ['scientific_name' => 'Rosa Lady of Shalott',  'status' => true, 'type' => true, 'color' => 'narancs', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //narancs
            ['scientific_name' => 'Salvia officinalis',  'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Salvia rosmarinus',  'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Cucumis sativus',  'status' => true, 'type' => true, 'color' => NULL, 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0],
            ['scientific_name' => 'Cucurbita pepo Goldena', 'status' => true, 'type' => true, 'color' => 'sárga', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //sárga
            ['scientific_name' => 'Cucurbita pepo', 'status' => true, 'type' => true, 'color' => 'zöld', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //ződ
            ['scientific_name' => 'Cucurbita pepo Lajkonik',  'status' => true, 'type' => true, 'color' => 'csíkos', 'unit' => 200, 'price' => 690, 'in_stock' => 50, 'reserved' => 0], //csíkos
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

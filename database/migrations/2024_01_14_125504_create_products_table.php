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
            $table->integer('product_id')->unique();
            //$table->integer('pot');
            $table->string('scientific_name', 40);
            $table->foreign('scientific_name')->references('scientific_name')->on('plants');
            $table->foreignId('pot')->references('pot_id')->on('pots');

            $table->integer('price');
            $table->integer('in_stock');
            $table->timestamps();

            $table->primary('product_id');
        });

        /* DB::table('products')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'name' => 'Futómuskátli', 'plant_category' => 106],
            ['scientific_name' => 'Viola x wittrockiana', 'name' => 'kerti árvácska', 'plant_category' => 106],
            ['scientific_name' => 'Paeonia officinalis', 'name' => 'Kerti bazsarózsa', 'plant_category' => 107],
        ]); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

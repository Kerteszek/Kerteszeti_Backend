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
        Schema::create('plants', function (Blueprint $table) {
            $table->string('scientific_name', 40)->unique();
            $table->string('name', 30);
            $table->timestamps();
            $table->foreignId('plant_category')->references('plant_category')->on('plant_categories');
            //megszorítás csak a 107-től lehet megadni
            $table->primary(['scientific_name']);
        });

        //https://rozsamania.hu/ajanlott-rozsafajtak/
        //https://www.terra.hu/haznov/htm/latidx.html
        DB::table('plants')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'name' => 'Futómuskátli', 'plant_category' => 100],
            ['scientific_name' => 'Viola x wittrockiana', 'name' => 'kerti árvácska', 'plant_category' => 100],
            ['scientific_name' => 'Paeonia officinalis', 'name' => 'Kerti bazsarózsa', 'plant_category' => 107],
            ['scientific_name' => 'Rosa hybrid', 'name' => 'Munstead wood', 'plant_category' => 106], //vörös
            ['scientific_name' => 'Rosa Austiger', 'name' => 'Queen of Sweden', 'plant_category' => 106], //rózsaszín
            ['scientific_name' => 'Rosa Lady of Shalott', 'name' => 'Lady of shalott', 'plant_category' => 106], //narancs
            ['scientific_name' => 'Salvia officinalis', 'name' => 'Orvosi zsálya', 'plant_category' => 105],
            ['scientific_name' => 'Salvia rosmarinus', 'name' => 'Rozmaring', 'plant_category' => 105],
            ['scientific_name' => 'Cucumis sativus', 'name' => 'Uborka', 'plant_category' => 104],
            ['scientific_name' => 'Cucurbita pepo Goldena', 'name' => 'Cukkini', 'plant_category' => 104], //sárga
            ['scientific_name' => 'Cucurbita pepo', 'name' => 'Cukkini', 'plant_category' => 104], //ződ
            ['scientific_name' => 'Cucurbita pepo Lajkonik', 'name' => 'Cukkini', 'plant_category' => 104], //csíkos
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};

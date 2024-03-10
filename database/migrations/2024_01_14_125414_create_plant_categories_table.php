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
        Schema::create('plant_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('plant_category')->autoIncrement()->startingValue(100);
            $table->string('name', 30);
            $table->timestamps();
        });

        DB::table('plant_categories')->insert([
            //MEGJ.: a termékekbe raktruk át a mag/élő, dísz/haszon kategóriát, booleannal, az egyszerűsítés kedvéért, itt maradnak az alkategóriák
            //de már nem referálnak ős vagy felettes kateg.-re, így csak id és elnevezés van, az elnevezés kitöltendő!!!
            ['name' => 'Egynyáriak'], //0
            ['name' => 'Évelő növények'], //1
            ['name' => 'Sziklakerti növények'], //2
            ['name' => 'Bogyós gyümölcsök'], //3
            ['name' => 'Zöldségek'], //4
            ['name' => 'Fűszernövények'], //5
            ['name' => 'Rózsák'], //6
            ['name' => 'Bazsarózsák'], //7
            ['name' => 'Liliomok'], //8
            ['name' => 'Jácint'], //9
            ['name' => 'Egyéb hagymások'], //10
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_categories');
    }
};

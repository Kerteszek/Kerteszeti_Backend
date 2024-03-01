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
            //$table->integer('level')->default(3);
            //$table->unsignedBigInteger('ancestor_category')->nullable();
            $table->timestamps();

            //$table->primary(['plant_category']);
            //$table->foreign('ancestor_category')->references('plant_category')->on('plant_categories');
        });

        DB::table('plant_categories')->insert([
            //**100 */  ['name' => 'Mag', 'ancestor_category' => NULL, 'level' => 1], //1
            //**101 */  ['name' => 'Élő növény', 'ancestor_category' => NULL, 'level' => 1], //1            

            //**102 */  ['name' => 'Dísznövény', 'ancestor_category' => 100, 'level' => 2], //2
            //**103 */  ['name' => 'Haszonnövények', 'ancestor_category' => 100, 'level' => 2], //2
            //**104 */  ['name' => 'Dísznövény', 'ancestor_category' => 101, 'level' => 2], //2
            //**105 */  ['name' => 'Haszonnövények', 'ancestor_category' => 101, 'level' => 2], //2

            /*
            ['name' => 'Egynyáriak', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Évelő növények', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Sziklakerti növények', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Bogyós gyümölcsök', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Zöldségek, Fűszernövények', 'ancestor_category' => 102, 'level' => 3], //3
        */

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

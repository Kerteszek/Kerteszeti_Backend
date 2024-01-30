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
            $table->integer('level')->default(3);
            $table->unsignedBigInteger('ancestor_category')->nullable();

            $table->timestamps();

            $table->foreign('ancestor_category')->references('plant_category')->on('plant_categories');
        });

        DB::table('plant_categories')->insert([
            ['name' => 'Mag', 'ancestor_category' => NULL, 'level' => 1], //1
            ['name' => 'Élő növény', 'ancestor_category' => NULL, 'level' => 1], //1            

            ['name' => 'Dísznövény', 'ancestor_category' => 100, 'level' => 2], //2
            ['name' => 'Haszonnövények', 'ancestor_category' => 100, 'level' => 2], //2
            ['name' => 'Dísznövény', 'ancestor_category' => 101, 'level' => 2], //2
            ['name' => 'Haszonnövények', 'ancestor_category' => 101, 'level' => 2], //2

            ['name' => 'Egynyáriak', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Évelő növények', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Sziklakerti növények', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Bogyós gyümölcsök', 'ancestor_category' => 102, 'level' => 3], //3
            ['name' => 'Zöldségek, Fűszernövények', 'ancestor_category' => 102, 'level' => 3], //3
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

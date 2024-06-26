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
        Schema::create('units', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->autoIncrement()->startingValue(200);
            $table->string('name', 30);
            $table->timestamps();
            //$table->primary('pot_id');
        });

        DB::table('units')->insert([
            ['name' => '12 cm cserép'],
            ['name' => '5l cserép'],
            ['name' => '5g'],
            ['name' => '100g'],
            ['name' => 'gyökércsomagolt'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};

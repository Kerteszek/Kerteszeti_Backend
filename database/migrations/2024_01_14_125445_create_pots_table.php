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
        Schema::create('pots', function (Blueprint $table) {
            $table->unsignedBigInteger('pot_id')->autoIncrement()->startingValue(200);
            $table->string('name', 30);
            $table->timestamps();
            //$table->primary('pot_id');
        });


        DB::table('pots')->insert([
            ['name' => 'cserepes'],
            ['name' => 'ládás'],
            ['name' => '5l cserép'],
            ['name' => 'csomagos'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pots');
    }
};

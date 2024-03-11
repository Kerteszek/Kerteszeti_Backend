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
        Schema::create('baskets', function (Blueprint $table) {
            $table->integer('basket_id')->autoIncrement()->startingValue(100000);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        DB::table('purchases')->insert([
            ['user_id' => 1],
            ['user_id' => 2],
            ['user_id' => 2],
            ['user_id' => 3],
            ['user_id' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};

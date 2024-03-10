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
        Schema::create('pictures', function (Blueprint $table) {
            $table->integer('product');

            $table->string("picture_path");
            $table->foreign('product')->references('product_id')->on('products');
            $table->timestamps();

            $table->primary(['product', 'picture_path']);
        });

        DB::table('pictures')->insert([
            ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag1.jpg'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag1.jpg'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag2.jpg'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag3.jpg'],
           
            ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag4.jpg'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag4.jpg'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag5.jpg'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag6.jpg'],

            ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag7.jpg'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag7.jpg'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag8.jpg'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag9.jpg'],

            ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag10.jpg'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/1000-700/virag10.jpg'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/1000-700/virag11.jpg'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/1000-700/virag12.jpg'],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};

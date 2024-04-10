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
            $table->char("purpose")->default('P');
            $table->timestamps();
            $table->primary(['product', 'picture_path']);
        });

        DB::table('pictures')->insert([

            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag1.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag2.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag3.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag4.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag5.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/1000-700/virag6.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag7.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag8.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/1000-700/virag9.jpg', 'purpose' => 'P'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/1000-700/virag10.jpg', 'purpose' => 'P'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/1000-700/virag11.jpg', 'purpose' => 'P'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/1000-700/virag12.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag11.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/1000-700/virag12.jpg', 'purpose' => 'P'],

            //Fontos ezekből csak egy lehet!
            ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag1.jpg', 'purpose' => 'B'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/boritokep/virag2.jpg', 'purpose' => 'B'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/boritokep/virag3.jpg', 'purpose' => 'B'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/boritokep/virag4.jpg', 'purpose' => 'B'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/boritokep/virag5.jpg', 'purpose' => 'B'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/boritokep/virag6.jpg', 'purpose' => 'B'],
            ['product' => 1007, 'picture_path' => 'kepek/termekek/boritokep/virag7.jpg', 'purpose' => 'B'],
            ['product' => 1008, 'picture_path' => 'kepek/termekek/boritokep/virag8.jpg', 'purpose' => 'B'],
            ['product' => 1009, 'picture_path' => 'kepek/termekek/boritokep/virag9.jpg', 'purpose' => 'B'],
            ['product' => 1010, 'picture_path' => 'kepek/termekek/boritokep/virag10.jpg', 'purpose' => 'B'],
            ['product' => 1011, 'picture_path' => 'kepek/termekek/boritokep/virag11.jpg', 'purpose' => 'B'],
            //['product' => 1012, 'picture_path' => 'kepek/termekek/boritokep/virag12.jpg'],
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

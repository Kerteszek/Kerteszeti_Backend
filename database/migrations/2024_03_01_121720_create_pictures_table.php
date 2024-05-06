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

            ['product' => 1000, 'picture_path' => 'kepek/termekek/Futomuskatli/Futomuskatli1.jpg', 'purpose' => 'B'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/Futomuskatli/Futomuskatli2.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/Futomuskatli/Futomuskatli3.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/Futomuskatli/Futomuskatli4.jpg', 'purpose' => 'P'],
            ['product' => 1000, 'picture_path' => 'kepek/termekek/Futomuskatli/Futomuskatli5.jpg', 'purpose' => 'P'],

            ['product' => 1001, 'picture_path' => 'kepek/termekek/kertiarvacska/kertiarvacska2.jpg', 'purpose' => 'B'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/kertiarvacska/kertiarvacska1.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/kertiarvacska/kertiarvacska3.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/kertiarvacska/kertiarvacska4.jpg', 'purpose' => 'P'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/kertiarvacska/kertiarvacska5.jpg', 'purpose' => 'P'],

            ['product' => 1002, 'picture_path' => 'kepek/termekek/kertibazsarozsa/kertibazsarozsa1.jpg', 'purpose' => 'B'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/kertibazsarozsa/kertibazsarozsa2.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/kertibazsarozsa/kertibazsarozsa3.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/kertibazsarozsa/kertibazsarozsa4.jpg', 'purpose' => 'P'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/kertibazsarozsa/kertibazsarozsa5.jpg', 'purpose' => 'P'],

            ['product' => 1003, 'picture_path' => 'kepek/termekek/vorosrozsa/vorosrozsa2.jpg', 'purpose' => 'B'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/vorosrozsa/vorosrozsa1.jpg', 'purpose' => 'P'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/vorosrozsa/vorosrozsa3.jpg', 'purpose' => 'P'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/vorosrozsa/vorosrozsa4.jpg', 'purpose' => 'P'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/vorosrozsa/vorosrozsa5.jpg', 'purpose' => 'P'],

            ['product' => 1004, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden3.jpg', 'purpose' => 'B'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden1.jpg', 'purpose' => 'P'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden2.jpg', 'purpose' => 'P'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden4.jpg', 'purpose' => 'P'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden5.jpg', 'purpose' => 'P'],

            ['product' => 1005, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott1.jpg', 'purpose' => 'B'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott2.jpg', 'purpose' => 'P'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott3.jpg', 'purpose' => 'P'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott4.jpg', 'purpose' => 'P'],
            ['product' => 1005, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott5.jpg', 'purpose' => 'P'],

            ['product' => 1006, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya3.jpg', 'purpose' => 'B'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya1.jpg', 'purpose' => 'P'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya2.jpg', 'purpose' => 'P'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya4.jpg', 'purpose' => 'P'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya5.jpg', 'purpose' => 'P'],

            ['product' => 1007, 'picture_path' => 'kepek/termekek/rozmaring/rozmaring4.jpg', 'purpose' => 'B'],
            ['product' => 1007, 'picture_path' => 'kepek/termekek/rozmaring/rozmaring1.jpg', 'purpose' => 'P'],
            ['product' => 1007, 'picture_path' => 'kepek/termekek/rozmaring/rozmaring2.jpg', 'purpose' => 'P'],
            ['product' => 1007, 'picture_path' => 'kepek/termekek/rozmaring/rozmaring3.jpg', 'purpose' => 'P'],

            ['product' => 1008, 'picture_path' => 'kepek/termekek/uborka/uborka1.jpg', 'purpose' => 'B'],
            ['product' => 1008, 'picture_path' => 'kepek/termekek/uborka/uborka2.jpg', 'purpose' => 'P'],
            ['product' => 1008, 'picture_path' => 'kepek/termekek/uborka/uborka3.jpg', 'purpose' => 'P'],
            ['product' => 1008, 'picture_path' => 'kepek/termekek/uborka/uborka4.jpg', 'purpose' => 'P'],

            ['product' => 1009, 'picture_path' => 'kepek/termekek/sargacukkini/sargacukkini1.jpg', 'purpose' => 'B'],
            ['product' => 1009, 'picture_path' => 'kepek/termekek/sargacukkini/sargacukkini2.jpg', 'purpose' => 'P'],
            ['product' => 1009, 'picture_path' => 'kepek/termekek/sargacukkini/sargacukkini3.jpg', 'purpose' => 'P'],
            ['product' => 1009, 'picture_path' => 'kepek/termekek/sargacukkini/sargacukkini4.jpg', 'purpose' => 'P'],

            ['product' => 1010, 'picture_path' => 'kepek/termekek/zoldcukkini/zoldcukkini1.jpg', 'purpose' => 'B'],
            ['product' => 1010, 'picture_path' => 'kepek/termekek/zoldcukkini/zoldcukkini2.jpg', 'purpose' => 'P'],
            ['product' => 1010, 'picture_path' => 'kepek/termekek/zoldcukkini/zoldcukkini3.jpg', 'purpose' => 'P'],
            ['product' => 1010, 'picture_path' => 'kepek/termekek/zoldcukkini/zoldcukkini4.jpg', 'purpose' => 'P'],

            ['product' => 1011, 'picture_path' => 'kepek/termekek/csikoscukkini/csikoscukkini2.jpg', 'purpose' => 'B'],
            ['product' => 1011, 'picture_path' => 'kepek/termekek/csikoscukkini/csikoscukkini1.jpg', 'purpose' => 'P'],
            ['product' => 1011, 'picture_path' => 'kepek/termekek/csikoscukkini/csikoscukkini3.jpg', 'purpose' => 'P'],


            ['product' => 1012, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden3.jpg', 'purpose' => 'P'],
            ['product' => 1012, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden1.jpg', 'purpose' => 'P'],
            ['product' => 1012, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden2.jpg', 'purpose' => 'B'],
            ['product' => 1012, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden4.jpg', 'purpose' => 'P'],
            ['product' => 1012, 'picture_path' => 'kepek/termekek/queenofsweden/queenofsweden5.jpg', 'purpose' => 'P'],

            ['product' => 1013, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott1.jpg', 'purpose' => 'P'],
            ['product' => 1013, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott2.jpg', 'purpose' => 'P'],
            ['product' => 1013, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott3.jpg', 'purpose' => 'P'],
            ['product' => 1013, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott4.jpg', 'purpose' => 'P'],
            ['product' => 1013, 'picture_path' => 'kepek/termekek/ladyofshalott/ladyofshalott5.jpg', 'purpose' => 'B'],

            ['product' => 1014, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya3.jpg', 'purpose' => 'P'],
            ['product' => 1014, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya1.jpg', 'purpose' => 'P'],
            ['product' => 1014, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya2.jpg', 'purpose' => 'B'],
            ['product' => 1014, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya4.jpg', 'purpose' => 'P'],
            ['product' => 1014, 'picture_path' => 'kepek/termekek/orvosizsalya/orvosizsalya5.jpg', 'purpose' => 'P'],

            //Fontos ezekből csak egy lehet!
            /*  ['product' => 1000, 'picture_path' => 'kepek/termekek/boritokep/virag1.jpg', 'purpose' => 'B'],
            ['product' => 1001, 'picture_path' => 'kepek/termekek/boritokep/virag2.jpg', 'purpose' => 'B'],
            ['product' => 1002, 'picture_path' => 'kepek/termekek/boritokep/virag3.jpg', 'purpose' => 'B'],
            ['product' => 1003, 'picture_path' => 'kepek/termekek/boritokep/virag4.jpg', 'purpose' => 'B'],
            ['product' => 1004, 'picture_path' => 'kepek/termekek/boritokep/virag5.jpg', 'purpose' => 'B'],
            ['product' => 1006, 'picture_path' => 'kepek/termekek/boritokep/virag6.jpg', 'purpose' => 'B'],
            ['product' => 1007, 'picture_path' => 'kepek/termekek/boritokep/virag7.jpg', 'purpose' => 'B'],
            ['product' => 1008, 'picture_path' => 'kepek/termekek/boritokep/virag8.jpg', 'purpose' => 'B'],
            ['product' => 1009, 'picture_path' => 'kepek/termekek/boritokep/virag9.jpg', 'purpose' => 'B'],
            ['product' => 1010, 'picture_path' => 'kepek/termekek/boritokep/virag10.jpg', 'purpose' => 'B'],
            ['product' => 1011, 'picture_path' => 'kepek/termekek/boritokep/virag11.jpg', 'purpose' => 'B'], */
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

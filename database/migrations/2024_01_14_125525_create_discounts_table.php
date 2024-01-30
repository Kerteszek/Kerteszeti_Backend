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
        Schema::create('discounts', function (Blueprint $table) {
            $table->integer('discount_id')->autoIncrement()->startingValue(600);
            $table->unsignedTinyInteger('percentage');
            $table->date('start_date');
            $table->date('end_date')->nullable();

            //$table->primary('discount_id');
            $table->timestamps();
        });

        DB::table('discounts')->insert([
            ['percentage' => 10, 'start_date' => '2024-01-01'],
            ['percentage' => 20, 'start_date' => '2024-01-01'],
            ['percentage' => 30, 'start_date' => '2024-01-01'],
            ['percentage' => 50, 'start_date' => '2024-01-01'],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};

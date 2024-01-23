<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pots', function (Blueprint $table) {
            $table->integer('pot_id')->startFrom(200);//500-ig
            $table->string('name', 30);
            $table->timestamps();
            $table->primary('pot_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pots');
    }
};

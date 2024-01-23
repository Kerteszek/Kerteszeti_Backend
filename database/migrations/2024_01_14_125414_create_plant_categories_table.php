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
        Schema::create('plant_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('plant_category')->startFrom(100);
            $table->string('name', 30);
            $table->unsignedBigInteger('ancestor_category')->nullable();
            $table->timestamps();

            $table->primary('plant_category');
            $table->foreign('ancestor_category')->references('plant_category')->on('plant_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_categories');
    }
};

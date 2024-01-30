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
        Schema::create('plants', function (Blueprint $table) {
            $table->string('scientific_name', 40)->unique();
            $table->string('name', 30);
            $table->string('color', 20)->default('NULL');
            // szezonja egyenlőre nem
            $table->timestamps();

            $table->foreignId('plant_category')->references('plant_category')->on('plant_categories');
            $table->primary(['scientific_name']);
        });

        DB::table('plants')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'name' => 'Futómuskátli', 'plant_category' => 106],
            ['scientific_name' => 'Viola x wittrockiana', 'name' => 'kerti árvácska', 'plant_category' => 106],
            ['scientific_name' => 'Paeonia officinalis', 'name' => 'Kerti bazsarózsa', 'plant_category' => 107],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};

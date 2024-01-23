<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('permission')->default(2); //0 superadmin 1 admin, 2 felhasználó, 3 guest
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            //majd Hash
            [
                'name' => 'Vásárló'
                ,'email' => 'vasarlo@gmail.com'
                ,'password' => Hash::make('Aa123@')
                ,'permission' => 2
            ],

            [
                'name' => 'Admin'
                ,'email' => 'admin@gmail.com'
                ,'password' => Hash::make('Aa123@')
                ,'permission' => 1
            ],

            [
                'name' => 'SuperAdmin'
                ,'email' => 'sadmin@gmail.com'
                ,'password' => Hash::make('Aa123@')
                ,'permission' => 0
            ],
            [
                'name' => 'Vendég'
                ,'email' => 'vendeg@gmail.com'
                ,'password' => Hash::make('Aa123@')
                ,'permission' => 0
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

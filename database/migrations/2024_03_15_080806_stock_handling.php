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
        DB::unprepared('CREATE TRIGGER product_added 
        AFTER INSERT ON suppliances
        FOR EACH ROW
        BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product;                          
            UPDATE products SET in_stock = in_stock + NEW.number_of_items WHERE product_id = NEW.product;
            
        END
        ');

        DB::unprepared('CREATE TRIGGER reserved_insert 
        AFTER INSERT ON basket_items
        FOR EACH ROW
        BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product; 
            IF available_stock >= NEW.amount THEN                
                UPDATE products SET in_stock = in_stock - NEW.amount, reserved = reserved + NEW.amount WHERE product_id = NEW.product;
            END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS product_added');
        DB::unprepared('DROP TRIGGER IF EXISTS reserved_insert');
    }
};

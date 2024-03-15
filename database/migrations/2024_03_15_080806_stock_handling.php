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
        DB::unprepared('CREATE TRIGGER product_sold 
        AFTER INSERT ON purchase_items
        FOR EACH ROW
        BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product_id; 

            IF available_stock >= NEW.quantity THEN                
                UPDATE products SET in_stock = in_stock - NEW.quantity WHERE product_id = NEW.product_id;
            END IF;
        END
        ');

        DB::unprepared('CREATE TRIGGER product_added 
        AFTER INSERT ON suppliances
        FOR EACH ROW
        BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product;                          
            UPDATE products SET in_stock = in_stock + NEW.number_of_items WHERE product_id = NEW.product;
            
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS product_sold');
        DB::unprepared('DROP TRIGGER IF EXISTS product_added');
    }
};

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
        DB::unprepared('CREATE TRIGGER prize_update_saver 
        AFTER UPDATE ON products
            FOR EACH ROW
            BEGIN
                IF OLD.price <> NEW.price THEN
                    INSERT INTO product_prices (product, change_date, new_price, created_at, updated_at)
                    VALUES (NEW.product_id, NOW(), NEW.price, NOW(), NOW());
                END IF;
            END
        ');


        DB::unprepared('CREATE TRIGGER prize_update_product_create
        AFTER INSERT ON products
        FOR EACH ROW
        BEGIN
            INSERT INTO product_prices (product, change_date, new_price, created_at, updated_at)
            VALUES (NEW.product_id, NOW(), NEW.price, NOW(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prize_update_saver');
        DB::unprepared('DROP TRIGGER IF EXISTS prize_update_product_create');
    }
};

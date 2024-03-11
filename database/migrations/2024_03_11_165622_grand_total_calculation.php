<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * INSERT OR UPDATE OR DELETE ON
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER grand_total_calculation_update
        AFTER UPDATE ON purchase_items
            FOR EACH ROW
            BEGIN
                DECLARE total DECIMAL(10,2);
                DECLARE purchase_id INT;

                -- Retrieve the corresponding purchase_id
                SELECT purchase_number INTO purchase_id FROM purchase_items
                 WHERE NEW.purchase_number = purchase_number LIMIT 1;

                -- Calculate the total
                SELECT SUM(products.price * purchase_items.quantity) INTO total
                FROM purchase_items
                INNER JOIN products ON purchase_items.product_id = products.product_id
                WHERE purchase_items.purchase_number = NEW.purchase_number;

                -- Update the grand_total in the purchases table
                UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
            END;
        ');

        DB::unprepared('CREATE TRIGGER grand_total_calculation_insert 
        AFTER INSERT ON purchase_items
            FOR EACH ROW
            BEGIN
                DECLARE total DECIMAL(10,2);
                DECLARE purchase_id INT;

                -- Retrieve the corresponding purchase_id
                SELECT purchase_number INTO purchase_id FROM purchase_items
                WHERE NEW.purchase_number = purchase_number LIMIT 1;

                -- Calculate the total
                SELECT SUM(products.price * purchase_items.quantity) INTO total
                FROM purchase_items
                INNER JOIN products ON purchase_items.product_id = products.product_id
                WHERE purchase_items.purchase_number = NEW.purchase_number;

                -- Update the grand_total in the purchases table
                UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
            END;
        ');

        DB::unprepared('CREATE TRIGGER grand_total_calculation_delete 
            AFTER DELETE ON purchase_items
                FOR EACH ROW
                BEGIN
                    DECLARE total DECIMAL(10,2);
                    DECLARE purchase_id INT;

                    -- Retrieve the corresponding purchase_id
                    SELECT purchase_number INTO purchase_id FROM purchase_items
                    WHERE OLD.purchase_number = purchase_number LIMIT 1;

                    -- Calculate the total
                    SELECT SUM(products.price * purchase_items.quantity) INTO total
                    FROM purchase_items
                    INNER JOIN products ON purchase_items.product_id = products.product_id
                    WHERE purchase_items.purchase_number = OLD.purchase_number;

                    -- Update the grand_total in the purchases table
                    UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
                END;
            ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS grand_total_calculation_update');
        DB::unprepared('DROP TRIGGER IF EXISTS grand_total_calculation_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS grand_total_calculation_delete');
    }
};

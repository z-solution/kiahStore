<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProductId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->renameColumn('product_id', 'inventory_id');
            $table->index(['inventory_id']);
            $table->dropIndex('cart_items_product_id_index');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->renameColumn('inventory_id', 'product_id');
            $table->index(['product_id']);
            $table->dropIndex('cart_items_inventory_id_index');

            
            //
        });
    }
}

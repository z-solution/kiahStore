<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantitiyAndProductIdToCartItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('quantity')
                ->default(0)
                ->after('inventory_variant_id')
                ->nullable($value = false);
            $table->integer('product_id')
                ->default(0)
                ->after('inventory_variant_id')
                ->nullable($value = false);
            $table->index(['cart_id']);
            $table->index(['product_id']);
            $table->index(['inventory_variant_id']);
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
            $table->dropIndex('cart_items_cart_id_index');
            $table->dropIndex('cart_items_inventory_variant_id_index');
            $table->dropIndex('cart_items_product_id_index');
            $table->dropColumn('quantity');
            $table->dropColumn('product_id');
        });
    }
}

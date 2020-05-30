<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndQuantityToInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->integer('quantity')
                ->default(0)
                ->after('price')
                ->nullable($value = false);
            $table->index(['quantity']);
            $table->integer('status')
                ->default(0)
                ->after('quantity')
                ->nullable($value = false);
            $table->index(['status']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('inventory1s');

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropIndex('inventories_status_index');
            $table->dropColumn('status');

            $table->dropIndex('inventories_quantity_index');
            $table->dropColumn('quantity');

            
        });
    }
}

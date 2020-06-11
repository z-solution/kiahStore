<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->string('shop_id')
                ->default('')
                ->after('id')
                ->nullable($value = false);
                $table->index(['shop_id']);
                $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropIndex('coupons_shop_id_index');
            $table->dropIndex('coupons_code_index');
            $table->dropColumn('shop_id');
        });
    }
}

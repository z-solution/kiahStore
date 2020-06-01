<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_id');
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->string('type');
            $table->string('filename');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['inventory_id', 'type']);
            $table->index(['user_id', 'type']);
            $table->index(['shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}

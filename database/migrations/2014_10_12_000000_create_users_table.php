<?php

use App\Model\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->integer('type');
            $table->integer('owner_shop_id');
            $table->integer('customer_shop_id');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        return User::createAdmin([
            'name' => "admin",
            'email' => "admin@admin.com",
            'password' => Hash::make("12341234"),
            'owner_shop_id' => 0,
            'customer_shop_id' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

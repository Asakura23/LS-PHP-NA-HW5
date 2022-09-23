<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket', function (Blueprint $table) {
            $table->id('b_id');
            $table->integer('b_owner');
            $table->integer('b_good');
            $table->string('b_email');
            $table->tinyInteger('b_deleted');
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id('c_id');
            $table->string('c_name');
            $table->mediumText('c_description');
            $table->tinyInteger('c_deleted');
        });
        Schema::create('goods', function (Blueprint $table) {
            $table->id('g_id');
            $table->integer('g_cat');
            $table->string('g_name');
            $table->string('g_image');
            $table->integer('g_price');
            $table->mediumText('g_description');
            $table->tinyInteger('g_deleted');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('isadmin');
        });
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
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('photo')->nullable();
            $table->boolean('verify')->nullable();
            $table->string('status');
            $table->string('token')->nullable();
            $table->string('login_token')->nullable();
            $table->string('loyalty_points')->nullable();
            $table->string('password');
            $table->timestamps();
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
}
